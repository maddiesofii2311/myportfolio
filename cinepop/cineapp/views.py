from django.urls import path
from django.shortcuts import render
from django.http import HttpResponse
from django.views.generic import TemplateView
from django.views.generic.edit import CreateView

from api.models import Utilizador

from django.urls import reverse_lazy



##################INDEX########################
class IndexView(TemplateView): #busca o index e redireciona para o site
    template_name = "index.html"

class GenericView(TemplateView):
    template_name = "generic.html"

class LoginView(TemplateView):
    template_name = "login.html"

class RegistarView(TemplateView):
    template_name = "registar.html"

class CheckView(TemplateView):
    template_name = "check"

class ElementsView(TemplateView):
    template_name = "elements.html"


##################PAGINAS########################


class BuyView(TemplateView):
    template_name = "buy.html"

class ComidaView(TemplateView):
    template_name = "comida.html"

class CompraView(TemplateView):
    template_name = "compra.html"

class Compra1View(TemplateView):
    template_name = "compra1.html"

class CompraBarView(TemplateView):
    template_name = "comprabar.html"

class FaturaView(TemplateView):
    template_name = "fatura.html"

class FoodView(TemplateView):
    template_name = "food.html"

class FilmesView(TemplateView):
    template_name = "filmes.html"

class PagamentoView(TemplateView):
    template_name = "pagamento.html"

class PeliculasView(TemplateView):
    template_name = "peliculas.html"
    
class PrecosView(TemplateView):
    template_name = "precos.html"

class Sessao1View(TemplateView):
    template_name = "sessao1.html"

class Sessao2View(TemplateView):
    template_name = "sessao2.html"


##################FILMES########################

class AddpView(TemplateView):
    template_name = "addp.html"

class AfdlView(TemplateView):
    template_name = "afdl.html"

class AmrView(TemplateView):
    template_name = "amr.html"

class ArsView(TemplateView):
    template_name = "ars.html"

class BaView(TemplateView):
    template_name = "ba.html"

class BarView(TemplateView):
    template_name = "bar.html"

class BpopView(TemplateView):
    template_name = "bpop.html"

class BslgView(TemplateView):
    template_name = "bslg.html"

class BtcbView(TemplateView):
    template_name = "btcb.html"

class BvamdoView(TemplateView):
    template_name = "bvamdo.html"

class CView(TemplateView):
    template_name = "c.html"

class CdfView(TemplateView):
    template_name = "cdf.html"

class DldspView(TemplateView):
    template_name = "dldsp.html"

class HofView(TemplateView):
    template_name = "hof.html"

class M2aadgView(TemplateView):
    template_name = "m2aadg.html"

class MoviesView(TemplateView):
    template_name = "movies.html"

class NtpqView(TemplateView):
    template_name = "ntpq.html"

class OaoView(TemplateView):
    template_name = "oao.html"

class OcView(TemplateView):
    template_name = "oc.html"

class OsView(TemplateView):
    template_name = "os.html"

class RaaView(TemplateView):
    template_name = "raa.html"

class RdvView(TemplateView):
    template_name = "rdv.html"

class SView(TemplateView):
    template_name = "s.html"

class TdtView(TemplateView):
    template_name = "tdt.html"

class TgmView(TemplateView):
    template_name = "tgm.html"

class UpenhView(TemplateView):
    template_name = "upenh.html"
