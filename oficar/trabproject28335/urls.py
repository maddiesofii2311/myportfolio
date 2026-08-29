from django.urls import path
from . import views

urlpatterns = [
    #Páginas
    path('', views.opening_page, name='home'),  #index.html - página opening
    path('login/', views.login_page, name='login'),  #login.html - página de login
    path('dashboardFuncionario/', views.dashboardFuncionario_page, name='dashboardFuncionario'),  #dashboardFuncionario.html - página do dashboard do funcionário
    path('dashboardAdmGes/', views.dashboardAdmGes_page, name='dashboardAdmGes'),  #dashboardAdmGes.html - página do dashboard do administrador/gestor
    path('minhasOSFuncionarios/', views.minhasOSFuncionarios_page, name='minhasOSFuncionarios'),  #minhasOSFuncionarios.html - página de "Minhas Ordens de Serviço" para funcionários
    path('veiculosFuncionarios/', views.veiculosFuncionarios_page, name='veiculosFuncionarios'),  #veiculosFuncionarios.html - página de "Veículos" para funcionários
    path('addOSFuncionario/', views.addOSFuncionario_page, name='addOSFuncionario'),  #addOSFuncionario.html - página de adição de Ordens de Serviço para funcionários
    path('itensServicoFuncionario/', views.itensServicoFuncionario_page, name='itensServicoFuncionario'),  #itensServicoFuncionario.html - página de Itens de Serviço para funcionários
    path('pecasUsadasFuncionario/', views.pecasUsadasFuncionario_page, name='pecasUsadasFuncionario'),  #pecasUsadasFuncionario.html - página de Peças Usadas para funcionários
    path('servicosFuncionario/', views.servicosFuncionario_page, name='servicosFuncionario'),  #servicosFuncionario.html - página de Serviços para funcionários
    path('pecasFuncionario/', views.pecasFuncionario_page, name='pecasFuncionario'),  #pecasFuncionario.html - página de Peças para funcionários
    path('clientes/', views.clientes_page, name='clientes'),  #clientes.html - página de Clientes para o administrador/gestor
    path('funcionarios/', views.funcionarios_page, name='funcionarios'),  #funcionarios.html - página de Funcionários para o administrador/gestor
    path('pecas/', views.pecas_page, name='pecas'),  #pecas.html - página de Peças para o administrador/gestor
    path('veiculos/', views.veiculos_page, name='veiculos'),  #veiculos.html - página de Veículos para o administrador/gestor
    path('servicos/', views.servicos_page, name='servicos'),  #servicos.html - página de Serviços para o administrador/gestor
    path('os/', views.os_page, name='os'),  #os.html - página de Ordens de Serviço
    path('minhasOS/', views.minhasOS_page, name='minhasOS'),  #minhasOS.html - página de Minhas Ordens de Serviço
    path('itensServico/', views.itensServico_page, name='itensServico'),  #itensServico.html - página de Itens de Serviço
    path('pecasUsadas/', views.pecasUsadas_page, name='pecasUsadas'),  #pecasUsadas.html - página de Peças Usadas
    path('addOS/', views.addOS_page, name='addOS'),  #addOS.html - página de Adicionar Ordem de Serviço
    path('addServicos/', views.addServicos_page, name='addServicos'),  #addServicos.html - página de Adicionar Serviços
    path('addPecas/', views.addPecas_page, name='addPecas'),  #addPecas.html - página de Adicionar Peças
    path('addFuncionario/', views.addFuncionario_page, name='addFuncionario'),  #addFuncionario.html - página de Adicionar Funcionário
    path('addVeiculo/', views.addVeiculos_page, name='addVeiculos'),  #addVeiculo.html - página de Adicionar Veículo
    path('addCliente/', views.addCliente_page, name='addCliente'),  #addCliente.html - página de Adicionar Cliente
    path('addIS/', views.addIS_page, name='addIS'),  #addIS.html - página de Adicionar Itens de Serviço
    path('addPU/', views.addPU_page, name='addPU'),  #addPU.html - página de Adicionar Peças Usadas
    path('emitirFatura/', views.emitirFatura_page, name='emitirFatura'),  #emitirFatura.html - página de Emitir Fatura
    path('fatura/<int:fatura_id>/', views.fatura_page, name='fatura'),  #fatura.html - página de Fatura
    #Funcionalidades
    path('logout/', views.logout_view, name='logout'),  #logout - para encerrar a sessão
    path('editar-os/<int:pk>/', views.editar_os, name='editar_os'),
    path('remover-os/<int:pk>/', views.remover_os, name='remover_os'),
    path('get-preco-servico/<int:servico_id>/', views.get_preco_servico),
    path('get-preco-peca/<int:peca_id>/', views.get_preco_peca),
    path('buscar-os/<int:os_id>/', views.buscar_dados_os, name='buscar_os'),
    path('emitir-fatura-save/', views.emitir_fatura_save, name='emitir_fatura_save'),
]