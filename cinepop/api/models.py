from django.db import models

class Utilizador(models.Model):
    nome = models.CharField(max_length=50)
    password = models.CharField(max_length=30)

    def __str__(self):
        return self.nome

class Produtos(models.Model):
    nome = models.CharField(max_length=50)
    marca = models.CharField(max_length=10)
    stock = models.IntegerField()
    preco = models.FloatField()

    def __str__(self):
        return self.nome
    def __str__(self):
        return self.marca

class Filmes(models.Model):
    nome = models.CharField(max_length=20)
    data_estreia = models.DateField()
    data_expira = models.DateField()

    def __str__(self):
        return self.nome

