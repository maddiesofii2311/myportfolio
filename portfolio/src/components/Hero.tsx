import { useTypewriter } from './useTypewriter';
import { profile } from '../data/portfolio';
import { useLanguage } from '../i18n/LanguageContext';

export default function Hero() {
  const { lang, t } = useLanguage();
  const summary = profile.summary[lang];
  const { output, done } = useTypewriter(summary, 14, 500);

  return (
    <section id="sobre" className="mx-auto max-w-5xl px-3 pt-14 pb-20 sm:px-6 sm:pt-20">
      <div className="overflow-hidden rounded-lg border border-border bg-surface shadow-2xl shadow-black/40">
        <div className="flex items-center gap-2 border-b border-border bg-surface-hi px-4 py-2.5">
          <span className="h-2.5 w-2.5 rounded-full bg-rose/70" />
          <span className="h-2.5 w-2.5 rounded-full bg-amber/70" />
          <span className="h-2.5 w-2.5 rounded-full bg-mint/70" />
          <span className="ml-3 font-mono text-xs text-muted">zsh — {t.nav.sobre}</span>
        </div>

        <div className="px-5 py-8 sm:px-10 sm:py-12">
          <p className="font-mono text-sm text-mint">
            <span className="text-muted">$</span> {t.hero.whoami}
          </p>

          <h1 className="mt-3 font-mono text-3xl font-extrabold tracking-tight text-text sm:text-5xl">
            {profile.name}
          </h1>
          <p className="mt-2 font-mono text-lg text-amber sm:text-xl">{profile.role[lang]}</p>

          <div className="mt-6 max-w-2xl border-l-2 border-border pl-4 font-mono text-sm leading-relaxed text-muted sm:text-base">
            <span aria-hidden className="select-none text-border">// </span>
            <span className="sr-only">{summary}</span>
            <span aria-hidden>
              {output}
              <span className={`ml-0.5 inline-block h-4 w-2 translate-y-0.5 bg-amber ${done ? 'animate-pulse' : ''}`} />
            </span>
          </div>

          <div className="mt-8 flex flex-wrap items-center gap-3">
            <a href="#projetos" className="focus-ring rounded-md bg-amber px-5 py-2.5 font-mono text-sm font-semibold text-ink transition-transform hover:scale-[1.03] hover:bg-amber-dim">
              {t.hero.ctaProjects}
            </a>
            <a href="#contacto" className="focus-ring rounded-md border border-border px-5 py-2.5 font-mono text-sm text-text transition-colors hover:border-amber hover:text-amber">
              {t.hero.ctaContact}
            </a>
          </div>

          <p className="mt-8 font-mono text-xs text-muted">
            <span className="text-mint">const</span> {t.hero.location} <span className="text-text">=</span>{' '}
            <span className="text-amber">"{profile.location[lang]}"</span>
          </p>
        </div>
      </div>
    </section>
  );
}