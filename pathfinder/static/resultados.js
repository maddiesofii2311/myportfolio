const cities = {
    'Viana Do Castelo': { x: 0.28, y: 0.06 },
    'Braga':            { x: 0.32, y: 0.10 },
    'Bragança':         { x: 0.65, y: 0.08 },
    'Porto':            { x: 0.30, y: 0.16 },
    'Vila Real':        { x: 0.52, y: 0.13 },
    'Viseu':            { x: 0.48, y: 0.24 },
    'Guarda':           { x: 0.58, y: 0.28 },
    'Aveiro':           { x: 0.30, y: 0.28 },
    'Coimbra':          { x: 0.34, y: 0.36 },
    'Castelo Branco':   { x: 0.56, y: 0.38 },
    'Leiria':           { x: 0.28, y: 0.46 },
    'Portalegre':       { x: 0.58, y: 0.50 },
    'Santarém':         { x: 0.32, y: 0.54 },
    'Lisboa':           { x: 0.22, y: 0.62 },
    'Setúbal':          { x: 0.28, y: 0.68 },
    'Évora':            { x: 0.48, y: 0.64 },
    'Beja':             { x: 0.46, y: 0.76 },
    'Faro':             { x: 0.42, y: 0.90 },
};

const edges = [
    ['Lisboa','Santarém'],['Lisboa','Setúbal'],['Lisboa','Évora'],['Lisboa','Faro'],['Lisboa','Leiria'],
    ['Porto','Viana Do Castelo'],['Porto','Vila Real'],['Porto','Viseu'],['Porto','Aveiro'],['Porto','Braga'],
    ['Braga','Viana Do Castelo'],['Braga','Vila Real'],
    ['Coimbra','Aveiro'],['Coimbra','Leiria'],['Coimbra','Viseu'],['Coimbra','Castelo Branco'],
    ['Aveiro','Viseu'],['Aveiro','Leiria'],
    ['Leiria','Santarém'],
    ['Évora','Santarém'],['Évora','Portalegre'],['Évora','Setúbal'],['Évora','Beja'],
    ['Faro','Beja'],['Faro','Setúbal'],
    ['Guarda','Vila Real'],['Guarda','Viseu'],['Guarda','Castelo Branco'],['Guarda','Bragança'],
    ['Vila Real','Viseu'],['Vila Real','Bragança'],
    ['Portalegre','Castelo Branco'],
    ['Beja','Setúbal'],
];

const grafo = {
    'Lisboa':           [['Santarém',78],['Setúbal',50],['Évora',150],['Faro',299],['Leiria',129]],
    'Porto':            [['Viana Do Castelo',71],['Vila Real',116],['Viseu',133],['Aveiro',68],['Braga',53]],
    'Braga':            [['Porto',53],['Viana Do Castelo',48],['Vila Real',137]],
    'Viana Do Castelo': [['Braga',48],['Porto',71]],
    'Coimbra':          [['Aveiro',68],['Leiria',67],['Viseu',96],['Castelo Branco',159]],
    'Aveiro':           [['Coimbra',68],['Porto',68],['Viseu',95],['Leiria',115]],
    'Leiria':           [['Coimbra',67],['Lisboa',129],['Santarém',70],['Aveiro',115]],
    'Évora':            [['Lisboa',150],['Santarém',117],['Portalegre',131],['Setúbal',103],['Beja',152]],
    'Faro':             [['Beja',152],['Setúbal',249],['Lisboa',299]],
    'Setúbal':          [['Lisboa',50],['Faro',249],['Évora',103]],
    'Guarda':           [['Vila Real',157],['Viseu',85],['Castelo Branco',106],['Bragança',202]],
    'Vila Real':        [['Guarda',157],['Viseu',110],['Porto',116],['Bragança',137],['Braga',106]],
    'Viseu':            [['Vila Real',110],['Coimbra',96],['Porto',133],['Aveiro',95],['Guarda',85]],
    'Portalegre':       [['Évora',131],['Castelo Branco',80]],
    'Beja':             [['Évora',152],['Faro',152],['Setúbal',142]],
    'Bragança':         [['Vila Real',137],['Guarda',202]],
    'Castelo Branco':   [['Coimbra',159],['Guarda',106],['Portalegre',80],['Évora',203]],
    'Santarém':         [['Lisboa',78],['Leiria',70],['Évora',117]],
};

const heuristicaTab = {
    'Aveiro':{'Aveiro':0,'Beja':300,'Braga':102,'Bragança':204,'Castelo Branco':134,'Coimbra':52,'Faro':408,'Guarda':117,'Leiria':101,'Lisboa':218,'Portalegre':183,'Porto':57,'Santarém':157,'Setúbal':237,'Viana Do Castelo':118,'Vila Real':105,'Viseu':62,'Évora':239},
    'Beja':{'Aveiro':300,'Beja':0,'Braga':396,'Bragança':432,'Castelo Branco':203,'Coimbra':249,'Faro':111,'Guarda':285,'Leiria':209,'Lisboa':136,'Portalegre':146,'Porto':355,'Santarém':153,'Setúbal':107,'Viana Do Castelo':418,'Vila Real':365,'Viseu':294,'Évora':62},
    'Braga':{'Aveiro':102,'Beja':396,'Braga':0,'Bragança':142,'Castelo Branco':208,'Coimbra':149,'Faro':506,'Guarda':149,'Leiria':203,'Lisboa':321,'Portalegre':266,'Porto':47,'Santarém':258,'Setúbal':339,'Viana Do Castelo':37,'Vila Real':63,'Viseu':108,'Évora':334},
    'Bragança':{'Aveiro':204,'Beja':432,'Braga':142,'Bragança':0,'Castelo Branco':229,'Coimbra':226,'Faro':542,'Guarda':147,'Leiria':287,'Lisboa':398,'Portalegre':286,'Porto':172,'Santarém':329,'Setúbal':408,'Viana Do Castelo':173,'Vila Real':100,'Viseu':160,'Évora':373},
    'Castelo Branco':{'Aveiro':134,'Beja':203,'Braga':208,'Bragança':229,'Castelo Branco':0,'Coimbra':91,'Faro':314,'Guarda':82,'Leiria':113,'Lisboa':188,'Portalegre':60,'Porto':177,'Santarém':121,'Setúbal':189,'Viana Do Castelo':237,'Vila Real':166,'Viseu':100,'Évora':144},
    'Coimbra':{'Aveiro':52,'Beja':249,'Braga':149,'Bragança':226,'Castelo Branco':91,'Coimbra':0,'Faro':358,'Guarda':105,'Leiria':61,'Lisboa':177,'Portalegre':134,'Porto':107,'Santarém':111,'Setúbal':192,'Viana Do Castelo':169,'Vila Real':134,'Viseu':66,'Évora':188},
    'Évora':{'Aveiro':239,'Beja':62,'Braga':334,'Bragança':373,'Castelo Branco':144,'Coimbra':188,'Faro':173,'Guarda':226,'Leiria':152,'Lisboa':108,'Portalegre':90,'Porto':294,'Santarém':100,'Setúbal':86,'Viana Do Castelo':356,'Vila Real':304,'Viseu':232,'Évora':0},
    'Faro':{'Aveiro':408,'Beja':111,'Braga':506,'Bragança':542,'Castelo Branco':314,'Coimbra':358,'Faro':0,'Guarda':395,'Leiria':312,'Lisboa':216,'Portalegre':256,'Porto':464,'Santarém':255,'Setúbal':188,'Viana Do Castelo':526,'Vila Real':476,'Viseu':405,'Évora':173},
    'Guarda':{'Aveiro':117,'Beja':285,'Braga':149,'Bragança':147,'Castelo Branco':82,'Coimbra':105,'Faro':395,'Guarda':0,'Leiria':158,'Lisboa':258,'Portalegre':140,'Porto':134,'Santarém':189,'Setúbal':264,'Viana Do Castelo':184,'Vila Real':94,'Viseu':56,'Évora':226},
    'Leiria':{'Aveiro':101,'Beja':209,'Braga':203,'Bragança':287,'Castelo Branco':113,'Coimbra':61,'Faro':312,'Guarda':158,'Leiria':0,'Lisboa':118,'Portalegre':129,'Porto':158,'Santarém':57,'Setúbal':136,'Viana Do Castelo':217,'Vila Real':195,'Viseu':127,'Évora':152},
    'Lisboa':{'Aveiro':218,'Beja':136,'Braga':321,'Bragança':398,'Castelo Branco':188,'Coimbra':177,'Faro':216,'Guarda':258,'Leiria':118,'Lisboa':0,'Portalegre':161,'Porto':275,'Santarém':70,'Setúbal':30,'Viana Do Castelo':332,'Vila Real':311,'Viseu':240,'Évora':108},
    'Portalegre':{'Aveiro':183,'Beja':146,'Braga':266,'Bragança':286,'Castelo Branco':60,'Coimbra':134,'Faro':256,'Guarda':140,'Leiria':129,'Lisboa':161,'Portalegre':0,'Porto':232,'Santarém':108,'Setúbal':153,'Viana Do Castelo':293,'Vila Real':225,'Viseu':158,'Évora':90},
    'Porto':{'Aveiro':57,'Beja':355,'Braga':47,'Bragança':172,'Castelo Branco':177,'Coimbra':107,'Faro':464,'Guarda':134,'Leiria':158,'Lisboa':275,'Portalegre':232,'Porto':0,'Santarém':214,'Setúbal':294,'Viana Do Castelo':63,'Vila Real':76,'Viseu':82,'Évora':294},
    'Santarém':{'Aveiro':157,'Beja':153,'Braga':258,'Bragança':329,'Castelo Branco':121,'Coimbra':111,'Faro':255,'Guarda':189,'Leiria':57,'Lisboa':70,'Portalegre':108,'Porto':214,'Santarém':0,'Setúbal':81,'Viana Do Castelo':274,'Vila Real':243,'Viseu':171,'Évora':100},
    'Setúbal':{'Aveiro':237,'Beja':107,'Braga':339,'Bragança':408,'Castelo Branco':189,'Coimbra':192,'Faro':188,'Guarda':264,'Leiria':136,'Lisboa':30,'Portalegre':153,'Porto':294,'Santarém':81,'Setúbal':0,'Viana Do Castelo':353,'Vila Real':324,'Viseu':252,'Évora':86},
    'Viana Do Castelo':{'Aveiro':118,'Beja':418,'Braga':37,'Bragança':173,'Castelo Branco':237,'Coimbra':169,'Faro':526,'Guarda':184,'Leiria':217,'Lisboa':332,'Portalegre':293,'Porto':63,'Santarém':274,'Setúbal':353,'Viana Do Castelo':0,'Vila Real':101,'Viseu':139,'Évora':356},
    'Vila Real':{'Aveiro':105,'Beja':365,'Braga':63,'Bragança':100,'Castelo Branco':166,'Coimbra':134,'Faro':476,'Guarda':94,'Leiria':195,'Lisboa':311,'Portalegre':225,'Porto':76,'Santarém':243,'Setúbal':324,'Viana Do Castelo':101,'Vila Real':0,'Viseu':73,'Évora':304},
    'Viseu':{'Aveiro':62,'Beja':294,'Braga':108,'Bragança':160,'Castelo Branco':100,'Coimbra':66,'Faro':405,'Guarda':56,'Leiria':127,'Lisboa':240,'Portalegre':158,'Porto':82,'Santarém':171,'Setúbal':252,'Viana Do Castelo':139,'Vila Real':73,'Viseu':0,'Évora':232},
};

// Funções de apoio
function h(c, d) { return (heuristicaTab[c] && heuristicaTab[c][d]) || 0; }

function calcularCusto(caminho) {
    let custo = 0;
    for (let i = 0; i < caminho.length - 1; i++) {
        const viz = grafo[caminho[i]] || [];
        const a = viz.find(([v]) => v === caminho[i+1]);
        if (a) custo += a[1];
    }
    return custo;
}

// Algoritmos
function custoUniforme(inicio, destino) {
    const heap = [[0, inicio, [inicio]]];
    const visitados = new Set();
    const log = [];
    while (heap.length) {
        heap.sort((a,b) => a[0]-b[0]);
        const [custo, cidade, caminho] = heap.shift();
        if (visitados.has(cidade)) continue;
        visitados.add(cidade);
        log.push({ cidade, g: custo, hVal: 0 });
        if (cidade === destino) return { caminho, custo, log };
        for (const [viz, peso] of (grafo[cidade]||[])) {
            if (!visitados.has(viz)) heap.push([custo+peso, viz, [...caminho, viz]]);
        }
    }
    return { caminho: null, custo: Infinity, log };
}

function profundidadeLimitada(inicio, destino, limite) {
    // Usa só o caminho actual para evitar ciclos (sem visitados global,
    // que bloquearia ramos alternativos válidos num DFS)
    const pilha = [[inicio, [inicio], 0]];
    const log = [];
    const vistos = new Set(); // só para log, não bloqueia expansão
    while (pilha.length) {
        const [cidade, caminho, prof] = pilha.pop();
        if (!vistos.has(cidade)) {
            vistos.add(cidade);
            log.push({ cidade, g: calcularCusto(caminho), hVal: 0 });
        }
        if (cidade === destino) return { caminho, custo: calcularCusto(caminho), log };
        if (prof >= limite) continue;
        for (const [viz] of (grafo[cidade]||[])) {
            if (!caminho.includes(viz)) pilha.push([viz, [...caminho, viz], prof+1]);
        }
    }
    return { caminho: null, custo: Infinity, log };
}

function sofrega(inicio, destino) {
    const heap = [[h(inicio,destino), inicio, [inicio]]];
    const visitados = new Set();
    const log = [];
    while (heap.length) {
        heap.sort((a,b) => a[0]-b[0]);
        const [, cidade, caminho] = heap.shift();
        if (visitados.has(cidade)) continue;
        visitados.add(cidade);
        log.push({ cidade, g: calcularCusto(caminho), hVal: h(cidade, destino) });
        if (cidade === destino) return { caminho, custo: calcularCusto(caminho), log };
        for (const [viz] of (grafo[cidade]||[])) {
            if (!visitados.has(viz)) heap.push([h(viz,destino), viz, [...caminho, viz]]);
        }
    }
    return { caminho: null, custo: Infinity, log };
}

function aEstrela(inicio, destino) {
    const heap = [[h(inicio,destino), 0, inicio, [inicio]]];
    const visitados = new Set();
    const log = [];
    while (heap.length) {
        heap.sort((a,b) => a[0]-b[0]);
        const [, custo, cidade, caminho] = heap.shift();
        if (visitados.has(cidade)) continue;
        visitados.add(cidade);
        log.push({ cidade, g: custo, hVal: h(cidade, destino) });
        if (cidade === destino) return { caminho, custo, log };
        for (const [viz, peso] of (grafo[cidade]||[])) {
            if (!visitados.has(viz)) {
                const nc = custo+peso;
                heap.push([nc+h(viz,destino), nc, viz, [...caminho, viz]]);
            }
        }
    }
    return { caminho: null, custo: Infinity, log };
}

// UI e Animação
const canvas = document.getElementById('graphCanvas');
const ctx = canvas.getContext('2d');
let currentPath = [];
let animStep = 0;
let animTimer = null;

function getPos(name) {
    const c = cities[name];
    return { x: c.x * canvas.width, y: c.y * canvas.height };
}

function draw(origin, dest) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    edges.forEach(([a,b]) => {
        const pa = getPos(a), pb = getPos(b);
        ctx.beginPath(); ctx.moveTo(pa.x,pa.y); ctx.lineTo(pb.x,pb.y);
        ctx.strokeStyle='#c8d8cc'; ctx.lineWidth=1.5; ctx.stroke();
    });
    if (currentPath.length > 1) {
        const steps = Math.min(animStep, currentPath.length-1);
        for (let i=0; i<steps; i++) {
            const pa=getPos(currentPath[i]), pb=getPos(currentPath[i+1]);
            ctx.beginPath(); ctx.moveTo(pa.x,pa.y); ctx.lineTo(pb.x,pb.y);
            ctx.strokeStyle='#27ae60'; ctx.lineWidth=3; ctx.stroke();
        }
    }
    Object.keys(cities).forEach(name => {
        const p = getPos(name);
        let color='#bdc3c7', radius=7;
        if (name===origin)  { color='#27ae60'; radius=10; }
        else if (name===dest) { color='#2980b9'; radius=10; }
        else if (currentPath.includes(name) && currentPath.indexOf(name)<animStep) { color='#e67e22'; radius=8; }
        ctx.beginPath(); ctx.arc(p.x,p.y,radius,0,Math.PI*2);
        ctx.fillStyle=color; ctx.fill();
        ctx.strokeStyle='#fff'; ctx.lineWidth=2; ctx.stroke();
        ctx.fillStyle='#555'; ctx.font='11px DM Sans,sans-serif';
        ctx.textAlign='center'; ctx.fillText(name, p.x, p.y-radius-5);
    });
}

function resizeCanvas(origin, dest) {
    const rect = canvas.getBoundingClientRect();
    canvas.width=rect.width; canvas.height=rect.height;
    draw(origin, dest);
}

function renderBreadcrumb(caminho) {
    const bc = document.getElementById('breadcrumb');
    bc.innerHTML = '';
    caminho.forEach((c, i) => {
        const span = document.createElement('span');
        span.className = 'bc-city' + (i===0 ? ' origin' : i===caminho.length-1 ? ' destination' : ' visited');
        span.textContent = c;
        bc.appendChild(span);
        if (i < caminho.length-1) {
            const arr = document.createElement('span');
            arr.className='bc-arrow'; arr.textContent='›';
            bc.appendChild(arr);
        }
    });
}

function renderLog(log, destino) {
    const tbody = document.getElementById('logBody');
    tbody.innerHTML = '';
    log.forEach((entry, i) => {
        const tr = document.createElement('tr');
        const isFinal = entry.cidade === destino && i === log.length-1;
        if (isFinal) tr.className = 'final-row';
        tr.innerHTML = `<td>${i+1}</td><td>${entry.cidade}${isFinal ? ' <span class="check-icon">✓</span>' : ''}</td><td>${entry.g}</td><td>${entry.hVal}</td>`;
        tbody.appendChild(tr);
    });
}

// EVENT LISTENER PRINCIPAL
window.addEventListener('load', () => {
    const params = new URLSearchParams(window.location.search);
    const origin = params.get('origin') || 'Porto';
    const dest = params.get('dest') || 'Faro';
    const algo = params.get('algo') || 'astar';
    const limite = parseInt(params.get('limite') || '10');

    const algoNames = { ucs:'Custo Uniforme', dls:'Profundidade Limitada', greedy:'Sôfrega (Greedy)', astar:'A*' };
    document.getElementById('algoTag').textContent = `✦ Algoritmo ${algoNames[algo]}`;

    let resultado;
    if (algo==='ucs') resultado = custoUniforme(origin, dest);
    else if (algo==='dls') resultado = profundidadeLimitada(origin, dest, limite);
    else if (algo==='greedy') resultado = sofrega(origin, dest);
    else resultado = aEstrela(origin, dest);

    const { caminho, custo, log } = resultado;

    if (!caminho) {
        document.getElementById('statusBadge').textContent = 'Caminho não encontrado';
        resizeCanvas(origin, dest);
        return;
    }

    // Preencher dados na UI
    document.getElementById('logSubtitle').textContent = `${origin} → ${dest} · ${log.length} nós expandidos`;
    document.getElementById('distValue').textContent = custo;
    renderBreadcrumb(caminho);
    renderLog(log, dest);

    const card = document.getElementById('resultCard');
    card.style.display = 'block';
    document.getElementById('resultTitle').textContent = `Resultado ${algoNames[algo]}`;
    document.getElementById('resNodes').textContent = log.length;
    document.getElementById('resStops').textContent = caminho.length - 1;
    document.getElementById('resDist').textContent = custo + ' km';
    document.getElementById('resHeuristic').textContent = (algo==='greedy'||algo==='astar') ? `Dist. ${dest}` : 'N/A';
    
    if (algo === 'ucs' || algo === 'astar') document.getElementById('resOptimal').style.display = 'block';

    // Iniciar animação
    setTimeout(() => {
        resizeCanvas(origin, dest);
        currentPath = caminho;
        animStep = 0;
        animTimer = setInterval(() => {
            animStep++;
            draw(origin, dest);
            if (animStep >= caminho.length) clearInterval(animTimer);
        }, 350);
    }, 100);

    window.addEventListener('resize', () => resizeCanvas(origin, dest));

    // CLICK LISTENER CORRIGIDO (DENTRO DO ESCOPO ONDE 'origin' E 'dest' EXISTEM)
    canvas.addEventListener('click', (e) => {
        const rect = canvas.getBoundingClientRect();
        const mx = e.clientX - rect.left;
        const my = e.clientY - rect.top;
        let closest = null;
        let closestDist = Infinity;

        Object.keys(cities).forEach(name => {
            const p = getPos(name);
            const dist = Math.sqrt((mx - p.x) ** 2 + (my - p.y) ** 2);
            if (dist < closestDist) {
                closestDist = dist;
                closest = name;
            }
        });

        if (closest && closestDist < 20) {
            const routeEnc = encodeURIComponent(JSON.stringify(caminho));
            const cityEnc  = encodeURIComponent(closest);
            const oriEnc   = encodeURIComponent(origin);
            const dstEnc   = encodeURIComponent(dest);
            window.location.href = `/atracoes/?route=${routeEnc}&city=${cityEnc}&origin=${oriEnc}&dest=${dstEnc}`;
        }
    });

    canvas.style.cursor = 'pointer';
});