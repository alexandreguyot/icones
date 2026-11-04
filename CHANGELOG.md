# Changements

## v0.3.0

### À migrer

| Avant | Après |
| --- | --- |
| `reglages` | `ajuster` |
| `valide` | `succes` |
| `camera` | `filmer` |

Laravel 10 et 11 ne sont plus pris en charge : ils ne reçoivent plus de correctifs de sécurité, et Composer 2.9+ refuse d'installer Laravel 11.

### Ajouts

- Laravel 13.
- Icônes : `annuler`, `chargement`, `dezoomer`, `instagram`, `facebook`, `youtube`, `tiktok`.
- Catalogue : recherche sans accents et par synonymes, publication sur GitHub Pages.

### Corrections

- Catalogue : la recherche et les filtres masquent bien les tuiles.
- Catalogue : plus aucune ressource externe (Google Fonts).
- Tests : la balise `<svg>` elle-même est vérifiée (`onload`, `style`…).
- Import : versions des sources figées, origine inconnue refusée.

### Dessins

Repris pour rester lisibles à 16 px : `tactique`, `passe`, `dribble`, `ecran-de-jeu`, `maillot`, `possession`, `tableau-de-score`.
