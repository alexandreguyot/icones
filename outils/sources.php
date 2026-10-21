<?php

/**
 * D'où vient chaque icône empruntée : nom français => nom chez la source.
 *
 * Les icônes portent un nom français et décrivent ce qu'elles VEULENT DIRE
 * (« supprimer »), pas ce qu'elles montrent (« trash-2 ») : la source peut
 * renommer ou redessiner, le code des projets ne bouge pas. On relance
 * `outils/importer.php` et seul le dessin change.
 *
 * Les icônes dessinées ici (dossier `resources/svg`, absentes de cette liste)
 * ne sont jamais touchées par l'import.
 */

return [

    // Lucide (ISC) — trait de 2 sur grille 24, extrémités arrondies.
    'lucide' => [
        // Actions
        'ajouter' => 'plus',
        'retirer' => 'minus',
        'modifier' => 'pencil',
        'supprimer' => 'trash-2',
        'valider' => 'check',
        'fermer' => 'x',
        'chercher' => 'search',
        'copier' => 'copy',
        'telecharger' => 'download',
        'importer' => 'file-up',
        'envoyer' => 'send',
        'repondre' => 'reply',
        'refaire' => 'redo-2',
        'synchroniser' => 'refresh-cw',
        'effacer' => 'eraser',
        'echanger' => 'arrow-left-right',
        'interdit' => 'ban',
        'lien-externe' => 'external-link',
        'reglages' => 'sliders-horizontal',
        'connexion' => 'log-in',
        'deconnexion' => 'log-out',
        'menu' => 'menu',
        'saisie' => 'text-cursor',

        // Directions
        'fleche-gauche' => 'arrow-left',
        'fleche-droite' => 'arrow-right',
        'fleche-haut' => 'arrow-up',
        'fleche-bas' => 'arrow-down',
        'trier' => 'arrow-up-down',
        'chevron-gauche' => 'chevron-left',
        'chevron-droite' => 'chevron-right',
        'chevron-haut' => 'chevron-up',
        'chevron-bas' => 'chevron-down',

        // États
        'valide' => 'circle-check',
        'erreur' => 'circle-x',
        'alerte' => 'triangle-alert',
        'en-attente' => 'clock-fading',
        'sablier' => 'hourglass',
        'rond' => 'circle',
        'etoile' => 'star',
        'drapeau' => 'flag',
        'notification' => 'bell',
        'annonce' => 'megaphone',
        'diffusion' => 'satellite-dish',

        // Personnes
        'personne' => 'user',
        'personnes' => 'users',
        'profil' => 'circle-user',
        'personne-ajouter' => 'user-plus',
        'personne-absente' => 'user-x',
        'personne-protegee' => 'shield-user',
        'gestion-comptes' => 'user-cog',
        'annuaire' => 'book-user',
        'licence' => 'id-card',
        'benevolat' => 'hand-helping',
        'partenaires' => 'handshake',
        'main-levee' => 'hand',

        // Temps
        'calendrier' => 'calendar-days',
        'calendrier-ajouter' => 'calendar-plus',
        'calendrier-valide' => 'calendar-check',
        'calendrier-annule' => 'calendar-x',
        'semaine' => 'calendar-range',
        'heure' => 'clock',
        'chrono' => 'timer',
        'historique' => 'history',

        // Lieux, contact
        'accueil' => 'house',
        'lieu' => 'map-pin',
        'carte' => 'map',
        'site' => 'globe',
        'courriel' => 'mail',
        'telephone' => 'phone',
        'deplacement' => 'bus',
        'buvette' => 'coffee',

        // Données, documents
        'statistiques' => 'chart-column',
        'evolution' => 'chart-line',
        'tableau' => 'table',
        'liste' => 'list',
        'taches' => 'list-checks',
        'presence' => 'clipboard-check',
        'feuille-signee' => 'file-signature',
        'document' => 'file-text',
        'livre' => 'book-open',
        'couches' => 'layers',
        'organigramme' => 'network',
        'video' => 'film',
        'ordinateur' => 'monitor',
        'ecran' => 'tv',

        // Sport
        'trophee' => 'trophy',
        'cible' => 'target',
        'sifflet' => 'whistle',
        'seance' => 'presentation',
        'musculation' => 'dumbbell',
        'bien-etre' => 'heart-pulse',
        'sante' => 'stethoscope',
    ],

    // Simple Icons (CC0) — logos de marque, en aplat. Une marque se dessine
    // comme elle est : on ne la redessine pas au trait.
    'simple-icons' => [
        'whatsapp' => 'whatsapp',
        'google' => 'google',
    ],

];
