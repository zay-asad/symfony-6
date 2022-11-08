## Symfony 6 project setup

- Install Symfony CLI: `brew install symfony-cli/tap/symfony-cli`

- Install PHP 8: `use custom alias to switch version`

- Create a new Skeleton Symfony Project using Composer: `composer create-project symfony/skeleton movies`

- Start Server in the background (click to open in browser): `symfony server:start -d`

- Access console: `bin/console` or `symfony console`
- Check Symfony version: `bin/console --version`

- Require the following components:
- `composer require annotations`
- `composer require doctrine maker`
- `composer require maker`

- Create a new Controller: `symfony console make:controller MoviesController`
- Stop Server: `symfony server:stop`