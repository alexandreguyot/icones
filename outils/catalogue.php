<?php

/**
 * Fabrique le catalogue des icônes : une page HTML autonome, sans dépendance.
 *
 *     php outils/catalogue.php
 *
 *   catalogue/index.html    à ouvrir dans le navigateur (document complet)
 *   catalogue/fragment.html la même page sans squelette, pour une publication
 *                           qui fournit le sien
 *
 * Un clic sur une icône copie le composant Blade prêt à coller : on choisit
 * une icône en la regardant, pas en devinant son nom.
 */

$racine = dirname(__DIR__);
$sources = require __DIR__.'/sources.php';
$version = trim((string) @shell_exec('git -C '.escapeshellarg($racine).' describe --tags --always 2>/dev/null')) ?: 'dev';

$origine = [];
foreach ($sources['lucide'] as $nom => $chez) {
    $origine[$nom] = ['lucide', $chez];
}
foreach ($sources['simple-icons'] as $nom => $chez) {
    $origine[$nom] = ['marque', $chez];
}

$tuiles = [];
$compte = ['maison' => 0, 'lucide' => 0, 'marque' => 0];
$fichiers = glob("{$racine}/resources/svg/*.svg") ?: [];
sort($fichiers);

foreach ($fichiers as $fichier) {
    $nom = basename($fichier, '.svg');
    [$source, $chez] = $origine[$nom] ?? ['maison', ''];
    $compte[$source]++;

    $svg = preg_replace('/^<svg /', '<svg aria-hidden="true" ', trim((string) file_get_contents($fichier)));
    $cles = htmlspecialchars(trim("{$nom} {$chez}"), ENT_QUOTES);
    $titre = $chez !== '' ? " title=\"{$chez}\"" : '';

    $tuiles[$source][] = "<button type=\"button\" class=\"tuile\" data-nom=\"{$nom}\" data-cles=\"{$cles}\"{$titre}>"
        ."{$svg}<span class=\"nom\">{$nom}</span></button>";
}

$sections = '';
foreach ([
    'maison' => ['Dessinées ici', 'Le basket et ce que les autres bibliothèques n\'ont pas.'],
    'lucide' => ['Lucide', 'Empruntées à Lucide (ISC), renommées en français. Survolez pour voir le nom d\'origine.'],
    'marque' => ['Marques', 'Logos en aplat (Simple Icons, CC0). On ne les redessine pas.'],
] as $source => [$titre, $legende]) {
    if (empty($tuiles[$source])) {
        continue;
    }

    $sections .= "<section class=\"groupe\" data-source=\"{$source}\">"
        ."<header><h2>{$titre} <span class=\"nb\">".count($tuiles[$source])."</span></h2><p>{$legende}</p></header>"
        .'<div class="grille">'.implode('', $tuiles[$source]).'</div></section>';
}

$total = array_sum($compte);

$page = <<<HTML
<title>Icônes Alexandre</title>
<meta name="claude:viewport-fit-sides" content="cover">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&display=swap">
<style>
/* Une planche de contact : barre d'outils collante, puis des grilles de tuiles égales par origine. */
:root {
  --fond: #f6f5f2;
  --tuile: #ffffff;
  --encre: #1d1b18;
  --doux: #6b655d;
  --filet: #e3dfd8;
  --accent: #c9531f;
  --accent-doux: #fbe9df;
  --titre: "Anton", "Impact", "Arial Narrow", sans-serif;
  --texte: "IBM Plex Sans", system-ui, -apple-system, "Segoe UI", sans-serif;
  --code: "IBM Plex Mono", ui-monospace, "SFMono-Regular", Menlo, monospace;
  --taille: 24px;
}
@media (prefers-color-scheme: dark) {
  :root:not([data-theme="light"]) {
    --fond: #171614; --tuile: #211f1c; --encre: #efebe4; --doux: #a39b90;
    --filet: #34312c; --accent: #f07a45; --accent-doux: #3a2419; color-scheme: dark;
  }
}
:root[data-theme="dark"] {
  --fond: #171614; --tuile: #211f1c; --encre: #efebe4; --doux: #a39b90;
  --filet: #34312c; --accent: #f07a45; --accent-doux: #3a2419; color-scheme: dark;
}
* { box-sizing: border-box; }
body {
  margin: 0; background: var(--fond); color: var(--encre);
  font: 15px/1.5 var(--texte);
}
body::before {
  content: ""; position: fixed; inset: 0 0 auto; height: env(safe-area-inset-top, 0px);
  z-index: 10; background: var(--fond);
}
.cadre {
  max-width: 1120px; margin: 0 auto;
  padding-left: max(16px, env(safe-area-inset-left, 0px));
  padding-right: max(16px, env(safe-area-inset-right, 0px));
  padding-block: 32px 64px;
}
.entete { display: flex; flex-wrap: wrap; align-items: baseline; gap: 8px 20px; }
h1 {
  font: 400 clamp(36px, 7vw, 56px)/1 var(--titre); letter-spacing: .01em; margin: 0;
  text-transform: uppercase; text-wrap: balance;
}
.compteur { font: 500 13px var(--code); color: var(--doux); font-variant-numeric: tabular-nums; }
.usage {
  margin: 16px 0 0; font: 13px/1.6 var(--code); color: var(--doux);
  display: flex; flex-wrap: wrap; gap: 4px 18px;
}
.usage code { color: var(--encre); }
.outils {
  position: sticky; top: env(safe-area-inset-top, 0px); z-index: 5;
  display: flex; flex-wrap: wrap; gap: 10px; align-items: center;
  margin-top: 24px; padding-block: 12px; background: var(--fond);
  border-bottom: 1px solid var(--filet);
}
#recherche {
  flex: 1 1 220px; min-width: 0; font: 15px var(--texte); color: var(--encre);
  background: var(--tuile); border: 1px solid var(--filet); border-radius: 8px; padding: 9px 12px;
}
#recherche:focus-visible, .puce:focus-visible, .tuile:focus-visible {
  outline: 2px solid var(--accent); outline-offset: 2px;
}
.puces { display: flex; gap: 6px; flex-wrap: wrap; }
.puce {
  font: 500 13px var(--texte); color: var(--doux); background: transparent; cursor: pointer;
  border: 1px solid var(--filet); border-radius: 999px; padding: 6px 12px;
}
.puce[aria-pressed="true"] { color: var(--accent); border-color: var(--accent); background: var(--accent-doux); }
.groupe { margin-top: 36px; }
.groupe header { display: flex; flex-wrap: wrap; align-items: baseline; gap: 4px 14px; margin-bottom: 14px; }
h2 { font: 400 22px/1.1 var(--titre); text-transform: uppercase; letter-spacing: .03em; margin: 0; }
.nb { font: 500 12px var(--code); color: var(--doux); letter-spacing: 0; vertical-align: middle; }
.groupe p { margin: 0; color: var(--doux); font-size: 13px; }
.grille { display: grid; grid-template-columns: repeat(auto-fill, minmax(118px, 1fr)); gap: 8px; }
.tuile {
  display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px;
  min-width: 0; min-height: 104px; padding: 16px 8px 12px; cursor: pointer;
  background: var(--tuile); color: var(--encre); border: 1px solid var(--filet); border-radius: 6px;
  transition: border-color .12s, color .12s;
}
.tuile:hover { border-color: var(--accent); color: var(--accent); }
.tuile svg { width: var(--taille); height: var(--taille); flex: none; }
.nom {
  font: 12px var(--code); color: var(--doux); max-width: 100%;
  overflow-wrap: anywhere; text-align: center;
}
.vide { margin-top: 40px; color: var(--doux); }
.toast {
  position: fixed; left: 50%; transform: translateX(-50%);
  bottom: calc(20px + env(safe-area-inset-bottom, 0px)); z-index: 20;
  background: var(--encre); color: var(--fond); font: 13px var(--code);
  padding: 10px 14px; border-radius: 8px; max-width: calc(100vw - 32px); overflow-wrap: anywhere;
}
@media (prefers-reduced-motion: reduce) { .tuile { transition: none; } }
</style>

<main class="cadre">
  <div class="entete">
    <h1>Icônes</h1>
    <span class="compteur">{$total} icônes · {$version}</span>
  </div>
  <div class="usage">
    <span>Blade : <code>&lt;x-ico-<i>nom</i> class="h-5 w-5" /&gt;</code></span>
    <span>ou <code>@svg('ico-<i>nom</i>', 'h-5 w-5')</code></span>
    <span>Un clic copie le composant.</span>
  </div>

  <div class="outils" role="search">
    <label for="recherche" hidden>Chercher une icône</label>
    <input id="recherche" type="search" placeholder="Chercher (calendrier, trash, ballon…)" autocomplete="off">
    <div class="puces" role="group" aria-label="Origine">
      <button type="button" class="puce" data-filtre="" aria-pressed="true">Toutes</button>
      <button type="button" class="puce" data-filtre="maison" aria-pressed="false">Ici {$compte['maison']}</button>
      <button type="button" class="puce" data-filtre="lucide" aria-pressed="false">Lucide {$compte['lucide']}</button>
      <button type="button" class="puce" data-filtre="marque" aria-pressed="false">Marques {$compte['marque']}</button>
    </div>
    <div class="puces" role="group" aria-label="Taille">
      <button type="button" class="puce" data-taille="16" aria-pressed="false">16</button>
      <button type="button" class="puce" data-taille="24" aria-pressed="true">24</button>
      <button type="button" class="puce" data-taille="40" aria-pressed="false">40</button>
    </div>
  </div>

  {$sections}
  <p class="vide" hidden>Aucune icône ne porte ce nom. Le nom d'origine Lucide marche aussi (trash, house…).</p>
</main>
<div class="toast" role="status" hidden></div>

<script>
(() => {
  const champ = document.getElementById('recherche');
  const tuiles = [...document.querySelectorAll('.tuile')];
  const groupes = [...document.querySelectorAll('.groupe')];
  const vide = document.querySelector('.vide');
  const toast = document.querySelector('.toast');
  let filtre = '';

  const appliquer = () => {
    const q = champ.value.trim().toLowerCase();
    let visibles = 0;
    groupes.forEach(g => {
      const ouvert = !filtre || g.dataset.source === filtre;
      let n = 0;
      g.querySelectorAll('.tuile').forEach(t => {
        const ok = ouvert && (!q || t.dataset.cles.includes(q));
        t.hidden = !ok;
        if (ok) n++;
      });
      g.hidden = n === 0;
      visibles += n;
    });
    vide.hidden = visibles > 0;
  };

  champ.addEventListener('input', appliquer);

  const presser = (groupe, bouton) => {
    groupe.querySelectorAll('.puce').forEach(b => b.setAttribute('aria-pressed', String(b === bouton)));
  };

  document.querySelectorAll('[data-filtre]').forEach(b => b.addEventListener('click', () => {
    filtre = b.dataset.filtre;
    presser(b.parentElement, b);
    appliquer();
  }));

  document.querySelectorAll('[data-taille]').forEach(b => b.addEventListener('click', () => {
    document.documentElement.style.setProperty('--taille', b.dataset.taille + 'px');
    presser(b.parentElement, b);
  }));

  let minuterie;
  const dire = texte => {
    toast.textContent = texte;
    toast.hidden = false;
    clearTimeout(minuterie);
    minuterie = setTimeout(() => { toast.hidden = true; }, 1800);
  };

  tuiles.forEach(t => t.addEventListener('click', () => {
    const code = '<x-ico-' + t.dataset.nom + ' class="h-5 w-5" />';
    const repli = () => dire(code);
    if (navigator.clipboard?.writeText) {
      navigator.clipboard.writeText(code).then(() => dire('Copié : ' + code), repli);
    } else {
      repli();
    }
  }));
})();
</script>
HTML;

@mkdir("{$racine}/catalogue");
file_put_contents("{$racine}/catalogue/fragment.html", $page."\n");
file_put_contents(
    "{$racine}/catalogue/index.html",
    "<!doctype html>\n<html lang=\"fr\">\n<head>\n<meta charset=\"utf-8\">\n"
    ."<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, viewport-fit=cover\">\n"
    ."</head>\n<body>\n{$page}\n</body>\n</html>\n",
);

echo "Catalogue : {$total} icônes ({$compte['maison']} ici, {$compte['lucide']} Lucide, {$compte['marque']} marques).\n";
