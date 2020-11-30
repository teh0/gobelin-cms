# Installation
1. Lancer la commande `bash run.sh` et suivre les instructions dans le terminal. Ce script va exécuter les instructions
ci-dessous : 
- Lancer `composer i`
- Lancer `npm i`
- Créer un fichier data.db dans le dossier `./var` du projet.
- Lancer `bash create-schema.bash`
- Lancer `bash load-fixture`
- Lancer `npm run build`
- Lancer `php -S localhost:1234 -t public`

Si un problème se produit pendant l'execution de ce script, ne pas hésiter à lancer manuellement les commandes.

2. Se connecter à l'adresse `localhost:1234` pour accéder au site.

# Infos utiles
Connexion en tant qu'admin :
- Mail: `user1@mail.com`
- Mot de passe: `secretsecret`

# Fonctionnalités du site
* [x] Système d'autentification avec des rôles (non auth | auth non vérifié | auth vérifié | admin)
* [x] Backoffice admin pour gérer le contenu du site web. Manager pour chaque entité de l'application avec possibilité
de lire, modifier créer et supprimer.
* [x] Refacto du système de routing de l'application en séparation de plusieurs fichiers relatif à une partie spécifique
de l'application. (adaptation du Kernel).
* [x] Création d'un ExceptionHandler perso pour gérer les exceptions et les redirections en cas d'erreurs.
* [x] Création d'un event subscriber pour redistribuer les exceptions du site à l'ExceptionHandler.
* [x] Intégration du bundle ckeditor pour générer un editeur WYSIWYG dans la partie manager admin.
* [x] Intégration du bundle vich uploader pour gérer l'upload de fichier.
* [x] Intégration d'une librairie JS pour améliorer l'affichage des selects multiples des formulaires de managers admin.
* [x] Création de fixtures pour peupler la BDD rapidement.
* [x] Création de service pour les fixtures et les repositories. Injection de dépendances via les interfaces.
* [x] Utilisation de webpack Encore pour la compilation des assets front
* [x] Mise en place d'une architecture de layout twig pour la partie publique et admin du site.
* [x] Mise en place d'une pagination pour toutes nos listes d'entités dans les dashboards admin et sur la partie publique.
* [x] Créations d'entités Doctrine (prise en charge des relations entre elles).
* [x] Créations de formulaires imbriqués pour chaque entité créée.
* [x] Création d'une searchbar par champs spécifique assez scalable qui peut se coupler n'importe qu'elle entité.

# Mot de la fin
- Nous avons essayé de soigner au mieux le code et de respecter les bonnes pratiques de codes (nommages factorisations ...).
- Un peu frustré de ne pas avoir pu faire plus de features que nous nous sommes fixées (pas mal de travail pendant les semaines d'entreprises).
- On a découvert bcp de nouvelles choses qui nous serviront pour la suite ! C'était top merci.