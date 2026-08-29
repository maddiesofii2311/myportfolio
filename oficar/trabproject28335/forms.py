# Para inserir dados da base de dados

from django import forms
from .models import Clientes, Veiculo, Funcionario, OrdemServico, Faturas_Pagamentos, Pecas, Pecas_Usadas, Servico, Itens_Servico

# Formulário para Clientes
class ClienteForm(forms.ModelForm):
    class Meta:
        model = Clientes
        fields = ['cliente_id', 'nome', 'telemovel', 'email', 'morada', 'nif']

# Formulário para Veículos
class VeiculoForm(forms.ModelForm):
    class Meta:
        model = Veiculo
        fields = ['veiculo_id', 'cliente', 'marca', 'modelo', 'ano','matricula']

# Formulário para Funcionários
class FuncionarioForm(forms.ModelForm):
    class Meta:
        model = Funcionario
        fields = ['funcionario_id', 'nome', 'cargo', 'telemovel', 'morada', 'especialidade']

# Formulário para Ordens de Serviço
class OrdemServicoForm(forms.ModelForm):
    class Meta:
        model = OrdemServico
        fields = ['os_id', 'veiculo', 'funcionario', 'data_abertura', 'data_conclusao', 'status', 'descricao_problema']

# Formulário para Faturas e Pagamentos
class FaturasPagamentosForm(forms.ModelForm):
    class Meta:
        model = Faturas_Pagamentos
        fields = ['fatura_id', 'os', 'data_emissao', 'valor_total', 'status_pagamento']

# Formulário para Peças
class PecasForm(forms.ModelForm):
    class Meta:
        model = Pecas
        fields = ['peca_id', 'nome', 'descricao', 'stock', 'preco']

class PecasUsadasForm(forms.ModelForm):
    class Meta:
        model = Pecas_Usadas
        fields = ['ordem_servico','peca', 'quantidade', 'preco_unitario', 'subtotal']

# Formulário para Serviços
class ServicoForm(forms.ModelForm):
    class Meta:
        model = Servico
        fields = ['servico_id', 'nome', 'descricao', 'preco_base']

# Formulário para Itens de Serviço
class ItensServicoForm(forms.ModelForm):
    class Meta:
        model = Itens_Servico
        fields = ['ordem_servico', 'servico', 'quantidade', 'preco_unitairo', 'subtotal']