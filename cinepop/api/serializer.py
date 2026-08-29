from rest_framework import serializers
from api.models import Utilizador, Produtos, Filmes

class UtilizadorSerializer(serializers.ModelSerializer):
    class Meta:
        model = Utilizador
        fields = ['id', 'nome', 'password']
        template_name = 'api/admin.html'

class ProdutosSerializer(serializers.ModelSerializer):
    class Meta:
        model = Produtos
        fields = ['id', 'nome', 'marca', 'stock', 'preco']
        template_name = 'api/admin.html'

class FilmesSerializer(serializers.ModelSerializer):
    class Meta:
        model = Filmes
        fields = ['id', 'nome', 'data_estreia', 'data_expira']
        template_name = 'api/admin.html'


# serialize controla e envia os dados para a api, podemos manuesear os fields