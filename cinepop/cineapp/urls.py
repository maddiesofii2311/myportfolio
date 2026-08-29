from django.urls import path

from .views import UtilizadorCreate

from .views import IndexView, GenericView, LoginView, RegistarView, CheckView, ElementsView, BuyView, ComidaView, CompraView, Compra1View, CompraBarView, FaturaView, FoodView, PagamentoView, PeliculasView, FilmesView, PrecosView, Sessao1View, Sessao2View, AddpView, AfdlView, AmrView, ArsView, BaView, BarView, BpopView, BslgView, BtcbView, CView, CdfView, HofView,M2aadgView, MoviesView, NtpqView, OaoView, OcView, OsView, RaaView, RdvView, SView, TdtView, TgmView, UpenhView, BvamdoView, DldspView




urlpatterns = [
    path('registar/', UtilizadorCreate.as_view(), name='registar'),
    path('', IndexView.as_view(), name='index'),
    path('generic/', GenericView.as_view(), name='generic'),
    path('login/', LoginView.as_view(), name='login'),
    path('registar/', RegistarView.as_view(), name='registar'),
    path('check/', CheckView.as_view(), name='check'),
    path('elements/', ElementsView.as_view(), name='elements'),
    path('buy/', BuyView.as_view(), name='buy'),
    path('comida/', ComidaView.as_view(), name='comida'),
    path('compra', CompraView.as_view(), name='compra'),
    path('compra1/', Compra1View.as_view(), name='compra1'),
    path('comprabar/', CompraBarView.as_view(), name='comprabar'),
    path('fatura/', FaturaView.as_view(), name='fatura'),
    path('food/', FoodView.as_view(), name='food'),
    path('pagamento/', PagamentoView.as_view(), name='pagamento'),
    path('peliculas/', PeliculasView.as_view(), name='peliculas'),
    path('filmes/', FilmesView.as_view(), name='filmes'),
    path('precos/', PrecosView.as_view(), name='precos'),
    path('sessao1/', Sessao1View.as_view(), name='sessao1'),
    path('sessao2/', Sessao2View.as_view(), name='sessao2'),
    path('addp/', AddpView.as_view(), name='addp'),
    path('afdl/', AfdlView.as_view(), name='afdl'),
    path('amr/', AmrView.as_view(), name='amr'),
    path('ars/', ArsView.as_view(), name='ars'),
    path('ba/', BaView.as_view(), name='ba'),
    path('bar/', BarView.as_view(), name='bar'),
    path('bpop/', BpopView.as_view(), name='bpop'),
    path('bslg/', BslgView.as_view(), name='bslg'),
    path('btcb/', BtcbView.as_view(), name='btcb'),
    path('bvamdo/', TgmView.as_view(), name='bvamdo'),
    path('c/', CView.as_view(), name='c'),
    path('cdf/', CdfView.as_view(), name='cdf'),
    path('dldsp/', DldspView.as_view(), name='dldsp'),
    path('hof/', HofView.as_view(), name='hof'),
    path('m2aadg/', M2aadgView.as_view(), name='m2aadg'),
    path('movies/', MoviesView.as_view(), name='movies'),
    path('ntpq/', NtpqView.as_view(), name='ntpq'),
    path('oao/', OaoView.as_view(), name='oao'),
    path('oc/', OcView.as_view(), name='oc'),
    path('os/', OsView.as_view(), name='os'),
    path('raa/', RaaView.as_view(), name='raa'),
    path('rdv/', RdvView.as_view(), name='rdv'),
    path('s/', SView.as_view(), name='s'),
    path('tdt/', TdtView.as_view(), name='tdt'),
    path('tgm/', TgmView.as_view(), name='tgm'),
    path('upenh/', UpenhView.as_view(), name='upenh'),
]

