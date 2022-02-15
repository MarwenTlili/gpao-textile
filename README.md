# issatex
*Mini Projet pour Atelier Conception - Scrum*
Organisation: ISET Sousse, Master Pro GLDRA3 A2

## Technologies utilisé:
  - BackEnd: Symfony 5.3
  - Containerization: Docker/Docker-Compose
  - FrontEnd: Bootstrap 5.1

## Fonctionnalités:
- gestion des ilots
- gestion des Ordres de Fabrication habituelle/urgent
- planification des Ordres de Fabrication
- traitement des Quantité/Qualité journalièrement des articles
- calcul du rendement journalier/hebdomadaire/mensuel/annuel de chaque ilot
- gestion du stock des articles(tisu, fourniture, produit finis)
- système de notification envoyer au client/donneur d’ordre (si OF change d’etat)

## Requirements:
php 7.4
composer
nodejs, yarn/npm
docker

## Setup:
 - git clone https://github.com/MarwenTlili/issatex_docker.git
 - cd issatex_docker/issatex

yarn install
composer install

symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migrations:migrate

symfony console doctrine:fixtures:load

docker-compose up -d

**for test**
client:
	email: client1@gmail.com
	pw: client1

gerant:
	email: gerant@gmail.com
	pw: gerant

secretaire:
	email: secretaire@gmail.com
	pw: secretaire