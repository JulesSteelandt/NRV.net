# README - nrv.net

## Présentation

nrv.net est un site permettant de réserver des billets pour différents événements, notamment des spectacles. Ce dépôt contient des instructions pour installer le projet localement et configurer les composants requis.

## Installation

1. Clonez le dépôt sur votre machine locale :

```bash
git clone https://github.com/votre-nom-utilisateur/nrv.net.git
cd nrv.net
```

2. Installez les dépendances du projet en utilisant Composer. Exécutez les commandes suivantes dans les répertoires respectifs :

```bash
cd api/auth.nrv
composer install
```
```bash
cd ../catalogue.nrv
composer install
```
```bash
cd ../gateway.nrv
composer install
```
3. Utilisez Docker Compose pour démarrer les composants nécessaires. Exécutez la commande suivante à la racine du projet :

```bash
cd ../../nrv.components
docker compose up -d
```
Cette commande démarrera les services requis en mode détaché.

4. Installez la base de données en utilisant les détails de connexion suivants :

```
Hôte : localhost
Port : 32103
Nom d'utilisateur : nrv
Mot de passe : nrv
Les noms de base de données pour les composants respectifs sont :

nrv.catalogue.db : Utilisé par /api/catalogue.nrv
nrv.auth.db : Utilisé par /api/auth.nrv
```
Importez les fichiers SQL pour les bases de données situés dans les répertoires suivants :
```
/api/catalogue.nrv/sql
/api/auth.nrv/sql
```
5. Utilisation
Avec l'installation et la configuration de la base de données terminées, vous pouvez maintenant exécuter et accéder à l'application localhost:32108 sur votre environnement local, et localhost:32107 pour l'API
