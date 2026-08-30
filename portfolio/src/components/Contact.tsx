import { profile } from '../data/portfolio';
import { SectionEyebrow } from './Skills';
import { useLanguage } from '../i18n/LanguageContext';

export default function Contact() {
  const { lang, t } = useLanguage();
  return (
    <section id="contacto" className="mx-auto max-w-5xl px-3 pb-24 sm:px-6">
      <SectionEyebrow index="04" label={t.contact.eyebrow} />
      <div className="mt-6 rounded-lg border border-border bg-surface px-6 py-10 text-center sm:px-10 sm:py-14">
        <h2 className="font-mono text-2xl font-bold text-text sm:text-3xl">{t.contact.heading}</h2>
        <p className="mx-auto mt-3 max-w-md text-sm text-muted">{t.contact.subtitle}</p>
        <a href={`mailto:${profile.email}`} className="focus-ring mt-6 inline-block rounded-md bg-amber px-6 py-3 font-mono text-sm font-semibold text-ink transition-transform hover:scale-[1.03] hover:bg-amber-dim">
          {profile.email}
        </a>
        <div className="mt-8 flex justify-center gap-6">
          {profile.links.map((link) => (
            <a key={link.label} href={link.url} target="_blank" rel="noreferrer" className="focus-ring font-mono text-sm text-muted underline decoration-border underline-offset-4 transition-colors hover:text-amber hover:decoration-amber">
              {link.label}
            </a>
          ))}
        </div>
      </div>
      <footer className="mt-10 text-center font-mono text-xs text-muted/70">
        <span className="text-amber/70">// </span>
        {t.contact.footer}
        <span className="ml-2 text-border">·</span>
        <span className="ml-2">{profile.location[lang]}</span>
      </footer>
    </section>
  );
}