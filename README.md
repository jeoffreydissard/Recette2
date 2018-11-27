![Evaluation](https://files.meilleurduchef.com/mdc/library2/img/recette/carnet-recettes-fr.jpg)

# Projets évaluation 2

## Application Web "MES RECETTES" de cuisine

#### Conception et réalisation d’un site Web dynamique pour la gestion de recettes de cuisine

#### LE CAHIER DES CHARGES

##### Votre application doit permettre :
1. La gestion d'utilisateurs de 2 types :

        - le simple visiteur, pouvant seulement consulter les diverses recettes
        - l'utilisateur connecté, possédant un compte pour éditer ses recettes
        
2. L’ajout, la modification ou la suppression de recettes par l' utilisateur logué sur son compte.
3. L’interrogation de la base de données pour afficher :    

        - L'ensembles des recettes présentes sur l'applications selon 4 catégories(Entrées, Plats, Desserts, Sauces)
        - L'ensembles des propres recettes de chaque utilisateur connectés
        
* Vous pouvez ajouter des éléments à l'application, si et seulement si :

        - la proposition participe à l'amélioration de l'ergonomie 
        - la proposition permet l'ajout de fonctionnalités intéressantes qui respectent l'esprit d'origine
        - le client(équipe des formateurs) valide cette proposition  

* Vous veillerez à la sécurité concernant la gestion des utilisteurs et la création et soumission des formulaires        

##### Les users stories :

    En tant qu'utilisateur non connecté :
    - je peux accéder à la page d'accueil
    - je peux accéder à la page recettes et voir les catégories de recettes
    - je peux accéder à l'ensemble des recettes pour chaque catégorie
    - je peux m'inscrire 
    - je peux me connecter

    
    En tant qu'utilisateur connecté :
    - je peux accéder à la page d'accueil
    - je peux accéder à la page recettes et voir les catégories de recettes
    - je peux accéder à l'ensemble des recettes pour chaque catégorie 
    - je peux accéder à un espace personnel contenant la listes de toutes mes recettes 
    - je peux créer mes propres recettes et indiquer la catégorie
    - je peux modifier mes propres recettes 
    - je peux supprimer mes propres recettes 
    - je peux me déconnecter

##### Données de l'application

    Utilisateur :
    - identifiant (nom/pseudo)
    - adresse mail
    - mot de passe
    
    Recette détail :
    - Photo de la recette
    - Nom de la recette
    - Catégorie de la recette (entrée, plats, sauces ou dessert)
    - Temps de préparation
    - Ingrédients(sous forme de liste)
    - Nombre de personnes (pour laquelle la recette est prévue)
    - préparation(les étapes de la recette, sous forme de liste)
    
    Recettes sous forme de liste(sur la page recettes, dans les catégories) :
    - Photo de la recette
    - Nom de la recette 
    - Nom de l'auteur de la recette
    
Pour les relations :    
* Un utilisateur peut être l'auteur de plusieurs recettes
* Une recette ne possède qu'un seul auteur
 

##### Charte graphique :
* Nous souhaitons **une application sobre et conviviale**, vous pouvez vous appuyer sur les maquettes partielles, fournies
 par l'agence de communication [La Crème French](http://www.lacremefrench.com/notre-vision/construire/),
  afin de saisir l'esprit souhaité par le **client**. Vous pouvez également proposer vos propres interfaces, en utilisant impérativement les couleurs suivantes :
  
        le blanc de façon majoritaire sur l'application
        le jaune (#FFB03B) pour les éléments décoratifs et les titres
        le noir(#333333) pour les textes et les titres

* Vous trouverez toutes les ressources graphique dans le dossiers **ressources**
* vous pouvez agrémenter l'interface avec vos propres **icones**, toujours en respectant la charte graphique.
        
##### Plannification : Délais de livraison et revues client
* La date de livraison de l'application est prévue le vendredi matin 9h00
* les revues avec le client seront programmées comme suit :

        - mardi 11h30
        - mardi 16h00
        - mercredi 11h30
        - mercredi 16h00
        - jeudi 11h00
        - jeudi 16h00
        

##### Gestion du projet
* Vous travaillerez en binômes (la liste des binômes se trouve dans le **readme2.md**)
* Vous devez collaborer pour les différentes phases du projet (gestion du temps, répartition des tâches, conception, modélisations) 
  en créant un **Trello**, un **figma** (ou autre), dont vous communiquerez **les liens au client**, afin qu'il puisse y prendre part.
* Vous devez collaborer pour la conception du code de l'application en "versionnant" avec **Git**, votre projet au travers d'un dépôt **Github** ou **Gitlab**
  vous communiquerez également **le lien au client**. 
  
#### Rappel
* Vous pouvez utiliser des **frameworks CSS, JS et PHP.**
* Pensez à **commenter** votre code,à le rendre **lisible** (indentation, organisation MVC, refactorisation)
* Pensez à mettre les attributs nécessaires à **l'accessibilité, la compatibilité, l'adaptabilité** dans votre structure **HTML**



#### Bonnus : 
 - mettre en place un système de **pagination** pour lister les recettes avec une **limite de 5 recettes par page** 
 - Créer un système de **votes** sur les recettes et permettre  seulement aux **utilisateurs connectés** de voter
