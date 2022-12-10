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

- Mamp is up and running and the port numbers should match the local env settings for this project.

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
- Also need to have MAMP running locally and change the .env settings in the project to match the correct port. (also check local phpmyadmin>config.sample file)

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
`symfony console doctrine:migrations:migrate`

- Once the migration is completed, the DB should be updated with the new tables.


### 📦 Doctrine relationships https://symfony.com/doc/current/doctrine/associations.html
- ManyToOne e.g. many students are working on one 'university project' / one 'university project' has many 'students' that work on the project
- OneToMany e.g. one 'Country' has many 'States' / one 'State' is located in only one 'Country'
- OneToOne e.g. one 'Car' has one 'steering wheel' / one 'steering wheel' inside one 'Car'
- ManyToMany e.g. many movies have many actors


### 📦 Load dummy data into the DB
- `composer require --dev doctrine/doctrine-fixtures-bundle`
- `symfony console doctrine:fixtures:load`
- Create objects into your Repository and then run the load command
- Load data into DataFixtures: `symfony console doctrine:fixtures:load`
- New data is now inserted in the DB!

### 📦 Repository
- This is the only part of the application that interacts with the DB. 

### 🎨 Compile CSS & JS
Webpack Encore is a simpler way to integrate Webpack into your application. It wraps Webpack, giving you a clean & powerful API for bundling JavaScript modules, pre-processing CSS & JS and compiling and minifying assets.
- `composer require symfony/webpack-encore-bundle`
`npm install webpack-notifier@^1.6.0 --save-dev`

Everytime you make a change to the .css or .js file you need to compile your assets first:
`npm run dev`

Manage assets
`composer require symfony/asset`

Add this line in your base twig template (this is referencing the build folder once an asset has been compiled)
```{% block stylesheets %}
            <link rel="stylesheet" href="{{ asset('build/app.css') }}">
        {% endblock %}
```

### 🎨 Installing tailwind 3
`npm install -D tailwindcss postcss-loader purgecss-webpack-plugin glob-all path`
`npx tailwindcss init -p`
Add `enablePostCssLoader` in webpack.config.js
### 🎨 Compile tailwind based on the changes you've made e.g. styles>app.css

`npx tailwindcss -i ./assets/styles/app.css -o ./public/build/app.css --watch`

All new tailwind classes will be compiled in public>build>app.css


### Adding images in the twig template
`npm install -file-loader --save-dev`
create images folder inside `assets`
Add copyImages method inside webpack.config
`npm run dev`: compile assets


### Symfony forms
`composer require symfony/form`
Creating a new form: `symfony console make:form MovieFormType Movie` where `Movie` is the model associated to it. This will also need to be adjusted depeneding on your needs.
Create a new route inside `MoviesController` && a new view `create.html.twig`
`composer require symfony/mime`: required for image path validation

### Symfony input validation
This can be done by adding something like this in the property annotation e.g. `#[Assert\NotBlank]`
Add this:
`use Symfony\Component\Validator\Constraints as Assert`
`composer require symfony/validator doctrine/annotations`
https://symfony.com/doc/current/reference/constraints.html 

### Symfony Authentication
`composer require symfony/security-bundle`
`symfony console make:user <name_of_user_class>`

- Now we need to tell Doctrine to migrate the entities. This can be done via the following command: 
`symfony console make:migration`
`symfony console doctrine:migrations:migrate`

- Creating a registration form
`symfony console make:registration-form`
- Creating login functionality
`symfony console make:auth`


### Restrict pages
This can be done inside the twig template by adding an if && tweaking access control *security.yml*