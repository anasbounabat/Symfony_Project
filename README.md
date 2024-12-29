# Projet E-commerce Symfony - Anas & Ilias

Bienvenue sur le projet e-commerce développé par Anas et Ilias dans le cadre de notre formation. Ce projet a pour but de créer une plateforme de commerce en ligne où les utilisateurs peuvent s'inscrire, se connecter, consulter des produits, et gérer leur panier. Bien que nous ayons rencontré plusieurs difficultés pendant le développement, nous avons réussi à implémenter les principales fonctionnalités du back-end et nous avons l'intention de poursuivre le projet pour le finaliser.


### Prérequis

Avant d'installer le projet, vous devez avoir installé les outils suivants :

- [PHP](https://www.php.net/) version 7.4 ou supérieure
- [Composer](https://getcomposer.org/) pour gérer les dépendances
- [Symfony CLI](https://symfony.com/download) (facultatif, mais recommandé pour un développement plus facile)
- [MySQL](https://www.mysql.com/) ou un autre système de gestion de base de données compatible



### Étapes d'installation

1. **Cloner le projet**

    ```bash
    git clone https://github.com/votre-utilisateur/projet-ecommerce-symfony.git
    cd projet-ecommerce-symfony
    ```

2. **Installer les dépendances avec Composer**

    Assurez-vous d'avoir installé **Composer** sur votre machine. Si ce n'est pas le cas, vous pouvez l'installer via [Composer](https://getcomposer.org/).

    ```bash
    composer install
    ```

3. **Configurer la base de données**

    - Ouvrez le fichier `.env` et configurez l'URL de la base de données :

      ```dotenv
      DATABASE_URL="mysql://root:root@127.0.0.1:3306/projet_ecommerce"
      ```

      Remplacez `root:root` par vos informations d'authentification MySQL si nécessaire.

4. **Créer la base de données**

    Exécutez les commandes suivantes pour créer la base de données et appliquer la structure des tables.

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force
    ```

5. **Lancer le serveur Symfony**

    Symfony vient avec un serveur web intégré. Lance-le en exécutant :

    ```bash
    php bin/console server:run
    ```