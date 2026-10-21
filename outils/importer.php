<?php

/**
 * Importe les icônes empruntées, sous leur nom français, au format maison.
 *
 *     npm pack lucide-static simple-icons && tar xzf …   (dans un dossier à part)
 *     php outils/importer.php <lucide-static/icons> <simple-icons/icons>
 *
 * Le format maison tient sur quelques lignes, un élément par ligne : un diff
 * d'icône se relit. Ni classe, ni largeur, ni hauteur — c'est le projet qui
 * dimensionne, par ses classes — et la couleur est toujours `currentColor`.
 */

[$script, $dossierLucide, $dossierMarques] = $argv + [null, null, null];

if (! is_dir((string) $dossierLucide) || ! is_dir((string) $dossierMarques)) {
    fwrite(STDERR, "usage : php outils/importer.php <lucide-static/icons> <simple-icons/icons>\n");
    exit(1);
}

$sources = require __DIR__.'/sources.php';
$cible = dirname(__DIR__).'/resources/svg';
$manques = [];

$enfants = function (string $chemin): array {
    $dom = new DOMDocument;
    // Les commentaires (licence, version) partent : la licence est dans LICENCES-TIERCES.md.
    $dom->loadXML(preg_replace('/<!--.*?-->/s', '', (string) file_get_contents($chemin)), LIBXML_NONET);

    $lignes = [];
    foreach ($dom->documentElement->childNodes as $noeud) {
        if ($noeud instanceof DOMElement && $noeud->tagName !== 'title') {
            $lignes[] = '  '.trim($dom->saveXML($noeud));
        }
    }

    return $lignes;
};

$ecrire = function (string $nom, string $racine, array $lignes) use ($cible): void {
    $lignes = array_map(fn ($l) => preg_replace('#\s*/>$#', '/>', preg_replace('#></(path|circle|line|rect|polyline|polygon|ellipse)>$#', '/>', $l)), $lignes);
    file_put_contents("{$cible}/{$nom}.svg", $racine."\n".implode("\n", $lignes)."\n</svg>\n");
};

foreach ($sources['lucide'] as $nom => $origine) {
    $chemin = "{$dossierLucide}/{$origine}.svg";
    if (! is_file($chemin)) {
        $manques[] = "lucide:{$origine}";

        continue;
    }

    $ecrire($nom, '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">', $enfants($chemin));
}

foreach ($sources['simple-icons'] as $nom => $origine) {
    $chemin = "{$dossierMarques}/{$origine}.svg";
    if (! is_file($chemin)) {
        $manques[] = "simple-icons:{$origine}";

        continue;
    }

    $ecrire($nom, '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">', $enfants($chemin));
}

$total = count($sources['lucide']) + count($sources['simple-icons']) - count($manques);
echo "{$total} icônes importées.\n";

if ($manques !== []) {
    fwrite(STDERR, 'Introuvables chez la source : '.implode(', ', $manques)."\n");
    exit(1);
}
