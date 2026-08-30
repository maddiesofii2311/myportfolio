import { useLanguage } from '../i18n/LanguageContext';

export default function EditorTabs() {
  const { lang, toggleLang, t } = useLanguage();

  const tabs = [
    { file: t.nav.sobre, href: '#sobre' },
    { file: t.nav.skills, href: '#skills' },
    { file: t.nav.projetos, href: '#projetos' },
    { file: t.nav.contacto, href: '#contacto' },
  ];

  return (
    <header className="sticky top-0 z-50 border-b border-border bg-ink/90 backdrop-blur">
      <div className="mx-auto flex max-w-5xl items-center gap-1 px-3 sm:px-6">
        <div className="flex shrink-0 items-center gap-1.5 pr-3">
          <span className="h-2.5 w-2.5 rounded-full bg-rose/70" />
          <span className="h-2.5 w-2.5 rounded-full bg-amber/70" />
          <span className="h-2.5 w-2.5 rounded-full bg-mint/70" />
        </div>

        <nav className="flex flex-1 overflow-x-auto" aria-label="Navegacao principal">
          {tabs.map(function (tab) {
            return (
              <a
                key={tab.href}
                href={tab.href}
                className="focus-ring group relative flex shrink-0 items-center gap-2 border-r border-border px-4 py-3 font-mono text-sm text-muted transition-colors hover:text-text"
              >
                {tab.file}
              </a>
            );
          })}
        </nav>

        <button
          type="button"
          onClick={toggleLang}
          title={t.langToggleLabel}
          className="focus-ring ml-2 flex shrink-0 items-center gap-1 rounded-md border border-border px-3 py-1.5 font-mono text-xs text-muted transition-colors hover:border-amber hover:text-amber"
        >
          <span className={lang === 'pt' ? 'text-amber' : ''}>PT</span>
          <span className="text-border">/</span>
          <span className={lang === 'en' ? 'text-amber' : ''}>EN</span>
        </button>
      </div>
    </header>
  );
}