# Dockerize Everything

**Sujet choisi : API REST**

L’objectif de ce projet est d’industrialiser l’application de votre choix. Industrialiser une application signifie que vous devez installer, paramétrer et optimiser des outils afin qu’une équipe de développement de toute taille puisse installer, développer et déployer l’application le plus facilement et le plus rapidement possible.


## Versioning

### Workflow utilisé : Feature Branch

* On a choisi d'utiliser ce workflow car ce projet est de **taille moyenne** et nous sommes trois développeurs avec le **même niveau** d'expérience en versioning.

### Convention

#### Commit
* Verbe d'action + petite description du commit
> Exemple : Add delete request

#### Branch
* Feature + Nom de la feature
> Exemple : feature-api


## Contribuer

La partie Docker comporte deux conteneurs, le premier est créé à partir d'un Dockerfile et le second à partir d'une image. 
On a créé un volume pour la base de données permettant de lancer le script sql de création de base au démarrage du conteneur.

### Images utilisées
* php:8.1-apache
* mysql:8.0

### Ports utilisés
Redirection du port 80 sur le port 8100 pour php ainsi que redirection du port 3306 sur la 9906 pour mysql.

> On a aussi décidé de créé un Dockerfile pour mettre en place notre API à l'aide d'une commande permettant de copier notre dossier src sur le conteneur et de lemettre en tant que répertoire source. C'est aussi à partir du Dockerfile qu'on peut installer des extensions telles que pdo et pdo_mysql.


## Déploiement

Pour lancer le docker, utilisez la commande `docker-compose up -d`.
Pour lancer le docker, utilisez la commande :
