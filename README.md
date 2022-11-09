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
- `composer require twig`

- Create a new Controller: `symfony console make:controller MoviesController`
- Stop Server: `symfony server:stop`
- Check existing routes available in the application: `symfony console debug:router`
- List Doctrine commands via the symfony console: `symfony console list doctrine`
- Create a new database with doctrine: `symfony console doctrine:database:create` --- 
```PLEASE NOTE that you will need to install the following packages first:``` 

- `composer require symfony/orm-pack`
- `composer require --dev symfony/maker-bundle` - press no (to move this requirement) and then yes at the second promp)