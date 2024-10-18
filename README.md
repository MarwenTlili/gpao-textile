# GPAO Textile

Mini Projet pour Atelier Conception - Scrum Organisation: Master Pro

## Technologies utilisé:
- BackEnd: Symfony 5.4
- Containerization: Docker Compose
- FrontEnd: Bootstrap 5

## Fonctionnalités:
### Espace Admin
- Création de données de production (clients, ouvriers, machines, îlots ...)
- Lister les ordres de fabrication, validation ou refus
- Validation et changement du catégorie des clients
- Recherche OFs non achevés
- Affectation des ordres de fabrication (nouveau/non achevés) sur des îlots
### Espace Client
- Inscription
- Création des ordres de fabrication (ordinaire/urgent) et leurs Mise à jour
- Lister ces ordres de fabrication (avec état en temps réel)
- Recevoir les notification concernant ces d’ordres (si OF change d’etat)
### Espace Secrétaire
- Saisie quotidienne des productions (Quantité/Qualité) par îlot
- Etat journaliers des reliquants des OF (total Qte produites et reliquats)
- Saisie la présences des employés
- Etats journaliers des abscences
## Requirements:

- php 8.3 
- composer 
- nodejs >= 20
- yarn
- Docker

## Setup:
```bash
> git clone https://github.com/MarwenTlili/gpao-textile.git
> cd gpao-textile
```

```bash
# install yarn dependencies
yarn install

# install composer dependencies
composer install

# run docker containers
docker compose up -d

docker compose exec -it php bash

# create database, if not already created
symfony console doctrine:database:create

# make a new migration files
symfony console make:migration

# execute migrations
symfony console doctrine:migrations:migrate

# load fixtures for test
symfony console doctrine:fixtures:load
```

for test you can use those logins  
client:
email: client1@gmail.com pw: client1

gerant:
email: gerant@gmail.com pw: gerant

secretaire:
email: secretaire@gmail.com pw: secretaire

```bash
# mysql root user 
# see mysql logs to check your own generated root password
> docker logs gpao_textile-database -f
> mysql -u root -p 
Enter password: r3TTtpIZ3MH2iNhQcRp+eJcAkXIzxtRJ
```
