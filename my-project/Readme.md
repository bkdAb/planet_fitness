# Planet Fitness test
With this app you will be able to manage users and log into database users actions. <br />
These are the steps to follow to run this project:

1. Install PHP packages `composer install`
2. Install both the PHP and JavaScript dependencies `npm install`
3. Compile assetes `npm run dev` 
4. Create and start containers  `docker-compose up -d`
5. List running containers `docker ps`
6. Execute `docker exec -it #my-project_myapp_container_id bash`
7. Create and update databases `php bin/console d:d:c` `php bin/console --env=test d:d:c` `php bin/console d:s:u -f` `php bin/console --env=test d:s:u -f` <br/>
8. Populate database `php bin/console d:f:l`
9. Run tests `php bin/phpunit`
