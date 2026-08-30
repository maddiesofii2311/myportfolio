import type { Lang } from './types';

export interface Translations {
  nav: { sobre: string; skills: string; projetos: string; contacto: string };
  hero: { whoami: string; ctaProjects: string; ctaContact: string; location: string };
  skills: { eyebrow: string; heading: string; stackFolder: string };
  projects: { eyebrow: string; heading: string; subtitle: string; code: string; confidential: string; viewImages: string};
  contact: { eyebrow: string; heading: string; subtitle: string; footer: string };
  langToggleLabel: string;
}

export const translations: Record<Lang, Translations> = {
  pt: {
    nav: { sobre: 'sobre.tsx', skills: 'skills.ts', projetos: 'projetos.tsx', contacto: 'contacto.ts' },
    hero: {
      whoami: 'quemsoueu',
      ctaProjects: 'ver_projetos()',
      ctaContact: 'contactar()',
      location: 'localização',
    },
    skills: {
      eyebrow: 'skills.ts',
      heading: 'Tecnologias, Ferramentas e Outros',
      stackFolder: 'stack/',
    },
    projects: {
      eyebrow: 'projetos.tsx',
      heading: 'Projetos',
      subtitle: 'Projetos realizados ao longo do meu percurso académico e profissional.',
      code: 'código →',
      confidential: 'Projeto confidencial',
      viewImages: 'ver imagens →',
    },
    contact: {
      eyebrow: 'contacto.ts',
      heading: 'Vamos falar?',
      subtitle: 'Disponível para novas oportunidades. Envia um email ou encontra-me nas ligações abaixo.',
      footer: 'feito com React + TypeScript',
    },
    langToggleLabel: 'idioma',
  },
  en: {
    nav: { sobre: 'about.tsx', skills: 'skills.ts', projetos: 'projects.tsx', contacto: 'contact.ts' },
    hero: {
      whoami: 'whoami',
      ctaProjects: 'viewProjects()',
      ctaContact: 'contactMe()',
      location: 'location',
    },
    skills: {
      eyebrow: 'skills.ts',
      heading: 'Technologies, Tools & Others',
      stackFolder: 'stack/',
    },
    projects: {
      eyebrow: 'projects.tsx',
      heading: 'Projects',
      subtitle: 'Projects developed during my academic and professional journey.',
      code: 'code →',
      confidential: 'Confidential project',
      viewImages: 'view images →',
    },
    contact: {
      eyebrow: 'contact.ts',
      heading: "Let's talk",
      subtitle: 'Open to new opportunities. Send an email or find me through the links below.',
      footer: 'built with React + TypeScript',
    },
    langToggleLabel: 'language',
  },
};