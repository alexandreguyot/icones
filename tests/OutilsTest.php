<?php

namespace AlexandreGuyot\Icones\Tests;

use AlexandreGuyot\Icones\IconesServiceProvider;
use DOMDocument;
use PHPUnit\Framework\TestCase;

/** Le catalogue et l'import : ce qu'ils produisent, pas comment ils le font. */
class OutilsTest extends TestCase
{
    private string $dossier;

    protected function setUp(): void
    {
        $this->dossier = sys_get_temp_dir().'/icones-'.uniqid();
        mkdir($this->dossier, recursive: true);
    }

    protected function tearDown(): void
    {
        exec('rm -rf '.escapeshellarg($this->dossier));
    }

    private function catalogue(): string
    {
        exec('php '.escapeshellarg(dirname(__DIR__).'/outils/catalogue.php').' '.escapeshellarg($this->dossier), $sortie, $code);
        $this->assertSame(0, $code, implode("\n", $sortie));

        return (string) file_get_contents("{$this->dossier}/index.html");
    }

    /** `.tuile { display: flex }` l'emporterait sur `hidden` : recherche et filtres ne masqueraient rien. */
    public function test_le_catalogue_masque_vraiment_les_tuiles_filtrees(): void
    {
        $this->assertMatchesRegularExpression('/\[hidden\]\s*\{\s*display:\s*none\s*!important/', $this->catalogue());
    }

    public function test_le_catalogue_ne_charge_rien_de_l_exterieur(): void
    {
        $this->assertDoesNotMatchRegularExpression('/(href|src)="https?:/', $this->catalogue());
    }

    public function test_le_catalogue_range_titre_et_styles_dans_le_head(): void
    {
        $dom = new DOMDocument;
        @$dom->loadHTML($this->catalogue());
        $head = $dom->getElementsByTagName('head')->item(0);

        $this->assertSame(1, $head->getElementsByTagName('title')->length);
        $this->assertSame(1, $head->getElementsByTagName('style')->length);
    }

    public function test_la_recherche_du_catalogue_ignore_les_accents(): void
    {
        $this->assertStringContainsString("normalize('NFD')", $this->catalogue());
    }

    /** Les noms disent le sens : les synonymes permettent de chercher ce que l'icône montre. */
    public function test_on_trouve_une_icone_par_ce_qu_elle_montre(): void
    {
        $this->assertMatchesRegularExpression('/data-nom="supprimer"[^>]*data-cles="[^"]*poubelle/', $this->catalogue());
    }

    public function test_les_synonymes_portent_sur_des_icones_existantes_et_sans_accent(): void
    {
        foreach (require dirname(__DIR__).'/outils/synonymes.php' as $nom => $mots) {
            $this->assertContains($nom, IconesServiceProvider::noms());

            foreach ($mots as $mot) {
                $this->assertMatchesRegularExpression('/^[a-z0-9 -]+$/', $mot, $nom);
            }
        }
    }

    public function test_les_licences_annoncent_les_versions_figees(): void
    {
        $versions = require dirname(__DIR__).'/outils/versions.php';
        $licences = (string) file_get_contents(dirname(__DIR__).'/LICENCES-TIERCES.md');

        $this->assertStringContainsString("Lucide (https://lucide.dev), version {$versions['lucide']}", $licences);
        $this->assertStringContainsString("Simple Icons (https://simpleicons.org), version {$versions['simple-icons']}", $licences);
    }

    /** Importer une autre version redessinerait des icônes sans que personne l'ait décidé. */
    public function test_l_import_refuse_une_autre_version_que_celle_figee(): void
    {
        foreach (['lucide', 'simple-icons'] as $source) {
            mkdir("{$this->dossier}/{$source}/icons", recursive: true);
            file_put_contents("{$this->dossier}/{$source}/package.json", '{"version":"0.0.1"}');
        }

        $commande = 'php '.escapeshellarg(dirname(__DIR__).'/outils/importer.php')
            .' '.escapeshellarg("{$this->dossier}/lucide/icons")
            .' '.escapeshellarg("{$this->dossier}/simple-icons/icons").' 2>&1';
        exec($commande, $sortie, $code);

        $this->assertSame(1, $code);
        $this->assertStringContainsString('version', implode("\n", $sortie));
    }
}
