composer install
npm install
./node_modules/.bin/encore dev
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load