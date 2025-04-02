.PHONY: test csfix eslint phpstan audit outdated ci

# Corriger le code avec PHP CS Fixer
csfix:
	vendor/bin/php-cs-fixer fix app database routes tests --config .php-cs-fixer.dist.php --allow-risky=yes --verbose

# Analyse statique du code avec PHPStan
phpstan:
	vendor/bin/phpstan analyse app database tests --memory-limit=512M

# Exécuter les tests PHPUnit
test:
	php artisan test

# Vérifier la sécurité des dépendances PHP
audit:
	composer audit

# Vérifier les dépendances obsolètes
outdated:
	composer outdated

# Vérification de la documentation
phpdoc:
	@vendor/bin/phpdoc

# Vérification des règles de code avec PHP_CodeSniffer
phpcs:
	@vendor/bin/phpcs --standard=PSR12 app/

# Exécuter toutes les vérifications CI
ci: csfix phpstan test audit outdated
