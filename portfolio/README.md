# Portfólio — React + TypeScript

Portfólio pessoal com um conceito visual inspirado num editor de código (IDE): abas de navegação, uma hero em estilo terminal com efeito de escrita, e as skills organizadas como uma árvore de ficheiros.

## Como correr localmente

```bash
npm install
npm run dev
```

Abre depois o endereço que aparece no terminal (normalmente `http://localhost:5173`).

## Como personalizar o conteúdo

**Só precisas de editar um ficheiro:** `src/data/portfolio.ts`

Lá dentro encontras:
- `profile` — nome, função, resumo, localização, email e links (GitHub/LinkedIn)
- `skillGroups` — as tuas tecnologias, agrupadas
- `projects` — os teus projetos (nome, stack, descrição, link do repositório)

Todo o resto do site lê automaticamente destes dados — não precisas de mexer nos componentes para atualizar o texto.

## Estrutura do projeto

```
src/
  data/portfolio.ts      ← conteúdo (edita aqui)
  components/
    EditorTabs.tsx        ← navegação
    Hero.tsx               ← secção "sobre" (terminal)
    Skills.tsx              ← secção "skills" (árvore de ficheiros)
    Projects.tsx             ← secção "projetos"
    Contact.tsx               ← secção "contacto"
    useTypewriter.ts           ← hook do efeito de escrita
  index.css                     ← paleta de cores e tipografia (design tokens)
```

## Build de produção

```bash
npm run build
```

Gera a pasta `dist/` pronta para deploy.

## Deploy sugerido

- **Vercel**: importa o repositório do GitHub, deteta Vite automaticamente.
- **Netlify**: `npm run build`, publish directory `dist`.
- **GitHub Pages**: usa o plugin `vite-plugin-gh-pages` ou faz deploy manual da pasta `dist`.

## Sobre a stack pedida na vaga (React + Angular + JS + TS)

Este site em si é construído em **React + TypeScript** (é o que faz mais sentido como "cartão de visita" técnico). Para provares domínio de **Angular** e **JavaScript puro**, a secção de Projetos já está preparada com exemplos nessas stacks — edita `src/data/portfolio.ts` e substitui pelos teus projetos reais feitos nessas tecnologias, com link para o respetivo repositório.

## Tecnologias usadas

- React 19 + TypeScript
- Vite
- Tailwind CSS v4
