from django.contrib import admin
from django.urls import path, include
from api.views import UtilizadoresViewSet, ProdutosViewSet, FilmesViewSet
from rest_framework import routers


router = routers.DefaultRouter() #conecta recursos em visualizações e urls de forma automatica
router.register(r'utilizadores', UtilizadoresViewSet, basename='utilizadores')
router.register(r'produtos', ProdutosViewSet, basename='produtos')
router.register(r'filmes', FilmesViewSet, basename='filmes')

urlpatterns = [
    path('admin/', admin.site.urls),
    path('api/', include(router.urls)),
    path('', include('cineapp.urls')),
]



#manipula a pagina do admin