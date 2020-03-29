# BlogArt

Projet MMI 2020

## Fonctionnalités

- [x] Page d'accueil avec nos derniers articles
- [x] Menu de navigation
- [x] Systeme de langue
- [x] Liste des articles par thématique
- [x] Page Article
- [x] Systeme de commentaires
- [x] Systeme de likes
- [x] Systeme de compte administateur et utilisateur
- [x] Page de connexion/inscription
- [x] Page de profil pour gerer ces informations (Nom, Prénom, Adresse eumail, Mot de passe, Photo)
- [x] Panel admin avec tous les CRUDs
- [x] Systeme de gesion des utilistaeurs
- [ ] Systeme de redaction libre et intuitif

## Panel Admin

Accessible depuis: `./admin/`

**Identifiant local**

> email: `root@lpb.com`  
> mdp: `root`  

## Structure et règles de la Base de données

La base de données n'a pas été modifié.
Afin de pouvoir intégrer toutes les fonctionnalités, nous avons défini des règles au sein même du code pour pouvoir accéder à toutes les données.

### Pour les utilisteurs

Pour créer un utilisateur, il faut entrer:
- Nom/Prenom
- Adresse email
- Mot de passe

Le Login est géneré en fonction du prenom, de la date de création ainsi que 3 nombres aléatoires supplémentaire.

Afin de différencier un admin d'un membre, on viendra insérer en toute sécurité le caractère '*' devant le Login.
La chaine Login est isolé dans l'objet `User` et est modifiable par l'intermédiaire des méthodes `setAdmin()` et `setLogin()`

### Pour les commentaires

Les commentaires sont associés aux utilisateurs, on viendra, à la place de l'email initialement prévue insérer le Login de l'utilisateur.
On ignorera le champ 'TitrCom' des commentaires.

### Pour les likes

La table 'Like' étant inexistante, on insérera chaque mention like dans la table 'Comment', la colonne 'TitrCom' étant ignoré, on viendra insérer le mot clé 'LIKE' dans ce champ.
Une methode a été créé au sein de l'objet `Comment` pour récuper la liste des commentaires réel.

## Systeme de langues

Les langues sont gérées dans des fichiers json, ils sont modifiables depuis le dossier Lang.

**ATENTION** Lors de la création d'une langue depuis la base de données, pensez à bien créer un fichier json au format '{NumLang}.json' dans le repertoire Lang.
