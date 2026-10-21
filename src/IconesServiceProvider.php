<?php

namespace AlexandreGuyot\Icones;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * Déclare la bibliothèque auprès de Blade Icons, sous le préfixe `ico` :
 *
 *     <x-ico-calendrier class="h-5 w-5" />
 *     @svg('ico-ballon', 'h-4 w-4')
 *
 * Blade Icons fait le reste (cache, attributs, composants). On ne pose aucune
 * classe par défaut : la taille appartient au projet, la couleur suit le texte.
 */
class IconesServiceProvider extends ServiceProvider
{
    public const PREFIXE = 'ico';

    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('icones', [
                'path' => self::dossier(),
                'prefix' => self::PREFIXE,
            ]);
        });
    }

    /** Le dossier des SVG : utile aux projets qui veulent lister le catalogue. */
    public static function dossier(): string
    {
        return dirname(__DIR__).'/resources/svg';
    }

    /**
     * Les noms disponibles, triés.
     *
     * @return list<string>
     */
    public static function noms(): array
    {
        $noms = array_map(fn ($f) => basename($f, '.svg'), glob(self::dossier().'/*.svg') ?: []);
        sort($noms);

        return $noms;
    }
}
