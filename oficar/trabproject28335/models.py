from django.db import models

class Clientes(models.Model):
    cliente_id = models.AutoField(primary_key=True)
    nome = models.CharField(max_length=15)
    telemovel = models.IntegerField(null=False)
    email = models.CharField(max_length=30)
    morada = models.CharField(max_length=50)
    nif = models.IntegerField(unique=True) 

    class Meta:
        managed = False # Não permite a criação/alteração desta tabela
        db_table = 'clientes' # Nome da tabela no PostgreSQL

    def __str__(self):
        return self.nome
    
class Veiculo(models.Model):
    veiculo_id = models.AutoField(primary_key=True)
    # FK para a tabela Clientes
    cliente = models.ForeignKey(Clientes, models.DO_NOTHING, db_column='cliente_id')
    marca = models.CharField(max_length=15)
    modelo = models.CharField(max_length=15)
    ano = models.IntegerField()
    matricula = models.CharField(max_length=10, unique=True)

    class Meta:
        managed = False
        db_table = 'veiculos'

    def __str__(self):
        return self.matricula

class Funcionario(models.Model):
    funcionario_id = models.IntegerField(primary_key=True)
    nome = models.CharField(max_length=15)
    cargo = models.CharField(max_length=20)
    telemovel = models.IntegerField(null=False)
    morada = models.CharField(max_length=30)
    especialidade = models.CharField(max_length=20)
    palavra_passe = models.CharField(max_length=128) # Armazena o hash MD5 da password
    

    class Meta:
        managed = False
        db_table = 'funcionarios'

    def __str__(self):
        return self.nome
    
class OrdemServico(models.Model):
    os_id = models.IntegerField(primary_key=True)
    veiculo = models.ForeignKey(Veiculo, models.DO_NOTHING, db_column='veiculo_id')
    funcionario = models.ForeignKey(Funcionario, models.DO_NOTHING, db_column='funcionario_id')
    data_abertura = models.DateField()
    data_conclusao = models.DateField(null=True, blank=True)
    status = models.CharField(max_length=20)
    descricao_problema = models.CharField(max_length=150)

    class Meta:
        managed = False
        db_table = 'ordens_servico'

    def __str__(self):
        return f"Ordem {self.os_id} - Veículo {self.veiculo.matricula}"

class Faturas_Pagamentos(models.Model):
    fatura_id = models.AutoField(primary_key=True)
    os = models.ForeignKey(OrdemServico, models.DO_NOTHING, db_column='os_id')
    data_emissao = models.DateField()
    valor_total = models.DecimalField(max_digits=10, decimal_places=2) 
    forma_pagamento = models.CharField(max_length=20)
    status_pagamento = models.CharField(max_length=20)

    class Meta:
        managed = False
        db_table = 'faturas_pagamentos'

    def __str__(self):
        return f"Fatura {self.fatura_id} - Ordem {self.ordem_servico.os_id}"

class Pecas(models.Model):
    peca_id = models.IntegerField(primary_key=True)
    nome = models.CharField(max_length=15)
    descricao = models.CharField(max_length=100)
    preco = models.DecimalField(max_digits=10, decimal_places=2, db_column='preco_unitario') 
    stock = models.IntegerField()

    class Meta:
        managed = False
        db_table = 'pecas'

    def __str__(self):
        return self.nome
    
class Pecas_Usadas(models.Model):
    ordem_servico = models.ForeignKey(OrdemServico, primary_key=True, on_delete=models.CASCADE, db_column='os_id')
    peca = models.ForeignKey(Pecas, models.DO_NOTHING, db_column='peca_id')
    quantidade = models.IntegerField()
    preco_unitario = models.DecimalField(max_digits=10, decimal_places=2)
    subtotal = models.DecimalField(max_digits=10, decimal_places=2)

    class Meta:
        managed = False
        db_table = 'pecas_usadas_os'
        # Define uma chave primária composta
        unique_together = (('ordem_servico', 'peca'),)

    def __str__(self):
        return f"OS {self.ordem_servico.os_id} - Peça: {self.peca.nome} ({self.quantidade} un.)"

class Servico(models.Model):
    servico_id = models.IntegerField(primary_key=True)
    nome = models.CharField(max_length=50)
    descricao = models.CharField(max_length=150)
    # Usa-se DecimalField para o tipo MONEY do PostgreSQL
    preco_base = models.DecimalField(max_digits=10, decimal_places=2) 

    class Meta:
        managed = False
        db_table = 'servico'

    def __str__(self):
        return self.nome

class Itens_Servico(models.Model):
    ordem_servico = models.ForeignKey(OrdemServico, primary_key=True, on_delete=models.CASCADE, db_column='os_id')
    servico = models.ForeignKey(Servico, models.DO_NOTHING, db_column='servico_id')
    quantidade = models.IntegerField()
    preco_unitario = models.DecimalField(max_digits=10, decimal_places=2)
    subtotal = models.DecimalField(max_digits=10, decimal_places=2)
    
    class Meta:
        managed = False
        db_table = 'itens_servico_os'
        unique_together = (('ordem_servico', 'servico'),)

    def __str__(self):
        return f"OS {self.ordem_servico.os_id} - Serviço: {self.servico.nome}"