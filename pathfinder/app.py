import heapq
import re
import io
import requests as req
from flask import Flask, request, jsonify, send_from_directory

# OCR
try:
    import pytesseract
    from PIL import Image, ImageOps, ImageEnhance
    pytesseract.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"
    OCR_DISPONIVEL = True
except ImportError:
    OCR_DISPONIVEL = False

app = Flask(__name__, static_folder="static", template_folder="templates")

# ─────────────────────────────────────────────
#  CONFIGURAÇÃO OLLAMA
# ─────────────────────────────────────────────

OLLAMA_URL    = "http://localhost:11434/api/chat"
OLLAMA_MODELO = "llama3.1:8b"

# ─────────────────────────────────────────────
#  GRAFO E HEURÍSTICA
# ─────────────────────────────────────────────

GRAFO = {
    "Lisboa":          [("Santarém",78),("Setúbal",50),("Évora",150),("Faro",299),("Leiria",129)],
    "Porto":           [("Viana Do Castelo",71),("Vila Real",116),("Viseu",133),("Aveiro",68),("Braga",53)],
    "Braga":           [("Porto",53),("Viana Do Castelo",48),("Vila Real",137)],
    "Viana Do Castelo":[("Braga",48),("Porto",71)],
    "Coimbra":         [("Aveiro",68),("Leiria",67),("Viseu",96),("Castelo Branco",159)],
    "Aveiro":          [("Coimbra",68),("Porto",68),("Viseu",95),("Leiria",115)],
    "Leiria":          [("Coimbra",67),("Lisboa",129),("Santarém",70),("Aveiro",115)],
    "Évora":           [("Lisboa",150),("Santarém",117),("Portalegre",131),("Setúbal",103),("Beja",152)],
    "Faro":            [("Beja",152),("Setúbal",249),("Lisboa",299)],
    "Setúbal":         [("Lisboa",50),("Faro",249),("Évora",103)],
    "Guarda":          [("Vila Real",157),("Viseu",85),("Castelo Branco",106),("Bragança",202)],
    "Vila Real":       [("Guarda",157),("Viseu",110),("Porto",116),("Bragança",137),("Braga",106)],
    "Viseu":           [("Vila Real",110),("Coimbra",96),("Porto",133),("Aveiro",95),("Guarda",85)],
    "Portalegre":      [("Évora",131),("Castelo Branco",80)],
    "Beja":            [("Évora",152),("Faro",152),("Setúbal",142)],
    "Bragança":        [("Vila Real",137),("Guarda",202)],
    "Castelo Branco":  [("Coimbra",159),("Guarda",106),("Portalegre",80),("Évora",203)],
    "Santarém":        [("Lisboa",78),("Leiria",70),("Évora",117)],
}

DISTANCIAS_LINHA_RECTA = {
    "Aveiro":          {"Aveiro":0,"Beja":300,"Braga":102,"Bragança":204,"Castelo Branco":134,"Coimbra":52,"Faro":408,"Guarda":117,"Leiria":101,"Lisboa":218,"Portalegre":183,"Porto":57,"Santarém":157,"Setúbal":237,"Viana Do Castelo":118,"Vila Real":105,"Viseu":62,"Évora":239},
    "Beja":            {"Aveiro":300,"Beja":0,"Braga":396,"Bragança":432,"Castelo Branco":203,"Coimbra":249,"Faro":111,"Guarda":285,"Leiria":209,"Lisboa":136,"Portalegre":146,"Porto":355,"Santarém":153,"Setúbal":107,"Viana Do Castelo":418,"Vila Real":365,"Viseu":294,"Évora":62},
    "Braga":           {"Aveiro":102,"Beja":396,"Braga":0,"Bragança":142,"Castelo Branco":208,"Coimbra":149,"Faro":506,"Guarda":149,"Leiria":203,"Lisboa":321,"Portalegre":266,"Porto":47,"Santarém":258,"Setúbal":339,"Viana Do Castelo":37,"Vila Real":63,"Viseu":108,"Évora":334},
    "Bragança":        {"Aveiro":204,"Beja":432,"Braga":142,"Bragança":0,"Castelo Branco":229,"Coimbra":226,"Faro":542,"Guarda":147,"Leiria":287,"Lisboa":398,"Portalegre":286,"Porto":172,"Santarém":329,"Setúbal":408,"Viana Do Castelo":173,"Vila Real":100,"Viseu":160,"Évora":373},
    "Castelo Branco":  {"Aveiro":134,"Beja":203,"Braga":208,"Bragança":229,"Castelo Branco":0,"Coimbra":91,"Faro":314,"Guarda":82,"Leiria":113,"Lisboa":188,"Portalegre":60,"Porto":177,"Santarém":121,"Setúbal":189,"Viana Do Castelo":237,"Vila Real":166,"Viseu":100,"Évora":144},
    "Coimbra":         {"Aveiro":52,"Beja":249,"Braga":149,"Bragança":226,"Castelo Branco":91,"Coimbra":0,"Faro":358,"Guarda":105,"Leiria":61,"Lisboa":177,"Portalegre":134,"Porto":107,"Santarém":111,"Setúbal":192,"Viana Do Castelo":169,"Vila Real":134,"Viseu":66,"Évora":188},
    "Faro":            {"Aveiro":408,"Beja":111,"Braga":506,"Bragança":542,"Castelo Branco":314,"Coimbra":358,"Faro":0,"Guarda":395,"Leiria":312,"Lisboa":216,"Portalegre":256,"Porto":464,"Santarém":255,"Setúbal":188,"Viana Do Castelo":526,"Vila Real":476,"Viseu":405,"Évora":173},
    "Guarda":          {"Aveiro":117,"Beja":285,"Braga":149,"Bragança":147,"Castelo Branco":82,"Coimbra":105,"Faro":395,"Guarda":0,"Leiria":158,"Lisboa":258,"Portalegre":140,"Porto":134,"Santarém":189,"Setúbal":264,"Viana Do Castelo":184,"Vila Real":94,"Viseu":56,"Évora":226},
    "Leiria":          {"Aveiro":101,"Beja":209,"Braga":203,"Bragança":287,"Castelo Branco":113,"Coimbra":61,"Faro":312,"Guarda":158,"Leiria":0,"Lisboa":118,"Portalegre":129,"Porto":158,"Santarém":57,"Setúbal":136,"Viana Do Castelo":217,"Vila Real":195,"Viseu":127,"Évora":152},
    "Lisboa":          {"Aveiro":218,"Beja":136,"Braga":321,"Bragança":398,"Castelo Branco":188,"Coimbra":177,"Faro":216,"Guarda":258,"Leiria":118,"Lisboa":0,"Portalegre":161,"Porto":275,"Santarém":70,"Setúbal":30,"Viana Do Castelo":332,"Vila Real":311,"Viseu":240,"Évora":108},
    "Portalegre":      {"Aveiro":183,"Beja":146,"Braga":266,"Bragança":286,"Castelo Branco":60,"Coimbra":134,"Faro":256,"Guarda":140,"Leiria":129,"Lisboa":161,"Portalegre":0,"Porto":232,"Santarém":108,"Setúbal":153,"Viana Do Castelo":293,"Vila Real":225,"Viseu":158,"Évora":90},
    "Porto":           {"Aveiro":57,"Beja":355,"Braga":47,"Bragança":172,"Castelo Branco":177,"Coimbra":107,"Faro":464,"Guarda":134,"Leiria":158,"Lisboa":275,"Portalegre":232,"Porto":0,"Santarém":214,"Setúbal":294,"Viana Do Castelo":63,"Vila Real":76,"Viseu":82,"Évora":294},
    "Santarém":        {"Aveiro":157,"Beja":153,"Braga":258,"Bragança":329,"Castelo Branco":121,"Coimbra":111,"Faro":255,"Guarda":189,"Leiria":57,"Lisboa":70,"Portalegre":108,"Porto":214,"Santarém":0,"Setúbal":81,"Viana Do Castelo":274,"Vila Real":243,"Viseu":171,"Évora":100},
    "Setúbal":         {"Aveiro":237,"Beja":107,"Braga":339,"Bragança":408,"Castelo Branco":189,"Coimbra":192,"Faro":188,"Guarda":264,"Leiria":136,"Lisboa":30,"Portalegre":153,"Porto":294,"Santarém":81,"Setúbal":0,"Viana Do Castelo":353,"Vila Real":324,"Viseu":252,"Évora":86},
    "Viana Do Castelo":{"Aveiro":118,"Beja":418,"Braga":37,"Bragança":173,"Castelo Branco":237,"Coimbra":169,"Faro":526,"Guarda":184,"Leiria":217,"Lisboa":332,"Portalegre":293,"Porto":63,"Santarém":274,"Setúbal":353,"Viana Do Castelo":0,"Vila Real":101,"Viseu":139,"Évora":356},
    "Vila Real":       {"Aveiro":105,"Beja":365,"Braga":63,"Bragança":100,"Castelo Branco":166,"Coimbra":134,"Faro":476,"Guarda":94,"Leiria":195,"Lisboa":311,"Portalegre":225,"Porto":76,"Santarém":243,"Setúbal":324,"Viana Do Castelo":101,"Vila Real":0,"Viseu":73,"Évora":304},
    "Viseu":           {"Aveiro":62,"Beja":294,"Braga":108,"Bragança":160,"Castelo Branco":100,"Coimbra":66,"Faro":405,"Guarda":56,"Leiria":127,"Lisboa":240,"Portalegre":158,"Porto":82,"Santarém":171,"Setúbal":252,"Viana Do Castelo":139,"Vila Real":73,"Viseu":0,"Évora":232},
    "Évora":           {"Aveiro":239,"Beja":62,"Braga":334,"Bragança":373,"Castelo Branco":144,"Coimbra":188,"Faro":173,"Guarda":226,"Leiria":152,"Lisboa":108,"Portalegre":90,"Porto":294,"Santarém":100,"Setúbal":86,"Viana Do Castelo":356,"Vila Real":304,"Viseu":232,"Évora":0},
}

def heuristica(cidade, destino):
    return DISTANCIAS_LINHA_RECTA.get(cidade, {}).get(destino, 0)

def calcular_custo(caminho):
    custo = 0
    for i in range(len(caminho) - 1):
        for viz, peso in GRAFO.get(caminho[i], []):
            if viz == caminho[i+1]:
                custo += peso
                break
    return custo

# ─────────────────────────────────────────────
#  ALGORITMOS
# ─────────────────────────────────────────────

def custo_uniforme(inicio, destino):
    heap = [(0, inicio, [inicio])]
    visitados = set()
    while heap:
        custo, cidade, caminho = heapq.heappop(heap)
        if cidade in visitados: continue
        visitados.add(cidade)
        if cidade == destino: return caminho, custo
        for viz, peso in GRAFO.get(cidade, []):
            if viz not in visitados:
                heapq.heappush(heap, (custo+peso, viz, caminho+[viz]))
    return None, float("inf")

def profundidade_limitada(inicio, destino, limite):
    pilha = [(inicio, [inicio], 0)]
    while pilha:
        cidade, caminho, prof = pilha.pop()
        if cidade == destino: return caminho, calcular_custo(caminho)
        if prof >= limite: continue
        for viz, _ in GRAFO.get(cidade, []):
            if viz not in caminho:
                pilha.append((viz, caminho+[viz], prof+1))
    return None, float("inf")

def sofrega(inicio, destino):
    heap = [(heuristica(inicio, destino), inicio, [inicio])]
    visitados = set()
    while heap:
        _, cidade, caminho = heapq.heappop(heap)
        if cidade in visitados: continue
        visitados.add(cidade)
        if cidade == destino: return caminho, calcular_custo(caminho)
        for viz, _ in GRAFO.get(cidade, []):
            if viz not in visitados:
                heapq.heappush(heap, (heuristica(viz, destino), viz, caminho+[viz]))
    return None, float("inf")

def a_estrela(inicio, destino):
    heap = [(heuristica(inicio, destino), 0, inicio, [inicio])]
    visitados = set()
    while heap:
        _, custo, cidade, caminho = heapq.heappop(heap)
        if cidade in visitados: continue
        visitados.add(cidade)
        if cidade == destino: return caminho, custo
        for viz, peso in GRAFO.get(cidade, []):
            if viz not in visitados:
                nc = custo + peso
                heapq.heappush(heap, (nc+heuristica(viz,destino), nc, viz, caminho+[viz]))
    return None, float("inf")

# ─────────────────────────────────────────────
#  OCR
# ─────────────────────────────────────────────

# ── Padrões para os 3 formatos de matrícula portuguesa ──
# AA-00-AA (2005-2020) | 00-00-AA (1992-2005) | AA-00-00 (2020+)
PADROES_MATRICULA = [
    re.compile(r'[A-Z]{2}[^A-Z0-9]?[0-9]{2}[^A-Z0-9]?[A-Z]{2}'),
    re.compile(r'[0-9]{2}[^A-Z0-9]?[0-9]{2}[^A-Z0-9]?[A-Z]{2}'),
    re.compile(r'[A-Z]{2}[^A-Z0-9]?[0-9]{2}[^A-Z0-9]?[0-9]{2}'),
]

def corrigir_matricula(texto_raw):
    """Corrige confusões OCR e devolve formato AA-00-AA / 00-00-AA / AA-00-00."""
    s = re.sub(r'[^A-Z0-9]', '', texto_raw.upper())
    if len(s) < 6:
        return None
    s = s[:6]
    l = list(s)
    def fl(c): return {'0': 'O', '1': 'I'}.get(c, c)
    def fn(c): return {'O': '0', 'I': '1', 'S': '5', 'B': '8'}.get(c, c)
    if all(c.isdigit() or c in 'OI' for c in l[:2]):   # 00-00-AA
        for i in [0, 1, 2, 3]: l[i] = fn(l[i])
        for i in [4, 5]:       l[i] = fl(l[i])
        r = ''.join(l)
        if re.match(r'^[0-9]{4}[A-Z]{2}$', r):
            return f"{r[:2]}-{r[2:4]}-{r[4:]}"
    else:
        for i in [0, 1]: l[i] = fl(l[i])
        for i in [2, 3]: l[i] = fn(l[i])
        if all(c.isdigit() or c in 'OI' for c in l[4:]):  # AA-00-00
            for i in [4, 5]: l[i] = fn(l[i])
            r = ''.join(l)
            if re.match(r'^[A-Z]{2}[0-9]{4}$', r):
                return f"{r[:2]}-{r[2:4]}-{r[4:]}"
        else:                                               # AA-00-AA
            for i in [4, 5]: l[i] = fl(l[i])
            r = ''.join(l)
            if re.match(r'^[A-Z]{2}[0-9]{2}[A-Z]{2}$', r):
                return f"{r[:2]}-{r[2:4]}-{r[4:]}"
    return None

def preparar_variantes_ocr(imagem):
    """Gera múltiplos recortes da imagem para maximizar as hipóteses de leitura."""
    largura, altura = imagem.size
    variantes = []
    for ep, dp, cp, bp in [
        (0.0,  1.0,  0.0,  1.0 ),   # imagem completa
        (0.10, 0.90, 0.05, 0.95),   # recorte conservador
        (0.13, 0.88, 0.08, 0.72),   # remove bloco EU e data
        (0.17, 0.88, 0.05, 0.90),   # recorte intermédio
    ]:
        sub = imagem.crop((int(largura*ep), int(altura*cp),
                           int(largura*dp), int(altura*bp)))
        sub = sub.convert("L")
        sub = ImageOps.autocontrast(sub, cutoff=2)
        sub = ImageEnhance.Sharpness(sub).enhance(2.0)
        sub = sub.resize((sub.width * 2, sub.height * 2), Image.LANCZOS)
        variantes.append(sub)
    return variantes

# ─────────────────────────────────────────────
#  ROTAS DE PÁGINAS
# ─────────────────────────────────────────────

@app.route("/")
def login():
    return send_from_directory("templates", "login.html")

@app.route("/main/")
def main():
    return send_from_directory("templates", "main.html")

@app.route("/resultado/")
def resultado():
    return send_from_directory("templates", "resultado.html")

@app.route("/atracoes/")
def atracoes():
    return send_from_directory("templates", "atracoes.html")

@app.route("/static/<path:filename>")
def static_files(filename):
    return send_from_directory("static", filename)

# ─────────────────────────────────────────────
#  API — OCR
# ─────────────────────────────────────────────

@app.route("/api/ocr", methods=["POST"])
def api_ocr():
    """
    Recebe uma imagem (multipart/form-data, campo 'imagem'),
    aplica OCR e devolve a matrícula reconhecida.
    """
    if not OCR_DISPONIVEL:
        return jsonify({"erro": "pytesseract não instalado"}), 500

    if "imagem" not in request.files:
        return jsonify({"erro": "Nenhuma imagem enviada"}), 400

    ficheiro = request.files["imagem"]
    try:
        imagem = Image.open(io.BytesIO(ficheiro.read()))
    except Exception as e:
        return jsonify({"erro": f"Não foi possível abrir a imagem: {e}"}), 400

    from collections import Counter
    variantes = preparar_variantes_ocr(imagem)
    votos = Counter()

    configs_normal    = ["--psm 11", "--psm 8", "--psm 7", "--psm 13"]
    configs_whitelist = [
        "--psm 8  -c tessedit_char_whitelist=ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-.",
        "--psm 11 -c tessedit_char_whitelist=ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-.",
        "--psm 13 -c tessedit_char_whitelist=ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-.",
    ]

    def votar(cfgs, peso):
        for var in variantes:
            for cfg in cfgs:
                t = pytesseract.image_to_string(var, config=cfg).upper().strip()
                for p in PADROES_MATRICULA:
                    m = p.search(t)
                    if m:
                        r = corrigir_matricula(m.group())
                        if r: votos[r] += peso
                r = corrigir_matricula(t)
                if r: votos[r] += peso

    votar(configs_normal, 1)
    votar(configs_whitelist, 2)  # whitelist tem mais peso

    matricula = votos.most_common(1)[0][0] if votos else None
    texto = f"{len(votos)} candidatos encontrados"

    if matricula:
        confianca = 94
        return jsonify({"matricula": matricula, "confianca": confianca, "texto_ocr": texto})
    else:
        return jsonify({"erro": "Matrícula não reconhecida", "texto_ocr": texto}), 422

# ─────────────────────────────────────────────
#  API — ATRAÇÕES (Ollama)
# ─────────────────────────────────────────────

@app.route("/api/atracoes/")
def api_atracoes():
    # Altera "city" para "cidade"
    cidade = request.args.get("cidade") or request.args.get("city") 
    
    if not cidade:
        return jsonify({"erro": "Cidade não especificada"}), 400
    
    prompt = (
        f"És um guia turístico português. Sobre a cidade de {cidade}, Portugal, "
        f"responde APENAS com JSON válido neste formato exacto, sem markdown nem texto extra:\n"
        f'{{"regiao":"nome da região","descricao":"uma frase sobre a cidade",'
        f'"atracoes":[{{"nome":"Atração 1","descricao":"Descrição curta."}},'
        f'{{"nome":"Atração 2","descricao":"Descrição curta."}},'
        f'{{"nome":"Atração 3","descricao":"Descrição curta."}}],'
        f'"texto_completo":"Texto com 3-4 frases sobre a cidade e as atrações em português."}}'
    )

    import time
    inicio = time.time()

    try:
        # Nota: Tudo dentro do try tem de ter EXATAMENTE o mesmo alinhamento (8 espaços)
        resposta = req.post(
            OLLAMA_URL,
            json={
                "model": OLLAMA_MODELO,
                "messages": [{"role": "user", "content": prompt}], # API Chat usa 'messages'
                "stream": False,
                "options": {"temperature": 0}
            },
            timeout=90,
        )
        # E para ler a resposta, a chave também muda:
        texto_llm = resposta.json().get("message", {}).get("content", "").strip()
        elapsed = f"{time.time()-inicio:.1f}s"

        # Limpeza de tags markdown caso a LLM as envie
        texto_limpo = re.sub(r"```json|```", "", texto_llm).strip()
        
        import json
        dados = json.loads(texto_limpo)
        dados["elapsed"] = elapsed
        
        return jsonify(dados)

    except req.exceptions.RequestException as e:
        return jsonify({"erro": f"Erro na ligação ao Ollama: {str(e)}"}), 503
    except Exception as e:
        return jsonify({"erro": f"Erro ao processar dados: {str(e)}"}), 500
# ─────────────────────────────────────────────
#  ARRANQUE
# ─────────────────────────────────────────────

if __name__ == "__main__":
    print("=" * 50)
    print("  PathFinder — servidor a iniciar")
    print("  Abre o browser em: http://localhost:5000")
    print("=" * 50)
    app.run(debug=True, port=5000)
