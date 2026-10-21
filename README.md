# Icônes

Ma bibliothèque d'icônes pour les projets Laravel. Les noms sont en français
et disent ce que l'icône **veut dire** (`supprimer`), pas ce qu'elle montre
(`trash-2`).

Les icônes de base viennent de [Lucide](https://lucide.dev). Celles du basket
(ballon, panier, terrain, feuille de match…) sont dessinées ici.

## Installer

Le paquet n'est pas sur Packagist : on déclare le dépôt dans le projet.

```json
"repositories": [
    { "type": "vcs", "url": "https://github.com/alexandreguyot/icones" }
]
```

```bash
composer require alexandreguyot/icones
```

Le fournisseur de service s'enregistre tout seul. Les icônes passent par
[Blade Icons](https://github.com/blade-ui-kit/blade-icons) : cache, attributs
et composants viennent de là.

## Utiliser

```blade
<x-ico-calendrier class="h-5 w-5" />
<x-ico-supprimer class="h-4 w-4 text-red-600" aria-hidden="true" />
@svg('ico-ballon', 'h-6 w-6')
```

- **La taille** vient des classes du projet. Le SVG n'en impose aucune.
- **La couleur** suit le texte (`currentColor`) : `text-brand` suffit.
- **Une icône seule** (sans texte à côté) a besoin d'un nom pour le lecteur
  d'écran. Mets `aria-label` sur le bouton qui la porte, et `aria-hidden="true"`
  sur l'icône.

Pour lister les icônes depuis un projet : `IconesServiceProvider::noms()`.

## Le catalogue

```bash
composer catalogue      # → catalogue/index.html
```

Une page avec recherche (nom français ou nom Lucide), filtre par origine et
choix de la taille. Un clic copie le composant.

## Règle de dessin

Toute icône de la bibliothèque respecte ces règles. `tests/SvgTest.php` les
vérifie fichier par fichier, et la CI refuse une icône qui s'en écarte.

- **Grille** : `viewBox="0 0 24 24"`, sans `width` ni `height`.
- **Trait** : `fill="none"`, `stroke="currentColor"`, `stroke-width="2"`, avec
  extrémités et jonctions arrondies. Les attributs se posent sur `<svg>`, jamais
  sur un élément enfant. Seule exception : un petit point plein
  (`fill="currentColor"`) dans une icône au trait.
- **Aplat** (marques seulement) : `fill="currentColor"`.
- **Aucune couleur en dur.** Une couleur fixe ne suit plus le thème du club.
- **Seulement des formes** : `path`, `circle`, `line`, `rect`, `polyline`,
  `polygon`, `ellipse`, `g`. Ni script, ni lien, ni `on…`. Un SVG inline
  s'exécute dans la page.
- **Un point** se dessine `M12 7h.01`. L'extrémité arrondie en fait un rond.
- **Le nom** est en minuscules, avec des tirets et sans accent (`feuille-de-match`).

## Ajouter une icône

Toute icône se déclare dans `outils/sources.php`, sous son thème : c'est ce
qui range le catalogue. Un SVG non déclaré fait échouer les tests.

**Dessinée ici :** déposer `resources/svg/<nom>.svg` en suivant la règle, et
déclarer `'<nom>' => 'ici'`. Lancer ensuite `composer test` et
`composer catalogue` pour la regarder à 16, 24 et 40 px.

**Empruntée à Lucide :** déclarer `'<nom-francais>' => 'lucide:<nom-lucide>'`,
puis relancer l'import :

```bash
mkdir /tmp/sources && cd /tmp/sources
npm pack lucide-static simple-icons && for f in *.tgz; do mkdir "${f%.tgz}" && tar xzf "$f" -C "${f%.tgz}"; done
cd - && php outils/importer.php /tmp/sources/lucide-static-*/package/icons /tmp/sources/simple-icons-*/package/icons
```

L'import réécrit toutes les icônes empruntées, ce qui fait aussi suivre les
retouches de Lucide. Il ne touche jamais aux icônes dessinées ici.

## Versions

Un tag par livraison (`v0.2.0`…). Ajouter une icône, c'est une version
mineure. Renommer ou supprimer une icône casse les projets qui l'utilisent :
c'est une version majeure.

## Licences

Le code et les icônes dessinées ici sont sous licence MIT. Les icônes
empruntées gardent la leur : voir [LICENCES-TIERCES.md](LICENCES-TIERCES.md).
