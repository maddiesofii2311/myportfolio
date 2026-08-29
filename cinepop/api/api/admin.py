from django.contrib import admin
from api.models import Utilizador, Produtos, Filmes


class Utilizadores(admin.ModelAdmin):
    list_display = ('id', 'nome', 'password') 
    #mostra os campos do BD
    list_display_links = ('id', 'nome')
    #campos que pode manipular no BD
    search_fields = ('nome',)
    #visualizar e buscar nomes

class Produto(admin.ModelAdmin):
    list_display = ('id', 'nome', 'marca', 'stock', 'preco') 
    #mostra os campos do BD
    list_display_links = ('id', 'nome', 'marca', 'stock', 'preco')
    #campos que pode manipular no BD
    search_fields = ('id', 'nome', 'marca', 'stock', 'preco')

class Filme(admin.ModelAdmin):
    list_display = ('id', 'nome', 'data_estreia', 'data_expira') 
    #mostra os campos do BD
    list_display_links = ('id', 'nome', 'data_estreia', 'data_expira')
    #campos que pode manipular no BD
    search_fields = ('id', 'nome', 'data_estreia', 'data_expira')



admin.site.register(Utilizador, Utilizadores)
admin.site.register(Produtos, Produto)
admin.site.register(Filmes, Filme)