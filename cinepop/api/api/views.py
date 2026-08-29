from django.shortcuts import render
from rest_framework import viewsets
from api.models import Utilizador, Produtos, Filmes
from api.serializer import UtilizadorSerializer, ProdutosSerializer, FilmesSerializer



class UtilizadoresViewSet(viewsets.ModelViewSet):
    queryset = Utilizador.objects.all() #exibe todos os utilizadores ativos
    serializer_class = UtilizadorSerializer #busca o class do serializer

class ProdutosViewSet(viewsets.ModelViewSet):
        queryset = Produtos.objects.all()
        serializer_class = ProdutosSerializer 

class FilmesViewSet(viewsets.ModelViewSet):
        queryset = Filmes.objects.all()
        serializer_class = FilmesSerializer 



#podemos fazer de forma manual a utilização do post, get, put e delete
