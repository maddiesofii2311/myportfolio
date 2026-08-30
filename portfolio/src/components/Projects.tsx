import { useEffect, useState } from 'react';
import { projects } from '../data/portfolio';
import { SectionEyebrow } from './Skills';
import { useLanguage } from '../i18n/LanguageContext';

const stackColor: Record<string, string> = {
  React: 'text-mint',
  Angular: 'text-magenta',
  TypeScript: 'text-cobalt',
  JavaScript: 'text-amber',
  HTML: 'text-rose',
  CSS: 'text-azure',
  Python: 'text-lemon',
  PHP: 'text-violet',
  SQL: 'text-cyan',
  Kivy: 'text-lime',
  Flutter: 'text-teal',
  Django: 'text-amber-dim',
  Flask: 'text-slate',
};

export default function Projects() {
  const { lang, t } = useLanguage();
  const [gallery, setGallery] = useState<{ images: string[]; index: number } | null>(null);

  useEffect(() => {
    if (!gallery) return;
    const onKey = (e: KeyboardEvent) => {
      if (e.key === 'Escape') setGallery(null);
      if (e.key === 'ArrowRight') {
        setGallery((g) => (g ? { ...g, index: (g.index + 1) % g.images.length } : g));
      }
      if (e.key === 'ArrowLeft') {
        setGallery((g) => (g ? { ...g, index: (g.index - 1 + g.images.length) % g.images.length } : g));
      }
    };
    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, [gallery]);

  return (
    <section id="projetos" className="mx-auto max-w-5xl px-3 py-16 sm:px-6 sm:py-24">
      <SectionEyebrow index="03" label={t.projects.eyebrow} />
      <h2 className="mt-3 font-mono text-2xl font-bold text-text sm:text-3xl">{t.projects.heading}</h2>
      <p className="mt-2 max-w-xl text-sm text-muted">{t.projects.subtitle}</p>

      <div className="mt-8 grid gap-5 sm:grid-cols-2">
        {projects.map((project) => (
          <article
            key={project.name}
            className={`group flex flex-col overflow-hidden rounded-lg border bg-surface transition-colors ${
              project.highlight ? 'border-border hover:border-mint' : 'border-border hover:border-amber'
            }`}
          >
            <div className="flex items-center gap-2 border-b border-border bg-surface-hi px-4 py-2.5">
              <span className="h-2 w-2 rounded-full bg-mint/70" />
              <span className="font-mono text-xs text-muted">{project.name}.tsx</span>
            </div>

            <div className="flex flex-1 flex-col px-5 py-5">
              <div className="flex flex-wrap gap-2 font-mono text-xs">
                {project.stack.map((tech) => (
                  <span key={tech} className={stackColor[tech] ?? 'text-text'}>
                    #{tech}
                  </span>
                ))}
              </div>

              <p className="mt-3 flex-1 text-sm leading-relaxed text-muted">
                {project.description[lang]}
              </p>

              <div className="mt-5 flex flex-wrap items-center gap-4 font-mono text-sm">
                {project.repoUrl && (
                  <a
                    href={project.repoUrl}
                    target="_blank"
                    rel="noreferrer"
                    className="focus-ring text-text underline decoration-border underline-offset-4 transition-colors hover:text-amber hover:decoration-amber"
                  >
                    {t.projects.code}
                  </a>
                )}
                {project.liveUrl && (
                  <a
                    href={project.liveUrl}
                    target="_blank"
                    rel="noreferrer"
                    className="focus-ring text-text underline decoration-border underline-offset-4 transition-colors hover:text-mint hover:decoration-mint"
                  >
                    {t.projects.live}
                  </a>
                )}
                {project.images && project.images.length > 0 && (
                  <button
                    type="button"
                    onClick={() => setGallery({ images: project.images!, index: 0 })}
                    className="focus-ring text-text underline decoration-border underline-offset-4 transition-colors hover:text-cyan hover:decoration-cyan"
                  >
                    {t.projects.viewImages}
                  </button>
                )}
                {project.confidential && !project.repoUrl && (
                  <span className="rounded-md border border-border px-2.5 py-1 text-xs text-muted">
                    {t.projects.confidential}
                  </span>
                )}
              </div>
            </div>
          </article>
        ))}
      </div>

      {gallery && (
        <div
          role="dialog"
          aria-modal="true"
          onClick={() => setGallery(null)}
          className="fixed inset-0 z-[100] flex items-center justify-center bg-ink/90 p-4 backdrop-blur-sm"
        >
          <img
            src={gallery.images[gallery.index]}
            alt=""
            onClick={(e) => e.stopPropagation()}
            className="max-h-[85vh] max-w-full rounded-lg border border-border object-contain"
          />

          <button
            type="button"
            onClick={() => setGallery(null)}
            aria-label={lang === 'pt' ? 'Fechar' : 'Close'}
            className="focus-ring absolute right-4 top-4 rounded-md border border-border px-3 py-1.5 font-mono text-sm text-text hover:border-amber hover:text-amber"
          >
            ✕
          </button>

          {gallery.images.length > 1 && (
            <>
              <button
                type="button"
                onClick={(e) => {
                  e.stopPropagation();
                  setGallery((g) => (g ? { ...g, index: (g.index - 1 + g.images.length) % g.images.length } : g));
                }}
                aria-label={lang === 'pt' ? 'Imagem anterior' : 'Previous image'}
                className="focus-ring absolute left-4 top-1/2 -translate-y-1/2 rounded-md border border-border px-3 py-2 font-mono text-text hover:border-amber hover:text-amber"
              >
                ←
              </button>
              <button
                type="button"
                onClick={(e) => {
                  e.stopPropagation();
                  setGallery((g) => (g ? { ...g, index: (g.index + 1) % g.images.length } : g));
                }}
                aria-label={lang === 'pt' ? 'Imagem seguinte' : 'Next image'}
                className="focus-ring absolute right-4 top-1/2 -translate-y-1/2 rounded-md border border-border px-3 py-2 font-mono text-text hover:border-amber hover:text-amber"
              >
                →
              </button>
              <span className="absolute bottom-4 font-mono text-xs text-muted">
                {gallery.index + 1} / {gallery.images.length}
              </span>
            </>
          )}
        </div>
      )}
    </section>
  );
}