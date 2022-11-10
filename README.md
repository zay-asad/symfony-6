## Technical Requirements
- PHP 8.0.2 or higher
- Mamp

## Why use Symfony?
- Symfony is a PHP back-end framework that uses a set of reusable components -> development will be a lot faster.
- Based on the MVC Architecture:

```
Model – focuses on the data-related logic of the web application.
The View – provides the specific model into a web page visible to the user. (UI)
The Controller – acts as an interface between the Model & The View to process incoming requests.
```

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


### 📦 Database stuff
- List Doctrine commands via the symfony console: `symfony console list doctrine`
- Create a new database with doctrine: `symfony console doctrine:database:create` --- 
```PLEASE NOTE that you will need to install the following packages first:``` 

- `composer require symfony/orm-pack`
- `composer require --dev symfony/maker-bundle` - press no (to move this requirement) and then yes at the second promp)
- Also need to have MAMP running locally and change the .env settings in the project.

- Install the `Database Client` VSCode Extension to view DBs 
- Create a new entity: `symfony console make:entity`

### 📦 Linking entities
- Linking an entity via the following steps e.g. linking "actor" entity to "movie" entity
`symfony console make:entity Actor`
`symfony console make:entity Movie`
```
 New property name (press <return> to stop adding fields):
 > actors

 Field type (enter ? to see all types) [string]:
 > ManyToMany

 What class should this entity be related to?:
 > Actor

 Do you want to add a new property to Actor so that you can access/update Movie objects from it - e.g. $actor->getMovies()? (yes/no) [yes]:
 > yes
```

- Now we need to tell Doctrine to migrate the entities. This can be done via the following command: 
`symfony console make:migration`
`symfony console make:migrations:migrate`

- Once the migration is completed, the DB should be updated with the new tables.

