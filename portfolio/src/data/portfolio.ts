import type { Localized } from '../i18n/types';

export interface Profile {
  name: string;
  role: Localized;
  summary: Localized;
  location: Localized;
  email: string;
  links: { label: string; url: string }[];
}

export const profile: Profile = {
  name: 'Sofia Silva',
  role: { pt: 'Frontend Developer', en: 'Frontend Developer' },
  summary: {
    pt: 'Sou uma pessoa trabalhadora (com sentido de liderança), perfecionista e determinada (quer a nível profissional como pessoal). Gosto de inovação e desafios pois aprendo sempre mais, algo que também gosto de adquirir.  Assim, tenho como objetivo obter mais conhecimento e estar estável a trabalhar no que gosto.',
    en: 'I am a hardworking person (with leadership qualities), a perfectionist, and determined (professionally and personally). I enjoy innovation and challenges, as they allow me to constantly learn and grow. My goal is to gain further knowledge and achieve stability while working in a field I enjoy.',
  },
  location: { pt: 'Barcelos, Portugal', en: 'Barcelos, Portugal' },
  email: 'maddiesofii2311@gmail.com',
  links: [
    { label: 'GitHub', url: 'https://github.com/maddiesofii2311/myportfolio' }
  ],
};

export interface SkillGroup {
  folder: Localized;
  extension: string;
  items: (string | Localized)[];
}

export const skillGroups: SkillGroup[] = [
  { folder: { pt: 'frameworks', en: 'frameworks' }, extension: '.tsx', items: ['React', 'Angular', 'Django'] },
  { folder: { pt: 'linguagens', en: 'languages' }, extension: '.ts', items: ['TypeScript', 'JavaScript', 'HTML5', 'CSS3', 'Python', 'C'] },
  { folder: { pt: 'ferramentas', en: 'tools' }, extension: '.json', items: ['Git', 'npm', 'Microsoft Visual Studio Code', 'Sublime Text', 'Android Studio', 'Microsoft Office'] },
  { folder: { pt: 'outros', en: 'others' }, extension: '.spec.ts', items: ['Hardware', { pt: 'Atendimento ao Cliente', en: 'Customer Service' }, { pt: 'Inglês e Espanhol', en: 'English and Spanish' }] },
];

export interface Project {
  name: string;
  stack: string[];
  description: Localized;
  images?: string[];
  repoUrl?: string;
  liveUrl?: string;
  highlight?: boolean;
  confidential?: boolean;
}

export const projects: Project[] = [
  {
    name: 'rotary-club-ruma',
    stack: ['HTML', 'CSS'],
    description: {
      pt: 'Desenvolvido para a empresa CNT - Centar Novih Technologija, durante o estágio curricular de Erasmus+ na Sérvia. O projeto consistiu em criar um website para o Rotary Club Ruma, uma organização sem fins lucrativos que realiza atividades de caridade e serviços comunitários. O site foi desenvolvido utilizando HTML e CSS, com foco em design responsivo e acessibilidade.',
      en: 'Developed for CNT - Centar Novih Tehnologija during an Erasmus+ internship in Serbia. The project involved creating a website for Rotary Club Ruma, a non-profit organization dedicated to charitable activities and community service. The website was built using HTML and CSS, with a focus on responsive design and accessibility.',
    },
    images: ['/projects/rotary-club-ruma/1.png', '/projects/rotary-club-ruma/2.png', '/projects/rotary-club-ruma/3.png'],
    confidential: true,
  },
  {
    name: 'always-security',
    stack: ['HTML', 'CSS', 'PHP', 'JavaScript', 'SQL'],
    description: {
      pt: 'Desenvolvido como projeto final do Curso Técnico Profissional em Gestão de Equipamentos Informáticos. O projeto consistiu em criar um website informativo sobre segurança na internet, incluindo informação teórica, experiências verídicas, estatísticas de adoloscentes entre os 12 e 15 anos, um forúm de comunicação, jogo de perguntas e respostas e vídeos informativos através do YouTube.',
      en: 'Developed as the final project for the Technical Professional Course in IT Equipment Management. The project consisted of creating an informative website about internet security, featuring theoretical content, real-life stories, statistics on teenagers aged 12 to 15, a discussion forum, a Q&A quiz game, and educational YouTube videos.',
    },
    images: ['/projects/always-security/1.jpg', '/projects/always-security/2.jpg', '/projects/always-security/3.jpg', '/projects/always-security/4.jpg', '/projects/always-security/5.jpg'],
    repoUrl: 'https://github.com/maddiesofii2311/myportfolio/tree/main/AlwaysSecurity',
    highlight: true,
  },
  {
    name: 'cinepop',
    stack: ['HTML', 'CSS', 'Django', 'JavaScript', 'SQL'],
    description: {
      pt: 'Desenvolvido como projeto final do Curso Técnico Superior Profissional em Programação de Sistemas de Informação. O projeto consistiu em criar um website para uma empresa fictícia chamada CinePop, com intuito na venda de bilhetes e bar no cinema. O site foi desenvolvido utilizando Django, HTML, CSS, JavaScript e SQL, com foco em design responsivo e experiência do utilizador. O projeto foi desenvolvido em grupo, com a colaboração de outros estudantes, no qual fui responsável pelo desenvolvimento web de frontend, base de dados e parcialmente backend.',
      en: 'Developed as the final project for the Higher Professional Technical Course in Information Systems Programming. The project involved creating a website for a fictional company called CinePop, designed for online movie ticket and snack bar sales. The website was built using Django, HTML, CSS, JavaScript, and SQL, focusing on responsive design and user experience. This was a team project developed in collaboration with fellow students, in which I was responsible for frontend web development, database management, and part of the backend development.',
    },
    images: ['/projects/cinepop/1.png', '/projects/cinepop/2.png'],
    repoUrl: 'https://github.com/maddiesofii2311/myportfolio/tree/main/cinepop',
    highlight: true,
  },
  {
    name: 'bestgames',
    stack: ['Kivy'],
    description: {
      pt: 'Desenvolvido para a empresa Bestgames, durante o estágio curricular. O projeto consistiu em criar uma aplicação para a empresa Bestgames, com intuito de vender o stock de produtos da loja. A aplicação foi desenvolvida utilizando a framework Kivy da linguagem Python, com foco em design responsivo e experiência do utilizador.',
      en: 'Developed for Bestgames during a curricular internship. The project involved creating an application for the company to sell its store\'s product inventory. The application was built using Python\'s Kivy framework, focusing on responsive design and user experience.',
    },
    images: ['/projects/bestgames/1.jpg', '/projects/bestgames/2.jpg', '/projects/bestgames/3.jpg', '/projects/bestgames/4.jpg', '/projects/bestgames/5.jpg', '/projects/bestgames/6.jpg', '/projects/bestgames/7.jpg'],
    confidential: true,
  },
  {
    name: 'softinsa',
    stack: ['HTML', 'CSS', 'JavaScript', 'React', 'SQL', 'Flutter'],
    description: {
      pt: 'Desenvolvido para a empresa Softinsa, como projeto final da Licenciatura de Engenharia Informática. O projeto consistiu em criar uma aplicação web e mobile para a empresa Softinsa, com intuito de fornecer cursos para os utilizadores. A aplicação web foi desenvolvida utilizando React, HTML, CSS, JavaScript e SQL, enquanto a aplicação mobile foi desenvolvida utilizando Flutter. O projeto foi desenvolvido em grupo, com a colaboração de outros estudantes, no qual fui parcialmente responsável pelo desenvolvimento do projeto web e mobile.',
      en: 'Developed for Softinsa as the final project for the Bachelor\'s degree in Computer Engineering. The project involved creating a web and mobile application for the company to provide courses for users. The web application was built using React, HTML, CSS, JavaScript, and SQL, while the mobile application was developed using Flutter. The project was developed in a team, with collaboration from other students, in which I was partially responsible for the web and mobile application development.',
    },
    images: ['/projects/softinsa/1.jpg', '/projects/softinsa/2.jpg', '/projects/softinsa/3.jpg', '/projects/softinsa/4.jpg', '/projects/softinsa/5.png', '/projects/softinsa/6.png', '/projects/softinsa/7.png', '/projects/softinsa/8.png'],
    confidential: true,
  },
  {
    name: 'oficar',
    stack: ['HTML', 'CSS', 'JavaScript', 'Django', 'SQL'],
    description: {
      pt: 'Desenvolvido para uma cadeira da Licenciatura de Engenharia Informática. O projeto consistiu em criar uma aplicação web para a empresa fictícia OfiCar, com intuito de fornecer serviços para oficinas mecânicas como gestão de clientes, veículos, stock de peças, entre outros. A aplicação foi desenvolvida utilizando Django, HTML, CSS, JavaScript e SQL, com foco em design responsivo e experiência do utilizador.',
      en: 'Developed for a course in the Bachelor\'s degree in Computer Engineering. The project involved creating a web application for the fictional company OfiCar, with the aim of providing services for mechanical workshops such as customer and vehicle management, parts inventory, among others. The application was built using Django, HTML, CSS, JavaScript, and SQL, with a focus on responsive design and user experience.',
    },
    images: ['/projects/oficar/1.png', '/projects/oficar/2.png', '/projects/oficar/3.png', '/projects/oficar/4.png'],
    repoUrl: 'https://github.com/maddiesofii2311/myportfolio/tree/main/oficar',
    highlight: true,
  },
  {
    name: 'pathfinder',
    stack: ['HTML', 'CSS', 'JavaScript', 'Flask', 'Python'],
    description: {
      pt: 'Desenvolvido para uma cadeira da Licenciatura de Engenharia Informática. O projeto consistiu em criar uma aplicação web para a empresa fictícia Pathfinder, com intuito de calcular o melhor caminho entre dois pontos para auxiliar na navegação dos condutores. A aplicação foi desenvolvida utilizando Flask, HTML, CSS, JavaScript e Python (Inteligência Artificial), com foco em design responsivo e experiência do utilizador. Este projeto foi desenvolvido em grupo, com a colaboração de outros estudantes, no qual fui responsável pelo desenvolvimento do frontend e parcialmente pela implementação da Inteligência Artificial.',
      en: 'Developed for a course in the Bachelor\'s degree in Computer Engineering. The project involved creating a web application for the fictional company Pathfinder, with the aim of calculating the best path between two points to assist with driver navigation. The application was built using Flask, HTML, CSS, JavaScript, and Python (Artificial Intelligence), with a focus on responsive design and user experience. This project was developed in a team, with collaboration from other students, in which I was partially responsible for the frontend development and the implementation of Artificial Intelligence.',
    },
    images: ['/projects/pathfinder/1.jpeg', '/projects/pathfinder/2.png', '/projects/pathfinder/3.jpeg', '/projects/pathfinder/4.png', '/projects/pathfinder/5.png', '/projects/pathfinder/6.png', '/projects/pathfinder/7.png'],
    repoUrl: 'https://github.com/maddiesofii2311/myportfolio/tree/main/pathfinder',
    highlight: true,
  },
  {
    name: 'inforcavado',
    stack: ['HTML','Angular', 'TypeScript'],
    description: {
      pt: 'Desenvolvido para a empresa Inforcávado, durante o estágio curricular. O projeto consistiu em criar uma aplicação web, mobile e desktop para a empresa Inforcavado para o mercado têxtil, para além de fornecer as bases de componentes Spartan (design da aplicação com variáveis da empresa) para os trabalhadores da empresa. A aplicação foi desenvolvida utilizando Angular, HTML e TypeScript, com foco em design responsivo e experiência do utilizador. Este projeto foi desenvolvido em grupo, com a colaboração de outros trabalhadores da empresa, no qual fui responsável pelo desenvolvimento frontend das aplicações web, mobile e desktop.',
      en: 'Developed for the company Inforcávado, during the internship. The project involved creating a web, mobile, and desktop application for the company Inforcavado for the textile market, as well as providing the foundation of Spartan components (application design with company variables) for the company\'s employees. The application was built using Angular, HTML, and TypeScript, with a focus on responsive design and user experience. This project was developed in a team, with collaboration from other employees of the company, in which I was responsible for the frontend development of the web, mobile, and desktop applications.',
    },
    images: ['/projects/inforcavado/1.png', '/projects/inforcavado/2.png', '/projects/inforcavado/3.png', '/projects/inforcavado/4.png', '/projects/inforcavado/5.png', '/projects/inforcavado/6.png', '/projects/inforcavado/7.png', '/projects/inforcavado/8.png'],
    confidential: true,
  },
  {
    name: 'portfolio',
    stack: ['HTML', 'CSS', 'React', 'TypeScript'],
    description: {
      pt: 'O presente portfólio foi desenvolvido como projeto pessoal para demonstrar minhas habilidades e experiências como desenvolvedora frontend. O portfólio foi construído utilizando React, TypeScript, HTML e CSS, com foco em design responsivo e experiência do utilizador. Ele apresenta informações sobre o meu perfil, habilidades, projetos anteriores e formas de contacto.',
      en: 'This portfolio was developed as a personal project to demonstrate my skills and experience as a frontend developer. It was built using React, TypeScript, HTML, and CSS, focusing on responsive design and user experience. It features information about my profile, skills, previous projects, and contact methods.',
    },
    repoUrl: 'https://github.com/maddiesofii2311/myportfolio/tree/main/portfolio',
    highlight: true,
  },
];