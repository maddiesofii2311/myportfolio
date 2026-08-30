import { skillGroups } from '../data/portfolio';
import { useLanguage } from '../i18n/LanguageContext';
import type { Localized, Lang } from '../i18n/types';

function resolveItem(item: string | Localized, lang: Lang): string {
  return typeof item === 'string' ? item : item[lang];
}

export default function Skills() {
  const { lang, t } = useLanguage();
  return (
    <section id="skills" className="mx-auto max-w-5xl px-3 py-16 sm:px-6 sm:py-24">
      <SectionEyebrow index="02" label={t.skills.eyebrow} />
      <h2 className="mt-3 font-mono text-2xl font-bold text-text sm:text-3xl">{t.skills.heading}</h2>
      <div className="mt-8 overflow-hidden rounded-lg border border-border bg-surface">
        <div className="flex items-center gap-2 border-b border-border bg-surface-hi px-4 py-2.5">
          <FolderIcon />
          <span className="font-mono text-xs text-muted">{t.skills.stackFolder}</span>
        </div>
        <div className="divide-y divide-border">
          {skillGroups.map((group) => (
            <div key={group.folder.en} className="px-4 py-4 sm:px-6">
              <div className="flex items-center gap-2 font-mono text-sm text-mint">
                <FolderIcon />
                <span>{group.folder[lang]}</span>
                <span className="text-muted">{group.extension}</span>
              </div>
              <ul className="mt-3 ml-6 flex flex-wrap gap-2 border-l border-border pl-4">
                {group.items.map((item) => {
                  const label = resolveItem(item, lang);
                  return (
                    <li
                      key={label}
                      className="rounded-md border border-border bg-surface-hi px-3 py-1.5 font-mono text-sm text-text transition-colors hover:border-amber hover:text-amber"
                    >
                      {label}
                    </li>
                  );
                })}
              </ul>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

export function SectionEyebrow({ index, label }: { index: string; label: string }) {
  return (
    <p className="flex items-center gap-2 font-mono text-xs text-muted">
      <span className="text-amber">{index}</span>
      <span aria-hidden>/</span>
      <span>{label}</span>
    </p>
  );
}

function FolderIcon() {
  return (
    <svg aria-hidden viewBox="0 0 20 20" className="h-4 w-4 shrink-0 fill-none stroke-current stroke-[1.6]">
      <path d="M2.5 5.5a1 1 0 0 1 1-1h4l1.5 2h7.5a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-13a1 1 0 0 1-1-1v-9Z" />
    </svg>
  );
}