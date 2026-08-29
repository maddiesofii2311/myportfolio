import json
from django.http import JsonResponse
from django.shortcuts import render, redirect, get_object_or_404
from django.contrib import messages
from .models import Funcionario, OrdemServico, Veiculo, Itens_Servico, Servico, Pecas, Pecas_Usadas, Clientes, Faturas_Pagamentos
from django.contrib.auth import logout
from django.db.models import Q, Sum, Max
from django.utils import timezone
import hashlib

# PÁGINAS

def opening_page(request):
    #Renderiza a página inicial/de abertura (que contém o botão de Login).
    return render(request, 'trabproject28335/index.html')
    
def login_page(request):
    # Só tenta fazer login se o utilizador clicar no botão (POST)
    if request.method == 'POST':
        f_id = request.POST.get('f_id')
        f_pass = request.POST.get('f_pass')

        if not f_id or not f_pass:
            messages.error(request, "Por favor, preencha todos os campos.")
            return render(request, 'trabproject28335/login.html')

        # 1. Gerar o hash MD5 da password digitada para comparação
        pass_hash = hashlib.md5(f_pass.encode('utf-8')).hexdigest()

        # 2. Tentar encontrar o funcionário (Primeiro com MD5, depois texto limpo)
        # Usamos .filter().first() em vez de .get() para evitar que o erro pare logo o código
        user = Funcionario.objects.filter(funcionario_id=f_id, palavra_passe=pass_hash).first()

        if not user:
            # Se não encontrou com MD5, tenta com a password em texto limpo (funcionários antigos)
            user = Funcionario.objects.filter(funcionario_id=f_id, palavra_passe=f_pass).first()
            
            # Migração automática: se encontrou em texto limpo, atualiza para MD5
            if user:
                user.palavra_passe = pass_hash
                user.save()

        # 3. Se encontrámos o utilizador por qualquer um dos métodos
        if user:
            # Guarda na sessão
            request.session['user_id'] = user.funcionario_id
            request.session['nome'] = user.nome
            
            # Redirecionamento baseado no cargo
            if user.cargo == 'AdmGes' or user.cargo == 'admGes':
                return redirect('dashboardAdmGes')
            elif user.cargo == 'Funcionário' or user.cargo == 'funcionario':
                return redirect('dashboardFuncionario')
            else:
                messages.error(request, "Cargo não reconhecido.")
        else:
            # Se 'user' continuar a ser None, as credenciais estão erradas
            messages.error(request, "Número de Funcionário ou Password incorretos.")

    # Se for GET (abrir a página), apenas mostra o form limpo
    return render(request, 'trabproject28335/login.html')

def dashboardFuncionario_page(request):
    #nome = request.session.get('nome', 'Funcionário')
    # 1. Pegar o ID do funcionário que está logado na sessão
    funcionario_id = request.session.get('user_id')
    nome = request.session.get('nome')

    # 2. Pegar o termo de pesquisa do URL
    search_query = request.GET.get('search', '')

    # 3. Ir buscar as OS's deste funcionário na base de dados
    # Filtramos pelo ID do funcionário para não ver as OS de outros
    ordens = OrdemServico.objects.filter(funcionario_id=funcionario_id).order_by('-data_abertura')

    # 4. Se o utilizador escreveu algo, filtramos mais
    if search_query:
        ordens = ordens.filter(
            Q(veiculo__matricula__icontains=search_query) | 
            Q(descricao_problema__icontains=search_query) |
            Q(os_id__icontains=search_query)
        )

    # 5. Enviar a lista "ordens" para o HTML
    context = {
        'nome': nome,
        'ordens': ordens
    }
    #Renderiza a página do dashboard do funcionário.
    return render(request, 'trabproject28335/dashboardFuncionario.html', context)

def minhasOSFuncionarios_page(request):
    # 1. Recuperar o ID do funcionário logado na sessão
    f_id = request.session.get('user_id')
    
    if not f_id:
        return redirect('home')

    # 2. Filtrar as OS onde o funcionário é o que está logado
    ordens = OrdemServico.objects.filter(funcionario_id=f_id).order_by('-data_abertura')

    context = {
        'ordens': ordens,
        'nome': request.session.get('nome')
    }
    #Renderiza a página de "Minhas Ordens de Serviço" para funcionários.
    return render(request, 'trabproject28335/minhasOSFuncionarios.html', context)

def addOSFuncionario_page(request):
    if request.method == 'POST':
        # 1. Pegar os dados do formulário
        veiculo_id = request.POST.get('idVeiculo')
        status = request.POST.get('status')
        data_abertura = request.POST.get('dataAbertura')
        descricao = request.POST.get('descricaoProblema')
        
        # 2. Pegar o funcionário que está logado na sessão
        f_id = request.session.get('user_id')

        try:
            # 1. Procurar o último ID e somar 1
            ultima_os = OrdemServico.objects.order_by('os_id').last()
            proximo_id = (ultima_os.os_id + 1) if ultima_os else 1
            # 2. Criar com o novo ID
            nova_os = OrdemServico.objects.create(
                os_id=proximo_id, # Enviamos o ID manualmente
                veiculo_id=request.POST.get('idVeiculo'),
                funcionario_id=request.session.get('user_id'),
                data_abertura=request.POST.get('dataAbertura'),
                status=request.POST.get('status'),
                descricao_problema=request.POST.get('descricaoProblema')
            )
            return redirect('dashboardFuncionario')
            
        except Exception as e:
            print(f"Erro ao salvar: {e}")
            messages.error(request, "Erro ao criar a Ordem de Serviço. Verifique os dados e tente novamente.")
    #Renderiza a página de adição de Ordens de Serviço para funcionários.
    return render(request, 'trabproject28335/addOSFuncionario.html')

def veiculosFuncionarios_page(request):
    termo_pesquisa = request.GET.get('search')
    # Procura todos os veículos na base de dados
    lista_veiculos = Veiculo.objects.all() 

    #Se o utilizador escreveu algo, filtra por matrícula
    if termo_pesquisa:
        # icontains ignora maiúsculas/minúsculas
        lista_veiculos = lista_veiculos.filter(matricula__icontains=termo_pesquisa)
    
    context = {
        'veiculos': lista_veiculos
    }

    #Renderiza a página de "Veículos" para funcionários.
    return render(request, 'trabproject28335/veiculosFuncionarios.html', context)

def itensServicoFuncionario_page(request):
    if request.method == "POST":
        os_id = request.POST.get('os_id')
        serv_id = request.POST.get('servico_id')
        qtd = request.POST.get('quantidade')
        
        # 1. Limpeza do Preço (Remove '500,00 €' para '500.00')
        preco_raw = request.POST.get('preco_unitario')
        preco_limpo = preco_raw.replace('€', '').replace(',', '.').replace(' ', '').strip()
        
        # 2. Limpeza do Subtotal
        subtotal_raw = request.POST.get('subtotal')
        subtotal_limpo = subtotal_raw.replace('€', '').replace(',', '.').replace(' ', '').strip()

        # 3. Obter as instâncias dos modelos
        ordem = get_object_or_404(OrdemServico, pk=os_id)
        servico = get_object_or_404(Servico, pk=serv_id)

        # 4. Gravar na Base de Dados
        Itens_Servico.objects.create(
            ordem_servico=ordem,
            servico=servico,
            quantidade=int(qtd),
            preco_unitario=float(preco_limpo),
            subtotal=float(subtotal_limpo)
        )
    #Renderiza a página de Itens de Serviço para funcionários.
    return render(request, 'trabproject28335/itensServicoFuncionario.html')

def servicosFuncionario_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_servicos = Servico.objects.all()
    context = {
        'servicos': lista_servicos,
    }
    #Renderiza a página de Serviços para funcionários.
    return render(request, 'trabproject28335/servicosFuncionario.html', context)

def pecasUsadasFuncionario_page(request):
    if request.method == "POST":
        # 1. Capturar os dados do POST
        os_id = request.POST.get('os_id')
        peca_id_from = request.POST.get('peca_id')
        qtd_raw = request.POST.get('quantidade')
        preco_raw = request.POST.get('preco_unitario') 

        # 2. FUNÇÃO DE LIMPEZA (Garante que vira número)
        def limpar_decimal(valor_str):
            if not valor_str: return 0.0
            # Remove €, espaços e troca vírgula por ponto
            limpo = str(valor_str).replace('€', '').replace(',', '.').replace('\xa0', '').strip()
            try:
                return float(limpo)
            except ValueError:
                return 0.0

        # Limpar os valores logo no início
        preco_limpo = limpar_decimal(preco_raw)
        subtotal_raw = request.POST.get('subtotal')
        subtotal_limpo = limpar_decimal(subtotal_raw)

        # 3. Obter instâncias
        ordem = get_object_or_404(OrdemServico, pk=os_id)
        peca_obj = get_object_or_404(Pecas, pk=peca_id_from)
        qtd = int(qtd_raw)

        # Limpeza preventiva no objeto Peça (evita erros no save() da peça)
        if hasattr(peca_obj, 'preco') and isinstance(peca_obj.preco, str):
            peca_obj.preco = limpar_decimal(peca_obj.preco)

        # 4. Validação de Stock
        if peca_obj.stock < qtd:
            messages.error(request, f"Stock insuficiente! Disponível: {peca_obj.stock}")
        else:
            # 5. get_or_create com valores já limpos
            peca_usada, created = Pecas_Usadas.objects.get_or_create(
                ordem_servico=ordem,
                peca=peca_obj,
                defaults={
                    'quantidade': qtd,
                    'preco_unitario': preco_limpo, 
                    'subtotal': subtotal_limpo     
                }
            )

            if not created:
                # Se já existia, forçamos o valor limpo antes de somar
                peca_usada.quantidade += qtd
                peca_usada.preco_unitario = preco_limpo 
                peca_usada.subtotal = float(peca_usada.quantidade) * preco_limpo
                peca_usada.save()

            # 6. Atualizar Stock e Salvar Peça
            peca_obj.stock -= qtd
            peca_obj.save() 
            
            messages.success(request, "Registo processado com sucesso!")

    return render(request, 'trabproject28335/pecasUsadasFuncionario.html')

def pecasFuncionario_page(request):
    # Procurar todas as peças disponíveis na BD
    lista_pecas = Pecas.objects.all()
    context = {
        'pecas': lista_pecas,
    }
    #Renderiza a página de Peças para funcionários.
    return render(request, 'trabproject28335/pecasFuncionario.html', context)

def dashboardAdmGes_page(request):
    #nome = request.session.get('nome', 'Administrador')
    # TOTAL FATURADO NO MÊS
    agora = timezone.now()
    
    # Filtra faturas do mês atual e ano atual
    faturas_mes = Faturas_Pagamentos.objects.filter(
        data_emissao__month=agora.month,
        data_emissao__year=agora.year,
        status_pagamento='Pago'
    )
    
    # Soma o campo valor_total
    total_faturado = faturas_mes.aggregate(total=Sum('valor_total'))['total'] or 0
    
    # ALERTAS
    # 1. Buscar faturas pendentes (ajusta o filtro conforme o teu modelo)
    faturas_pendentes_count = Faturas_Pagamentos.objects.filter(status_pagamento='Pendente').count()
    
    # 2. Buscar peças com stock abaixo de 5
    pecas_baixo_stock = Pecas.objects.filter(stock__lt=5)

    #TABELA MINHAS OS
    # 1. Pega o ID do funcionário que está logado na sessão
    funcionario_id = request.session.get('user_id')
    nome = request.session.get('nome')

    # 2. Pegar o termo de pesquisa do URL
    search_query = request.GET.get('search', '')

    # 3. Ir buscar as OS's deste funcionário na base de dados
    # Filtramos pelo ID do funcionário para não ver as OS de outros
    ordens = OrdemServico.objects.filter(funcionario_id=funcionario_id).order_by('-data_abertura')

    # 4. Se o utilizador escreveu algo, filtramos mais
    if search_query:
        ordens = ordens.filter(
            Q(veiculo__matricula__icontains=search_query) | 
            Q(descricao_problema__icontains=search_query) |
            Q(os_id__icontains=search_query)
        )

    # 5. Enviar a lista "ordens" para o HTML
    context = {
        'total_faturado': total_faturado,
        'faturas_pendentes': faturas_pendentes_count,
        'pecas_baixo_stock': pecas_baixo_stock,
        'nome': nome,
        'ordens': ordens
    }
    #Renderiza a página do dashboard do AdmGes
    return render(request, 'trabproject28335/dashboardAdmGes.html', context)

def clientes_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_clientes = Clientes.objects.all()
    context = {
        'clientes': lista_clientes,
    }
    #Renderiza a página de Clientes para o administrador/gestor.
    return render(request, 'trabproject28335/clientes.html', context)

def addCliente_page(request):
    if request.method == "POST":
        nome = request.POST.get('nome')
        telemovel = request.POST.get('telemovel')
        email = request.POST.get('email')
        nif = request.POST.get('nif')
        morada = request.POST.get('morada')

        # 1. Procurar o maior ID atual na tabela
        max_id = Clientes.objects.aggregate(Max('cliente_id'))['cliente_id__max']
        
        # 2. Se a tabela estiver vazia, começa no 1. Se não, soma +1
        novo_id = (max_id or 0) + 1

        # 3. Cria o objeto passando o ID manualmente
        Clientes.objects.create(
            cliente_id=novo_id, 
            nome=nome,
            telemovel=telemovel,
            email=email,
            nif=nif,
            morada=morada
        )

        messages.success(request, "Cliente adicionado com sucesso!")
        return redirect('clientes')

    return render(request, 'trabproject28335/addCliente.html')

def veiculos_page(request):
    termo_pesquisa = request.GET.get('search')
    # Procura todos os veículos na base de dados
    lista_veiculos = Veiculo.objects.all() 

    #Se o utilizador escreveu algo, filtra por matrícula
    if termo_pesquisa:
        # icontains ignora maiúsculas/minúsculas
        lista_veiculos = lista_veiculos.filter(matricula__icontains=termo_pesquisa)
    
    context = {
        'veiculos': lista_veiculos
    }
    #Renderiza a página de Veículos para o administrador/gestor.
    return render(request, 'trabproject28335/veiculos.html', context)

def addVeiculos_page(request):
    if request.method == "POST":
        cliente_id = request.POST.get('idCliente')
        marca = request.POST.get('marca')
        modelo = request.POST.get('modelo')
        ano = request.POST.get('ano')
        matricula = request.POST.get('matricula')

        # 1. Procurar o maior ID atual na tabela
        max_id = Veiculo.objects.aggregate(Max('veiculo_id'))['veiculo_id__max']
        
        # 2. Se a tabela estiver vazia, começa no 1. Se não, soma +1
        novo_id = (max_id or 0) + 1

        # 3. Cria o objeto passando o ID manualmente
        Veiculo.objects.create(
            veiculo_id=novo_id,
            cliente_id=cliente_id,
            marca=marca,
            modelo=modelo,
            ano=ano,
            matricula=matricula
        )

        messages.success(request, "Veículo adicionado com sucesso!")
        return redirect('veiculos')
    #Renderiza a página de adição de Veículos.
    return render(request, 'trabproject28335/addVeiculo.html')

def funcionarios_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_funcionarios = Funcionario.objects.all()
    context = {
        'funcionarios': lista_funcionarios,
    }
    #Renderiza a página de Funcionários para o administrador/gestor.
    return render(request, 'trabproject28335/funcionarios.html', context)

def addFuncionario_page(request):
    if request.method == "POST":
        funcionario_id = request.POST.get('idFuncionario')
        nome = request.POST.get('nome')
        telemovel = request.POST.get('telemovel')
        morada = request.POST.get('morada')
        cargo = request.POST.get('cargo')
        especialidade = request.POST.get('especialidade')
        password = request.POST.get('password')

        # Cria o hash MD5 da password
        # Nota: O MD5 precisa de receber bytes, por isso usa .encode('utf-8')
        password_md5 = hashlib.md5(password.encode('utf-8')).hexdigest()

        # 3. Cria o objeto passando o ID manualmente
        Funcionario.objects.create(
            funcionario_id=funcionario_id,
            nome=nome,
            telemovel=telemovel,
            morada=morada,
            cargo=cargo,
            especialidade=especialidade,
            palavra_passe=password_md5
        )

        messages.success(request, "Funcionário adicionado com sucesso!")
        return redirect('funcionarios')
    #Renderiza a página de adição de Funcionários.
    return render(request, 'trabproject28335/addFuncionario.html')

def pecas_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_pecas = Pecas.objects.all()
    context = {
        'pecas': lista_pecas,
    }
    #Renderiza a página de Peças para o administrador/gestor.
    return render(request, 'trabproject28335/pecas.html', context)

def addPecas_page(request):
    if request.method == "POST":
        nome = request.POST.get('nome')
        # Limpar o símbolo € e converter para formato numérico
        preco_raw = request.POST.get('preco') # Recebe "95€"
        preco_limpo = preco_raw.replace('€', '').replace(',', '.').strip()
        descricao = request.POST.get('descricaoProblema')
        stock = request.POST.get('stock')

        # Gerar novo ID
        max_id = Pecas.objects.aggregate(Max('peca_id'))['peca_id__max']
        novo_id = (max_id or 0) + 1

        # Criar a peça com o preço limpo
        Pecas.objects.create(
            peca_id=novo_id,
            nome=nome,
            descricao=descricao,
            preco=preco_limpo, # Agora vai "95" em vez de "95€"
            stock=stock
        )
        
        return redirect('pecas') # Ou o nome da tua rota de listagem
    #Renderiza a página de adição de Peças.
    return render(request, 'trabproject28335/addPecas.html')

def servicos_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_servicos = Servico.objects.all()
    context = {
        'servicos': lista_servicos,
    }
    #Renderiza a página de Serviços para o administrador/gestor.
    return render(request, 'trabproject28335/servicos.html', context)

def addServicos_page(request):
    if request.method == "POST":
        nome = request.POST.get('nome')
        preco = request.POST.get('preco')
        descricao = request.POST.get('descricaoProblema')

        # Remove o símbolo € e espaços:
        preco_raw = request.POST.get('preco', '0')
        preco_limpo = preco_raw.replace('€', '').strip().replace(',', '.')

        # 1. Procurar o maior ID atual na tabela
        max_id = Servico.objects.aggregate(Max('servico_id'))['servico_id__max']
        
        # 2. Se a tabela estiver vazia, começa no 1. Se não, soma +1
        novo_id = (max_id or 0) + 1

        # 3. Cria o objeto passando o ID manualmente
        Servico.objects.create(
            servico_id=novo_id, 
            nome=nome,
            preco_base=preco_limpo,
            descricao=descricao
        )

        messages.success(request, "Serviço adicionado com sucesso!")
        return redirect('servicos')
    #Renderiza a página de adição de Serviços.
    return render(request, 'trabproject28335/addServicos.html')

def os_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_os = OrdemServico.objects.all()
    context = {
        'ordensServico': lista_os,
    }
    #Renderiza a página de Ordens de Serviço.
    return render(request, 'trabproject28335/os.html', context)

def minhasOS_page(request):
    # 1. Recuperar o ID do funcionário logado na sessão
    f_id = request.session.get('user_id')
    
    if not f_id:
        return redirect('home')

    # 2. Filtrar as OS onde o funcionário é o que está logado
    ordens = OrdemServico.objects.filter(funcionario_id=f_id).order_by('-data_abertura')

    context = {
        'minhasOS': ordens,
        'nome': request.session.get('nome')
    }
    #Renderiza a página de Minhas Ordens de Serviço.
    return render(request, 'trabproject28335/minhasOS.html', context)

def addOS_page(request):
    if request.method == 'POST':
        # 1. Pegar os dados do formulário
        veiculo_id = request.POST.get('idVeiculo')
        status = request.POST.get('status')
        data_abertura = request.POST.get('dataAbertura')
        descricao = request.POST.get('descricaoProblema')
        
        # 2. Pegar o funcionário que está logado na sessão
        f_id = request.session.get('user_id')

        try:
            # 1. Procurar o último ID e somar 1
            ultima_os = OrdemServico.objects.order_by('os_id').last()
            proximo_id = (ultima_os.os_id + 1) if ultima_os else 1
            # 2. Criar com o novo ID
            nova_os = OrdemServico.objects.create(
                os_id=proximo_id, 
                veiculo_id=request.POST.get('idVeiculo'),
                funcionario_id=request.session.get('user_id'),
                data_abertura=request.POST.get('dataAbertura'),
                status=request.POST.get('status'),
                descricao_problema=request.POST.get('descricaoProblema')
            )
            return redirect('dashboardAdmGes')
            
        except Exception as e:
            print(f"Erro ao salvar: {e}")
            messages.error(request, "Erro ao criar a Ordem de Serviço. Verifique os dados e tente novamente.")
    #Renderiza a página de adição de Ordens de Serviço.
    return render(request, 'trabproject28335/addOS.html')

def itensServico_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_is = Itens_Servico.objects.all()
    context = {
        'itens_servico': lista_is,
    }
    #Renderiza a página de Itens de Serviço.
    return render(request, 'trabproject28335/itensServico.html', context)

def addIS_page(request):
    if request.method == "POST":
        os_id = request.POST.get('os_id')
        serv_id = request.POST.get('servico_id')
        qtd = request.POST.get('quantidade')
        
        # 1. Limpeza do Preço (Remove '500,00 €' para '500.00')
        preco_raw = request.POST.get('preco_unitario')
        preco_limpo = preco_raw.replace('€', '').replace(',', '.').replace(' ', '').strip()
        
        # 2. Limpeza do Subtotal
        subtotal_raw = request.POST.get('subtotal')
        subtotal_limpo = subtotal_raw.replace('€', '').replace(',', '.').replace(' ', '').strip()

        # 3. Obter as instâncias dos modelos
        ordem = get_object_or_404(OrdemServico, pk=os_id)
        servico = get_object_or_404(Servico, pk=serv_id)

        # 4. Gravar na Base de Dados
        Itens_Servico.objects.create(
            ordem_servico=ordem,
            servico=servico,
            quantidade=int(qtd),
            preco_unitario=float(preco_limpo), 
            subtotal=float(subtotal_limpo)
        )
    #Renderiza a página de adição de Itens de Serviço.
    return render(request, 'trabproject28335/addIS.html')

def pecasUsadas_page(request):
    # Procurar todos os serviços disponíveis na BD
    lista_pu = Pecas_Usadas.objects.all()
    context = {
        'pecas_usadas': lista_pu,
    }
    #Renderiza a página de Peças Usadas.
    return render(request, 'trabproject28335/pecasUsadas.html', context)

def addPU_page(request):
    if request.method == "POST":
        # 1. Capturar os dados do POST
        os_id = request.POST.get('os_id')
        peca_id_from = request.POST.get('peca_id')
        qtd_raw = request.POST.get('quantidade')
        preco_raw = request.POST.get('preco_unitario') 

        # 2. FUNÇÃO DE LIMPEZA (Garante que vira número)
        def limpar_decimal(valor_str):
            if not valor_str: return 0.0
            # Remove €, espaços e troca vírgula por ponto
            limpo = str(valor_str).replace('€', '').replace(',', '.').replace('\xa0', '').strip()
            try:
                return float(limpo)
            except ValueError:
                return 0.0

        # Limpar os valores logo no início
        preco_limpo = limpar_decimal(preco_raw)
        subtotal_raw = request.POST.get('subtotal')
        subtotal_limpo = limpar_decimal(subtotal_raw)

        # 3. Obter instâncias
        ordem = get_object_or_404(OrdemServico, pk=os_id)
        peca_obj = get_object_or_404(Pecas, pk=peca_id_from)
        qtd = int(qtd_raw)

        # Limpeza preventiva no objeto Peça (evita erros no save() da peça)
        if hasattr(peca_obj, 'preco') and isinstance(peca_obj.preco, str):
            peca_obj.preco = limpar_decimal(peca_obj.preco)

        # 4. Validação de Stock
        if peca_obj.stock < qtd:
            messages.error(request, f"Stock insuficiente! Disponível: {peca_obj.stock}")
        else:
            # 5. get_or_create com valores já limpos
            peca_usada, created = Pecas_Usadas.objects.get_or_create(
                ordem_servico=ordem,
                peca=peca_obj,
                defaults={
                    'quantidade': qtd,
                    'preco_unitario': preco_limpo, 
                    'subtotal': subtotal_limpo     
                }
            )

            if not created:
                # Se já existia, forçamos o valor limpo antes de somar
                peca_usada.quantidade += qtd
                peca_usada.preco_unitario = preco_limpo 
                peca_usada.subtotal = float(peca_usada.quantidade) * preco_limpo
                peca_usada.save()

            # 6. Atualizar Stock e Salvar Peça
            peca_obj.stock -= qtd
            peca_obj.save() 
            
            messages.success(request, "Registo processado com sucesso!")
    #Renderiza a página de adição de Peças Usadas.
    return render(request, 'trabproject28335/addPU.html')

def emitirFatura_page(request):
    #Renderiza a página de emissão de fatura.
    return render(request, 'trabproject28335/emitirFatura.html')

def fatura_page(request, fatura_id):
    fatura = get_object_or_404(Faturas_Pagamentos, pk=fatura_id)
    # Cálculo do subtotal (soma de serviços + soma de peças)
    soma_servicos = sum(limpar_valor(item.subtotal) for item in fatura.os.itens_servico_set.all())
    soma_pecas = sum(limpar_valor(item.subtotal) for item in fatura.os.pecas_usadas_set.all())
    total_geral = soma_servicos + soma_pecas
    context = {
        'fatura': fatura,
        'soma_servicos': soma_servicos,
        'soma_pecas': soma_pecas,
        'total_geral': total_geral,
    }
    #Renderiza a página de fatura.
    return render(request, 'trabproject28335/fatura.html', context)

# Funcionalidades

def logout_view(request):
    request.session.flush() # Apaga todos os dados da sessão
    return redirect('home')

# FUNÇÃO PARA EDITAR/GRAVAR minhasOSFuncionarios
def editar_os(request, pk):
    os_instancia = get_object_or_404(OrdemServico, os_id=pk)
    if request.method == "POST":
        novo_veiculo_id = request.POST.get('veiculo_id')
        novo_data_abertura = request.POST.get('data_abertura')
        novo_data_conclusao = request.POST.get('data_conclusao')
        novo_status = request.POST.get('status')
        novo_descricao_problema = request.POST.get('descricao_problema')

        os_instancia.veiculo = novo_veiculo_id
        os_instancia.data_abertura = novo_data_abertura
        os_instancia.data_conclusao = novo_data_conclusao
        os_instancia.status = novo_status
        os_instancia.descricao_problema = novo_descricao_problema
        os_instancia.save()
        return redirect('minhasOSFuncionarios') 

# FUNÇÃO PARA REMOVER minhasOSFuncionarios
def remover_os(request, pk):
    os_instancia = get_object_or_404(OrdemServico, os_id=pk)
    os_instancia.delete()
    return redirect('minhasOSFuncionarios')

# API para o JavaScript buscar o preço do serviço
def get_preco_servico(request, servico_id):
    servico = get_object_or_404(Servico, pk=servico_id)
    return JsonResponse({'preco': str(servico.preco_base)})

# API para o JavaScript buscar o preço da peça
def get_preco_peca(request, peca_id):
    peca = get_object_or_404(Pecas, pk=peca_id)
    # Retorna o campo 'preco' conforme definido no teu modelo
    return JsonResponse({'preco': str(peca.preco)})

# API para o JavaScript buscar os dados de uma OS (cliente, veículo, funcionário, etc.) (Emitir Fatura)
def buscar_dados_os(request, os_id):
    try:
        os_obj = OrdemServico.objects.get(pk=os_id)
        servicos_da_os = Itens_Servico.objects.filter(ordem_servico=os_obj)
        pecas_da_os = Pecas_Usadas.objects.filter(ordem_servico=os_obj)
        
        lista_servicos = []
        lista_pecas = []
        total_acumulado = 0.0

        def converter_para_float(valor):
            """Transforma '120,00 €' em 120.00 para o Python somar."""
            if not valor: return 0.0
            # Remove €, espaços e troca vírgula por ponto
            limpo = str(valor).replace('€', '').replace(' ', '').replace(',', '.').strip()
            try:
                return float(limpo)
            except ValueError:
                return 0.0

        # Processar Serviços
        for item in servicos_da_os:
            valor_num = converter_para_float(item.preco_unitario) 
            lista_servicos.append({
                'nome': item.servico.nome,
                'preco': f"{valor_num:.2f}€"
            })
            total_acumulado += valor_num

        # Processar Peças
        for item in pecas_da_os:
            valor_num = converter_para_float(item.preco_unitario)
            lista_pecas.append({
                'nome': item.peca.nome,
                'preco': f"{valor_num:.2f}€"
            })
            total_acumulado += valor_num

        return JsonResponse({
            'sucesso': True,
            'dados': {
                'cliente': os_obj.veiculo.cliente.nome,
                'veiculo': f"{os_obj.veiculo.marca} {os_obj.veiculo.modelo}",
                'data_abertura': os_obj.data_abertura.strftime('%d/%m/%Y'),
                'funcionario': os_obj.funcionario.nome,
                'servicos': lista_servicos,
                'pecas': lista_pecas,
                'total': f"{total_acumulado:.2f}"
            }
        })
    except OrdemServico.DoesNotExist:
        return JsonResponse({'sucesso': False, 'mensagem': 'OS não encontrada'})
    except Exception as e:
        return JsonResponse({'sucesso': False, 'mensagem': str(e)})

# API para o JavaScript salvar a fatura na base de dados (Emitir Fatura)    
def emitir_fatura_save(request):
    if request.method == 'POST':
        try:
            data = json.loads(request.body)
            
            # 1. Buscar a instância da OS
            os_instancia = OrdemServico.objects.get(os_id=data['os_id'])
            
            # 2. CALCULAR O PRÓXIMO fatura_id
            # Busca o valor máximo atual de fatura_id. Se a tabela estiver vazia, usa 0.
            max_id = Faturas_Pagamentos.objects.aggregate(Max('fatura_id'))['fatura_id__max']
            novo_id = (max_id or 0) + 1
            
            # 3. Criar a fatura na base de dados com o ID manual
            nova_fatura = Faturas_Pagamentos.objects.create(
                fatura_id=novo_id, 
                os=os_instancia,
                data_emissao=data['data_emissao'],
                valor_total=float(data['valor_total']),
                forma_pagamento=data['forma_pagamento'],
                status_pagamento=data['status_pagamento']
            )
            
            return JsonResponse({'sucesso': True, 'fatura_id': nova_fatura.fatura_id})
            
        except OrdemServico.DoesNotExist:
            return JsonResponse({'sucesso': False, 'mensagem': 'Ordem de Serviço não encontrada.'})
        except Exception as e:
            return JsonResponse({'sucesso': False, 'mensagem': str(e)})

# Função auxiliar para limpar valores monetários
def limpar_valor(valor_str):
    """Remove '€', troca ',' por '.' e limpa espaços para converter em float."""
    if not valor_str:
        return 0.0
    try:
        # Remove o símbolo do Euro e espaços
        limpo = str(valor_str).replace('€', '').strip()
        # Troca a vírgula decimal por ponto
        limpo = limpo.replace(',', '.')
        return float(limpo)
    except ValueError:
        return 0.0