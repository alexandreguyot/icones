<?php

namespace AlexandreGuyot\Icones\Tests;

use AlexandreGuyot\Icones\IconesServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Illuminate\Support\Facades\Blade;
use Orchestra\Testbench\TestCase;

/** Ce qu'un projet Laravel obtient une fois le paquet installé. */
class ComposantTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [BladeIconsServiceProvider::class, IconesServiceProvider::class];
    }

    public function test_le_composant_rend_le_svg_avec_les_classes_du_projet(): void
    {
        $html = Blade::render('<x-ico-ballon class="h-5 w-5 text-brand" />');

        $this->assertStringContainsString('<svg', $html);
        $this->assertStringContainsString('class="h-5 w-5 text-brand"', $html);
        $this->assertStringContainsString('stroke="currentColor"', $html);
    }

    public function test_la_directive_svg_fonctionne_aussi(): void
    {
        $html = Blade::render("@svg('ico-calendrier', 'h-4 w-4')");

        $this->assertStringContainsString('class="h-4 w-4"', $html);
    }

    /** Une icône seule ne se lit pas au lecteur d'écran : on doit pouvoir la nommer. */
    public function test_les_attributs_passent_tels_quels(): void
    {
        $html = Blade::render('<x-ico-supprimer aria-hidden="true" />');

        $this->assertStringContainsString('aria-hidden="true"', $html);
    }
}
