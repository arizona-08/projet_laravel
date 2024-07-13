## avec wsl 
composer install dans le powershell
#
./vendor/bin/sail up -d dans le wsl
#
./vendor/bin/sail artisan migrate:fresh --seed
#
php artisan key:generate
#
./vendor/bin/sail npm install
#
./vendor/bin/sail npm run dev
#
aller sur localhost:80
#
login -> email: admin.test@test.com / mdp: Respons11

## library utilise

https://github.com/pelmered/fake-car

## pour les test
Tout les users ont le mot de pass: Respons11

Admin: admin.test@test.com
RH: rh.test@test.com
Chef d'agence: chefagence.test@test.com
Gestionnaire fournisseur: gesf.test@test.com
Gestionnaire commandes: gesc.test@test.com
Locataire: gesc.test@test.com

## Roles middleware
Regarder config/roles.php pour voir les roles disponibles 
(les vrais noms de roles sont consultables dans database/seeders/DatabaseSeeder.php ou directement en base de données)