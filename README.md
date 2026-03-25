# symfony-ddb-stack

## Présentation
Socle technique pour des projets Symfony dockerisés sur ddb.
Aucun projet Symfony n'est installé, il s'agit d'un projet vierge pour démarrer rapidement un projet Symfony dockerisé.

## Socle technique
* PHP 8.2
* Symfony 7.4
* MariaDB 10.4
* DDB (for Docker Devbox : https://inetum-orleans.github.io/docker-devbox-ddb/)

## Installation et utilisation
> **Pré-requis :**
> *  Environnement Linux (ou WSL2 sur Windows)
> *  DDB installé

### Initialiser le socle technique

Lancer la command `ddb configure` pour configurer le projet DDB et créer tous les fichiers de configuration nécessaires (Docker files, etc)

```
ddb configure
```

Lancer la command `make init` pour : 
* Build les conteneurs Docker
* Lancer les conteneurs Docker
* 
```
make init
```

### Lancer/utiliser le projet
Le projet (vide pour l'instant) est accessible à l'adresse https://sf7-start.test

Utiliser la command `make create-project` pour créer un projet Symfony dans le dossier `web` :

```
make create-project
```