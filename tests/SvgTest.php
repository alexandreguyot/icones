<?php

namespace AlexandreGuyot\Icones\Tests;

use AlexandreGuyot\Icones\IconesServiceProvider;
use DOMDocument;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * La règle de dessin, vérifiée sur chaque fichier.
 *
 * Une bibliothèque reste homogène tant qu'on ne peut pas y glisser une icône
 * « presque pareille ». Ces vérifications sont celles qu'on oublie à la main :
 * une couleur en dur ne suit plus le thème du club, un `width` impose sa taille,
 * un script dans un SVG inline s'exécute dans la page.
 */
class SvgTest extends TestCase
{
    /** @return array<string,array{string}> */
    public static function icones(): array
    {
        $cas = [];
        foreach (IconesServiceProvider::noms() as $nom) {
            $cas[$nom] = [$nom];
        }

        return $cas;
    }

    private function charger(string $nom): DOMDocument
    {
        $dom = new DOMDocument;
        $this->assertTrue(
            @$dom->loadXML((string) file_get_contents(IconesServiceProvider::dossier()."/{$nom}.svg"), LIBXML_NONET),
            "{$nom}.svg n'est pas un XML valide",
        );

        return $dom;
    }

    public function test_la_bibliotheque_n_est_pas_vide(): void
    {
        $this->assertGreaterThan(50, count(IconesServiceProvider::noms()));
    }

    #[DataProvider('icones')]
    public function test_le_nom_est_en_minuscules_et_tirets(string $nom): void
    {
        $this->assertMatchesRegularExpression('/^[a-z0-9]+(-[a-z0-9]+)*$/', $nom);
    }

    #[DataProvider('icones')]
    public function test_la_grille_est_de_24_sans_taille_imposee(string $nom): void
    {
        $svg = $this->charger($nom)->documentElement;

        $this->assertSame('svg', $svg->tagName);
        $this->assertSame('0 0 24 24', $svg->getAttribute('viewBox'));
        $this->assertFalse($svg->hasAttribute('width'), "{$nom} impose une largeur");
        $this->assertFalse($svg->hasAttribute('height'), "{$nom} impose une hauteur");
        $this->assertFalse($svg->hasAttribute('class'), "{$nom} porte une classe");
    }

    /** Trait (2, arrondi) ou aplat : une icône est l'un ou l'autre, jamais un mélange. */
    #[DataProvider('icones')]
    public function test_trait_ou_aplat_mais_toujours_la_couleur_du_texte(string $nom): void
    {
        $svg = $this->charger($nom)->documentElement;

        if ($svg->getAttribute('fill') === 'none') {
            $this->assertSame('currentColor', $svg->getAttribute('stroke'), $nom);
            $this->assertSame('2', $svg->getAttribute('stroke-width'), $nom);
            $this->assertSame('round', $svg->getAttribute('stroke-linecap'), $nom);
            $this->assertSame('round', $svg->getAttribute('stroke-linejoin'), $nom);
        } else {
            $this->assertSame('currentColor', $svg->getAttribute('fill'), $nom);
        }

        foreach ($svg->getElementsByTagName('*') as $element) {
            foreach (['fill', 'stroke', 'color', 'style', 'stroke-width'] as $attribut) {
                $this->assertFalse(
                    $element->hasAttribute($attribut),
                    "{$nom} : <{$element->tagName}> redéfinit « {$attribut} »",
                );
            }
        }
    }

    #[DataProvider('icones')]
    public function test_rien_qui_s_execute_ni_ne_charge(string $nom): void
    {
        $permis = ['path', 'circle', 'line', 'rect', 'polyline', 'polygon', 'ellipse', 'g'];

        foreach ($this->charger($nom)->documentElement->getElementsByTagName('*') as $element) {
            $this->assertContains($element->tagName, $permis, "{$nom} : <{$element->tagName}> interdit");

            foreach ($element->attributes as $attribut) {
                $this->assertDoesNotMatchRegularExpression('/^(on|href|xlink)/i', $attribut->name, $nom);
            }
        }
    }
}
