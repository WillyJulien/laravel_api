<?php

// .php-cs-fixer.dist.php

use PhpCsFixer\Config;

return (new Config())
    ->setRules([
        '@PSR12' => true, // Tu peux ajouter les règles que tu souhaites ici.
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(['app', 'database', 'routes', 'tests']) // Chemins des dossiers à analyser
    );
