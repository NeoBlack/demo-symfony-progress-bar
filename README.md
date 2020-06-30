# Demo Progress Bar with AJAX and Symfony
This symfony demo application contains two progress bars, HTML5 native progress bar and a bootstrap framework version.

Both resolve the same data from the symfony demo controller (`App\Controller\ProgressBarController`).

## Installation
1) clone this repository
   
   `git clone https://github.com/NeoBlack/demo-symfony-progress-bar.git`   

2) composer install

   `composer install`
   
3) Setup your database

   Set your database credentials in your `.env.local` file, set `DATABASE_URL`
   
   Then run: `bin/console doctrine:database:create` (if your database not exists)
   
   Then run: `bin/console doctrine:migrations:migrate` (to create the database schema)
   
   Then run: `bin/console demo:reset-database` (to create or reset the demo data)
   
4) open your browser ;)
