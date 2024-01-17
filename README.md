# Base de projet Symfony 7 

## Stack technique
- Symfony 7.0
- PHP 8.3
- MariaDB 10
- Nginx (peut importe la version mdr)

## Documentation / Lien
- Symfony : https://symfony.com/doc/current/index.html
- Installation de docker : https://docs.docker.com/get-docker/

## Installation
### Prérequis
Avoir docker et docker-compose d'installé sur sa machine

### Création du fichier .env
Le plus simple est de dupliquer le fichier .env.example et de le renommer en .env, et eventuellement de modifier les variables d'environnement si besoin
```bash
cp .env.example .env
```

### Build de l'image PHP
```bash
docker compose build
```

### Installation des dépendances
```bash
docker compose run --rm php composer install
docker compose run --rm vite npm install
```

## Demarrage du serveur de dev local
```bash
docker compose up
```

## Lancer des commandes symfony
Le bundle maker est installer dans le projet. Il permet de générer des fichiers de configuration, des entités, des controllers, etc...

Commande pour voir la liste des make disponible
```bash
docker compose run --rm php bin/console make
```


