CD src/AppBundle/Entity/
DEL *.php
CD 
CD ..
CD 
CD ..
CD 
CD ..
php bin/console doctrine:cache:clear-metadata 

php bin/console doctrine:cache:clear-query  

php bin/console doctrine:cache:clear-result 

php bin/console doctrine:mapping:import --force AppBundle xml

php bin/console doctrine:generate:entities AppBundle

cscript.exe doctrine.vbs

pause