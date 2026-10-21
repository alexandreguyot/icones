<?php

/**
 * Toutes les icônes, rangées par thème, avec leur origine.
 *
 *   'lucide:trash-2'        empruntée à Lucide (ISC), sous ce nom-là chez eux
 *   'simple-icons:whatsapp' logo de marque (Simple Icons, CC0), en aplat
 *   'ici'                   dessinée ici, jamais touchée par l'import
 *
 * Les icônes portent un nom français et décrivent ce qu'elles VEULENT DIRE
 * (« supprimer »), pas ce qu'elles montrent (« trash-2 ») : la source peut
 * renommer ou redessiner, le code des projets ne bouge pas. On relance
 * `outils/importer.php` et seul le dessin change.
 *
 * Le thème range le catalogue. Une icône absente de cette liste fait échouer
 * les tests : on ne dépose pas un SVG sans dire où il va.
 */

return [

    'Basket : le terrain' => [
        'ballon' => 'ici',
        'panier' => 'ici',
        'terrain' => 'ici',
        'carte-des-tirs' => 'ici',
        'lancer-franc' => 'ici',
        'gymnase' => 'ici',
        'vestiaire' => 'ici',
    ],

    'Basket : le jeu' => [
        'tactique' => 'ici',
        'passe' => 'ici',
        'dribble' => 'ici',
        'rebond' => 'ici',
        'dunk' => 'ici',
        'ecran-de-jeu' => 'ici',
    ],

    'Basket : le match' => [
        'feuille-de-match' => 'ici',
        'tableau-de-score' => 'ici',
        'table-de-marque' => 'ici',
        'possession' => 'ici',
        'temps-mort' => 'ici',
        'remplacement' => 'ici',
        'faute' => 'lucide:hand-fist',
        'sifflet' => 'lucide:whistle',
        'chrono' => 'lucide:timer',
    ],

    'Basket : les gens' => [
        'maillot' => 'ici',
        'arbitre' => 'ici',
        'coach' => 'ici',
        'minibasket' => 'ici',
        'chaussure' => 'ici',
        'tee-shirt' => 'lucide:shirt',
    ],

    'Sport' => [
        'trophee' => 'lucide:trophy',
        'medaille' => 'lucide:medal',
        'cible' => 'lucide:target',
        'seance' => 'lucide:presentation',
        'musculation' => 'lucide:dumbbell',
        'bien-etre' => 'lucide:heart-pulse',
        'sante' => 'lucide:stethoscope',
        'drapeau' => 'lucide:flag',
        'couronne' => 'lucide:crown',
    ],

    'Actions' => [
        'ajouter' => 'lucide:plus',
        'retirer' => 'lucide:minus',
        'modifier' => 'lucide:pencil',
        'supprimer' => 'lucide:trash-2',
        'valider' => 'lucide:check',
        'fermer' => 'lucide:x',
        'chercher' => 'lucide:search',
        'filtrer' => 'lucide:funnel',
        'copier' => 'lucide:copy',
        'enregistrer' => 'lucide:save',
        'telecharger' => 'lucide:download',
        'televerser' => 'lucide:upload',
        'importer' => 'lucide:file-up',
        'envoyer' => 'lucide:send',
        'repondre' => 'lucide:reply',
        'partager' => 'lucide:share-2',
        'imprimer' => 'lucide:printer',
        'refaire' => 'lucide:redo-2',
        'synchroniser' => 'lucide:refresh-cw',
        'effacer' => 'lucide:eraser',
        'echanger' => 'lucide:arrow-left-right',
        'deplacer' => 'lucide:move',
        'poignee' => 'lucide:grip-vertical',
        'archiver' => 'lucide:archive',
        'epingler' => 'lucide:pin',
        'joindre' => 'lucide:paperclip',
        'lien' => 'lucide:link',
        'lien-externe' => 'lucide:external-link',
        'reglages' => 'lucide:sliders-horizontal',
        'parametres' => 'lucide:settings',
        'connexion' => 'lucide:log-in',
        'deconnexion' => 'lucide:log-out',
        'saisie' => 'lucide:text-cursor',
        'interdit' => 'lucide:ban',
    ],

    'Navigation' => [
        'menu' => 'lucide:menu',
        'plus-d-actions' => 'lucide:ellipsis',
        'plus-d-actions-vertical' => 'lucide:ellipsis-vertical',
        'fleche-gauche' => 'lucide:arrow-left',
        'fleche-droite' => 'lucide:arrow-right',
        'fleche-haut' => 'lucide:arrow-up',
        'fleche-bas' => 'lucide:arrow-down',
        'trier' => 'lucide:arrow-up-down',
        'chevron-gauche' => 'lucide:chevron-left',
        'chevron-droite' => 'lucide:chevron-right',
        'chevron-haut' => 'lucide:chevron-up',
        'chevron-bas' => 'lucide:chevron-down',
        'agrandir' => 'lucide:maximize',
        'reduire' => 'lucide:minimize',
        'zoomer' => 'lucide:zoom-in',
        'itineraire' => 'lucide:route',
        'position' => 'lucide:navigation',
    ],

    'États' => [
        'valide' => 'lucide:circle-check',
        'verifie' => 'lucide:badge-check',
        'protege' => 'lucide:shield-check',
        'erreur' => 'lucide:circle-x',
        'alerte' => 'lucide:triangle-alert',
        'information' => 'lucide:info',
        'aide' => 'lucide:circle-help',
        'en-attente' => 'lucide:clock-fading',
        'sablier' => 'lucide:hourglass',
        'rond' => 'lucide:circle',
        'etoile' => 'lucide:star',
        'favori' => 'lucide:heart',
        'marque-page' => 'lucide:bookmark',
        'nouveau' => 'lucide:sparkles',
        'voir' => 'lucide:eye',
        'masquer' => 'lucide:eye-off',
        'verrouille' => 'lucide:lock',
        'deverrouille' => 'lucide:lock-open',
        'cle' => 'lucide:key',
        'pouce-haut' => 'lucide:thumbs-up',
        'pouce-bas' => 'lucide:thumbs-down',
    ],

    'Personnes' => [
        'personne' => 'lucide:user',
        'personnes' => 'lucide:users',
        'profil' => 'lucide:circle-user',
        'personne-ajouter' => 'lucide:user-plus',
        'personne-presente' => 'lucide:user-check',
        'personne-absente' => 'lucide:user-x',
        'personne-protegee' => 'lucide:shield-user',
        'gestion-comptes' => 'lucide:user-cog',
        'enfant' => 'lucide:baby',
        'annuaire' => 'lucide:book-user',
        'licence' => 'lucide:id-card',
        'benevolat' => 'lucide:hand-helping',
        'partenaires' => 'lucide:handshake',
        'main-levee' => 'lucide:hand',
    ],

    'Temps' => [
        'calendrier' => 'lucide:calendar-days',
        'calendrier-ajouter' => 'lucide:calendar-plus',
        'calendrier-valide' => 'lucide:calendar-check',
        'calendrier-annule' => 'lucide:calendar-x',
        'calendrier-horaire' => 'lucide:calendar-clock',
        'semaine' => 'lucide:calendar-range',
        'heure' => 'lucide:clock',
        'historique' => 'lucide:history',
        'meteo' => 'lucide:cloud-sun',
        'jour' => 'lucide:sun',
        'nuit' => 'lucide:moon',
    ],

    'Lieux et trajets' => [
        'accueil' => 'lucide:house',
        'lieu' => 'lucide:map-pin',
        'carte' => 'lucide:map',
        'site' => 'lucide:globe',
        'deplacement' => 'lucide:bus',
        'voiture' => 'lucide:car',
        'parking' => 'lucide:square-parking',
        'buvette' => 'lucide:coffee',
    ],

    'Communication' => [
        'courriel' => 'lucide:mail',
        'telephone' => 'lucide:phone',
        'mobile' => 'lucide:smartphone',
        'notification' => 'lucide:bell',
        'notification-coupee' => 'lucide:bell-off',
        'annonce' => 'lucide:megaphone',
        'diffusion' => 'lucide:satellite-dish',
        'message' => 'lucide:message-circle',
        'discussion' => 'lucide:messages-square',
        'micro' => 'lucide:mic',
        'langues' => 'lucide:languages',
        'qr-code' => 'lucide:qr-code',
    ],

    'Club et argent' => [
        'cotisation' => 'lucide:euro',
        'paiement' => 'lucide:credit-card',
        'boutique' => 'lucide:shopping-bag',
        'billet' => 'lucide:ticket',
        'etiquette' => 'lucide:tag',
        'cadeau' => 'lucide:gift',
        'anniversaire' => 'lucide:cake',
        'fete' => 'lucide:party-popper',
        'vote' => 'lucide:vote',
    ],

    'Documents et données' => [
        'statistiques' => 'lucide:chart-column',
        'evolution' => 'lucide:chart-line',
        'tableau' => 'lucide:table',
        'tableur' => 'lucide:file-spreadsheet',
        'liste' => 'lucide:list',
        'taches' => 'lucide:list-checks',
        'presence' => 'lucide:clipboard-check',
        'feuille-de-presence' => 'lucide:clipboard-list',
        'feuille-signee' => 'lucide:file-signature',
        'document' => 'lucide:file-text',
        'livre' => 'lucide:book-open',
        'couches' => 'lucide:layers',
        'organigramme' => 'lucide:network',
    ],

    'Images et écrans' => [
        'photo' => 'lucide:camera',
        'galerie' => 'lucide:images',
        'image-ajouter' => 'lucide:image-plus',
        'video' => 'lucide:film',
        'camera' => 'lucide:video',
        'ordinateur' => 'lucide:monitor',
        'ecran' => 'lucide:tv',
    ],

    'Marques' => [
        'whatsapp' => 'simple-icons:whatsapp',
        'google' => 'simple-icons:google',
    ],

];
