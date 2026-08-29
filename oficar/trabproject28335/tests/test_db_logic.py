import pytest
from django.db import connections

# ==============================================================================
# 1. FIXTURE OBRIGATÓRIO (Garante isolamento dos testes)
# ==============================================================================

@pytest.fixture
def db_cursor():
    cursor = connections['default'].cursor() # Cursor da BD que garante ROLLBACK no final para manter a BD limpa após cada teste
    cursor.execute("BEGIN;") # Inicia a transação
    try:
        yield cursor
    finally:
        cursor.execute("ROLLBACK;") # Reverte todas as alterações
        cursor.close()

# ==============================================================================
# 2. FUNÇÕES DE SUPORTE (Para criar dados de teste)
# ==============================================================================

def setup_prerequisitos(cur):
    # Cria Cliente, Funcionário e Veículo
    # CLIENTE
    cur.execute("CALL P_Criar_Cliente('Cliente Teste', '900000000', 'cliente@teste.pt', 'Morada Teste', '100000000');")
    cur.execute("SELECT cliente_id FROM Clientes WHERE nif = '100000000';")
    cliente_id = cur.fetchone()[0]
    
    # FUNCIONARIO
    cur.execute("CALL P_Criar_Funcionario('Funcionario Teste', 'Mecânico', 'Geral', '900000001', 'hash_secreto_valido');")
    cur.execute("SELECT funcionario_id FROM Funcionarios WHERE telemovel = '900000001';")
    funcionario_id = cur.fetchone()[0]
    
    # VEICULO
    cur.execute(f"CALL P_Criar_Veiculo('AA-00-AA', 'Marca Teste', 'Modelo Teste', {cliente_id}, 2020);")
    
    return cliente_id, funcionario_id

def setup_peca_servico(cur):
    # Cria uma Peça e um Serviço
    # PEÇA
    cur.execute("CALL P_Criar_Peca('Filtro de Óleo Teste', 'Filtro para motor', 10.00, 50);")
    cur.execute("SELECT peca_id FROM Pecas WHERE nome = 'Filtro de Óleo Teste';")
    peca_id = cur.fetchone()[0] 
    
    # SERVIÇO
    cur.execute("CALL P_Criar_Servico('Diagnóstico Elétrico', 'Verificação de falhas', 30.00);")
    cur.execute("SELECT servico_id FROM Servico WHERE nome = 'Diagnóstico Elétrico';")
    servico_id = cur.fetchone()[0]
    
    return peca_id, servico_id

# ==============================================================================
# 3. TESTES DE FUNCIONALIDADES E INTEGRIDADE (Regras de Negócio)
# ==============================================================================

def test_f_autenticar_funcionario_sucesso(db_cursor):
    #[F_Autenticar_Funcionario] Teste de Segurança: Verifica o login correto
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    
    cur.execute(f"SELECT * FROM F_Autenticar_Funcionario({funcionario_id}, 'hash_secreto_valido');")
    resultado = cur.fetchone()
    
    assert resultado is not None
    assert resultado[0] == funcionario_id
    assert resultado[1] == 'Mecânico'

def test_p1_atualizar_stock_erro_negativo(db_cursor):
    # [P_Atualizar_Stock] Teste de Integridade: Impede stock negativo
    cur = db_cursor
    peca_id, _ = setup_peca_servico(cur) # Stock inicial: 50
    
    # Tenta remover 51 unidades
    with pytest.raises(Exception) as excinfo:
        cur.execute(f"CALL P_Atualizar_Stock({peca_id}, -51);")
    
    assert 'faria o stock ficar negativo' in str(excinfo.value)

def test_trg1_baixa_stock_automatica(db_cursor):
    # [P_Add_Peca_Usada -> TRG1] Testa a baixa de stock automática após uso de peça
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    peca_id, _ = setup_peca_servico(cur) # Stock inicial: 50
    
    cur.execute(f"SELECT F_Criar_OS('AA-00-AA', {funcionario_id}, 'Teste de Stock');") 
    os_id = cur.fetchone()[0]
    
    quantidade_usada = 15
    stock_esperado = 50 - quantidade_usada # 35

    cur.execute(f"CALL P_Add_Peca_Usada({os_id}, {peca_id}, {quantidade_usada});")
    
    cur.execute(f"SELECT stock FROM Pecas WHERE peca_id = {peca_id};")
    stock_final = cur.fetchone()[0]
    
    assert stock_final == stock_esperado

def test_fn2_recalculo_valor_total(db_cursor):
    # [P_Add_Item_Servico -> FN2] Testa o recálculo do valor total da OS
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    peca_id, servico_id = setup_peca_servico(cur) # Peça: 10.00, Serviço: 30.00
    
    cur.execute(f"SELECT F_Criar_OS('AA-00-AA', {funcionario_id}, 'Teste Recálculo');") 
    os_id = cur.fetchone()[0]

    # 1. Adiciona Serviço: 2 * 30.00 = 60.00
    cur.execute(f"CALL P_Add_Item_Servico({os_id}, {servico_id}, 2);")
    
    # 2. Adiciona Peça: 5 * 10.00 = 50.00
    cur.execute(f"CALL P_Add_Peca_Usada({os_id}, {peca_id}, 5);")
    
    valor_esperado = 110.00 # 60.00 + 50.00

    cur.execute(f"SELECT valor_total FROM Ordens_Servico WHERE os_id = {os_id};")
    valor_final = cur.fetchone()[0]
    
    assert round(float(valor_final), 2) == valor_esperado

def test_trg2_impedir_edicao_faturada(db_cursor):
    #[TRG2] Testa a regra de negócio: Impede alteração de OS após ser faturada
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    
    cur.execute(f"SELECT F_Criar_OS('AA-00-AA', {funcionario_id}, 'Teste Fatura');") 
    os_id = cur.fetchone()[0]
    
    # 1. Emite Fatura (Muda o status para 'Faturada')
    cur.execute(f"CALL P_Emitir_Fatura({os_id}, 'Transferência');")
    
    # 2. Tenta atualizar o status
    with pytest.raises(Exception) as excinfo:
        cur.execute(f"CALL P_Atualizar_OS_Status({os_id}, 'Em Execução');")

    assert 'não pode ser alterada, pois já foi faturada' in str(excinfo.value)

def test_p_remover_os_reposicao_stock(db_cursor):
    # [P_Remover_OS] Testa a regra de negócio: Repõe o stock das peças usadas na remoção da OS
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    peca_id, _ = setup_peca_servico(cur) # Stock inicial: 50
    
    cur.execute(f"SELECT F_Criar_OS('AA-00-AA', {funcionario_id}, 'Teste Reposição');") 
    os_id = cur.fetchone()[0]
    cur.execute(f"CALL P_Add_Peca_Usada({os_id}, {peca_id}, 10);")
    
    # Stock baixou para 40
    cur.execute(f"SELECT stock FROM Pecas WHERE peca_id = {peca_id};")
    stock_antes_remocao = cur.fetchone()[0]
    assert stock_antes_remocao == 40
    
    # Executa a remoção da OS (Deve repor as 10 unidades)
    cur.execute(f"CALL P_Remover_OS({os_id});")

    # Confirma stock reposto (deve voltar a 50)
    cur.execute(f"SELECT stock FROM Pecas WHERE peca_id = {peca_id};")
    stock_final = cur.fetchone()[0]
    
    assert stock_final == 50

# ==============================================================================
# 4. TESTES CRUD GERAIS
# ==============================================================================

### Clientes CRUD ###

def test_cliente_crud(db_cursor):
    cur = db_cursor
    
    # CREATE
    cur.execute("CALL P_Criar_Cliente('Novo Cliente', '911111111', 'novo@cliente.pt', 'Rua Nova', '300000000');")
    cur.execute("SELECT cliente_id FROM Clientes WHERE nif = '300000000';")
    cliente_id = cur.fetchone()[0]
    assert cliente_id is not None
    
    # READ
    cur.execute(f"SELECT nome FROM F_Ler_Cliente_Por_ID({cliente_id});")
    nome = cur.fetchone()[0]
    assert nome == 'Novo Cliente'
    
    # UPDATE
    novo_nome = 'Cliente Atualizado'
    cur.execute(f"CALL P_Atualizar_Cliente({cliente_id}, '{novo_nome}', '922222222', 'update@cliente.pt', 'Rua Velha', '300000000');")
    cur.execute(f"SELECT nome FROM F_Ler_Cliente_Por_ID({cliente_id});")
    nome_atualizado = cur.fetchone()[0]
    assert nome_atualizado == novo_nome
    
    # DELETE
    cur.execute(f"CALL P_Remover_Cliente({cliente_id});")
    cur.execute(f"SELECT COUNT(*) FROM Clientes WHERE cliente_id = {cliente_id};")
    count = cur.fetchone()[0]
    assert count == 0

### Veículos CRUD ###

def test_veiculo_crud(db_cursor):
    cur = db_cursor
    cliente_id, _ = setup_prerequisitos(cur) # Obtém cliente_id
    matricula = 'BB-11-BB'
    
    # CREATE
    cur.execute(f"CALL P_Criar_Veiculo('{matricula}', 'Fiat', 'Punto', {cliente_id}, 2018);")
    cur.execute(f"SELECT COUNT(*) FROM Veiculos WHERE matricula = '{matricula}';")
    assert cur.fetchone()[0] == 1
    
    # READ
    cur.execute(f"SELECT marca FROM F_Ler_Veiculo_Por_Matricula('{matricula}');")
    marca = cur.fetchone()[0]
    assert marca == 'Fiat'
    
    # UPDATE
    nova_matricula = 'BB-22-BB'
    cur.execute(f"CALL P_Atualizar_Veiculo('{matricula}', '{nova_matricula}', 'Audi', 'A3', 2021);")
    cur.execute(f"SELECT marca FROM F_Ler_Veiculo_Por_Matricula('{nova_matricula}');")
    marca_atualizada = cur.fetchone()[0]
    assert marca_atualizada == 'Audi'
    
    # DELETE
    cur.execute(f"CALL P_Remover_Veiculo('{nova_matricula}');")
    cur.execute(f"SELECT COUNT(*) FROM Veiculos WHERE matricula = '{nova_matricula}';")
    assert cur.fetchone()[0] == 0

### Funcionários CRUD ###

def test_funcionario_crud(db_cursor):
    cur = db_cursor
    
    # CREATE
    cur.execute("CALL P_Criar_Funcionario('João Novo', 'Admin', 'Gestão', '933333333', 'pass123');")
    cur.execute("SELECT funcionario_id FROM Funcionarios WHERE telemovel = '933333333';")
    funcionario_id = cur.fetchone()[0]
    assert funcionario_id is not None
    
    # READ
    cur.execute(f"SELECT nome FROM F_Ler_Funcionario_Por_ID({funcionario_id});")
    nome = cur.fetchone()[0]
    assert nome == 'João Novo'
    
    # UPDATE
    novo_cargo = 'Gerente'
    cur.execute(f"CALL P_Atualizar_Funcionario({funcionario_id}, 'João Atualizado', '{novo_cargo}', 'Direção', '944444444', 'newpass');")
    cur.execute(f"SELECT cargo FROM F_Ler_Funcionario_Por_ID({funcionario_id});")
    cargo_atualizado = cur.fetchone()[0]
    assert cargo_atualizado == novo_cargo
    
    # DELETE
    cur.execute(f"CALL P_Remover_Funcionario({funcionario_id});")
    cur.execute(f"SELECT COUNT(*) FROM Funcionarios WHERE funcionario_id = {funcionario_id};")
    assert cur.fetchone()[0] == 0

### Peças CRUD ###

def test_pecas_crud(db_cursor):
    cur = db_cursor
    
    # CREATE
    cur.execute("CALL P_Criar_Peca('Pneu Teste', 'Pneu Michelin', 80.50, 100);")
    cur.execute("SELECT peca_id FROM Pecas WHERE nome = 'Pneu Teste';")
    peca_id = cur.fetchone()[0]
    assert peca_id is not None
    
    # READ
    cur.execute(f"SELECT preco_unitario FROM F_Ler_Peca_Por_ID({peca_id});")
    preco = cur.fetchone()[0]
    assert float(preco) == 80.50
    
    # UPDATE (Stock não é atualizado aqui, usa-se P_Atualizar_Stock)
    novo_preco = 90.99
    cur.execute(f"CALL P_Atualizar_Peca({peca_id}, 'Pneu Atualizado', 'Pneu Continental', {novo_preco});")
    cur.execute(f"SELECT preco_unitario FROM F_Ler_Peca_Por_ID({peca_id});")
    preco_atualizado = cur.fetchone()[0]
    assert float(preco_atualizado) == novo_preco
    
    # DELETE
    cur.execute(f"CALL P_Remover_Peca({peca_id});")
    cur.execute(f"SELECT COUNT(*) FROM Pecas WHERE peca_id = {peca_id};")
    assert cur.fetchone()[0] == 0

### Serviços CRUD ###

def test_servico_crud(db_cursor):
    cur = db_cursor
    
    # CREATE
    cur.execute("CALL P_Criar_Servico('Revisão Geral', 'Manutenção completa', 150.00);")
    cur.execute("SELECT servico_id FROM Servico WHERE nome = 'Revisão Geral';")
    servico_id = cur.fetchone()[0]
    assert servico_id is not None
    
    # READ
    cur.execute(f"SELECT preco_base FROM F_Ler_Servico_Por_ID({servico_id});")
    preco = cur.fetchone()[0]
    assert float(preco) == 150.00
    
    # UPDATE
    novo_preco = 180.00
    cur.execute(f"CALL P_Atualizar_Servico({servico_id}, 'Revisão Plus', 'Manutenção avançada', {novo_preco});")
    cur.execute(f"SELECT preco_base FROM F_Ler_Servico_Por_ID({servico_id});")
    preco_atualizado = cur.fetchone()[0]
    assert float(preco_atualizado) == novo_preco
    
    # DELETE
    cur.execute(f"CALL P_Remover_Servico({servico_id});")
    cur.execute(f"SELECT COUNT(*) FROM Servico WHERE servico_id = {servico_id};")
    assert cur.fetchone()[0] == 0

### Ordens_Servico CRUD ###

def test_ordem_servico_crud_create_update(db_cursor):
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    matricula = 'AA-00-AA'

    # CREATE (Usando função para obter o ID)
    cur.execute(f"SELECT F_Criar_OS('{matricula}', {funcionario_id}, 'Problema de motor');")
    os_id = cur.fetchone()[0]
    assert os_id is not None
    
    # READ (Implícita via V_OS_Detalhe_Geral, que é usada em F_Ler_OS_Por_Funcionario)
    cur.execute(f"SELECT os_id, status FROM F_Ler_OS_Por_Funcionario({funcionario_id}) WHERE os_id = {os_id};")
    os_lida = cur.fetchone()
    assert os_lida is not None
    assert os_lida[1] == 'Pendente'
    
    # UPDATE
    novo_status = 'Concluída'
    cur.execute(f"CALL P_Atualizar_OS_Status({os_id}, '{novo_status}');")
    cur.execute(f"SELECT status FROM Ordens_Servico WHERE os_id = {os_id};")
    status_atualizado = cur.fetchone()[0]
    assert status_atualizado == novo_status
    
    # DELETE é testado na secção de Regras de Negócio (test_p_remover_os_reposicao_stock)

### Itens_Servico CRUD ###

def test_itens_servico_crud(db_cursor):
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    _, servico_id = setup_peca_servico(cur) # Preço base: 30.00
    
    cur.execute(f"SELECT F_Criar_OS('AA-00-AA', {funcionario_id}, 'Teste Itens Servico');") 
    os_id = cur.fetchone()[0]
    
    # CREATE
    cur.execute(f"CALL P_Add_Item_Servico({os_id}, {servico_id}, 1);")
    cur.execute(f"SELECT item_servico_id FROM Itens_Servico_OS WHERE os_id = {os_id} AND servico_id = {servico_id};")
    item_servico_id = cur.fetchone()[0]
    
    # READ
    cur.execute(f"SELECT quantidade FROM F_Ler_Itens_Servico_Por_OS({os_id}) WHERE item_servico_id = {item_servico_id};")
    quantidade = cur.fetchone()[0]
    assert quantidade == 1
    
    # UPDATE
    nova_quantidade = 3
    novo_preco = 25.00
    cur.execute(f"CALL P_Atualizar_Item_Servico({item_servico_id}, {os_id}, {nova_quantidade}, {novo_preco});")
    cur.execute(f"SELECT quantidade, subtotal FROM Itens_Servico_OS WHERE item_servico_id = {item_servico_id};")
    quant_atualizada, subtotal_atualizado = cur.fetchone()
    assert quant_atualizada == nova_quantidade
    assert float(subtotal_atualizado) == 75.00 # 3 * 25.00
    
    # DELETE
    cur.execute(f"CALL P_Remover_Item_Servico({item_servico_id}, {os_id});")
    cur.execute(f"SELECT COUNT(*) FROM Itens_Servico_OS WHERE item_servico_id = {item_servico_id};")
    assert cur.fetchone()[0] == 0

### Pecas_Usadas CRUD ###

def test_pecas_usadas_crud(db_cursor):
    cur = db_cursor
    _, funcionario_id = setup_prerequisitos(cur)
    peca_id, _ = setup_peca_servico(cur) # Peça: 10.00, Stock: 50
    
    cur.execute(f"SELECT F_Criar_OS('AA-00-AA', {funcionario_id}, 'Teste Pecas Usadas');") 
    os_id = cur.fetchone()[0]
    
    # CREATE (Baixa stock de 50 para 48)
    cur.execute(f"CALL P_Add_Peca_Usada({os_id}, {peca_id}, 2);")
    cur.execute(f"SELECT peca_usada_id FROM Pecas_Usadas_OS WHERE os_id = {os_id} AND peca_id = {peca_id};")
    peca_usada_id = cur.fetchone()[0]
    
    # READ
    cur.execute(f"SELECT quantidade FROM F_Ler_Pecas_Usadas_Por_OS({os_id}) WHERE peca_usada_id = {peca_usada_id};")
    quantidade = cur.fetchone()[0]
    assert quantidade == 2
    
    # UPDATE (Muda de 2 para 5. Stock vai de 48 para 45. Diferença a remover: 3)
    nova_quantidade = 5
    novo_preco = 12.00
    cur.execute(f"CALL P_Atualizar_Peca_Usada({peca_usada_id}, {os_id}, {nova_quantidade}, {novo_preco});")
    cur.execute(f"SELECT quantidade, subtotal FROM Pecas_Usadas_OS WHERE peca_usada_id = {peca_usada_id};")
    quant_atualizada, subtotal_atualizado = cur.fetchone()
    
    assert quant_atualizada == nova_quantidade
    assert float(subtotal_atualizado) == 60.00 # 5 * 12.00
    
    cur.execute(f"SELECT stock FROM Pecas WHERE peca_id = {peca_id};")
    assert cur.fetchone()[0] == 45 # 50 (inicial) - 5 (final)
    
    # DELETE (Repõe stock de 45 para 50, com base na quantidade eliminada: 5)
    cur.execute(f"CALL P_Remover_Peca_Usada({peca_usada_id}, {os_id});")
    cur.execute(f"SELECT COUNT(*) FROM Pecas_Usadas_OS WHERE peca_usada_id = {peca_usada_id};")
    assert cur.fetchone()[0] == 0

    cur.execute(f"SELECT stock FROM Pecas WHERE peca_id = {peca_id};")
    assert cur.fetchone()[0] == 50 # Stock reposto