# boutique_pokemon

# Création du repo en local 
git clone https://github.com/HowelLeMoallic/boutique_pokemon.git

# Ajout du README
echo "# boutique_pokemon" >> README.md

git init : initialise le projet

git add README.md : ajoute le fichier envoyé

git commit -m "first commit" : prépare le colis à envoyé

git push -u origin : envoie le colis sur le repo distant à l'origine de la branche

# Création du projet Symfony

symfony new boutique_pokemon --version="6.2.*" --webapp

Modification du fichier .env

# Création de l'entité + repository Utilisateur

php ./bin/console make:user Utilisateur

# Création de la page de connexion

php ./bin/console make:auth

# Création de la page d'inscription

php bin/console make:registration-form

# Création Mot de passe oublié 

composer require symfonycasts/reset-password-bundle

php bin/console make:reset-password

php ./bin/console make:migration

php ./bin/console doctrine:migrations:migrate

Commenter la ligne 

    "Symfony\Component\Mailer\Messenger\SendEmailMessage: async"

Dans messenger.yaml pour un envoi instantané de l'email.

# Ajout de la fonctionnalité remember me

Dans Security.yaml :

    firewalls:
        main:
            remember_me:
            secret: '%kernel.secret%' # required
            lifetime: 604800 # 1 week in seconds

Puis dans dans le fichier twig login :

    <label>
        <input type="checkbox" name="_remember_me" checked/>
        Keep me logged in
    </label>

# Envoi d'email de vérification

composer require symfonycasts/verify-email-bundle

composer require symfony/google-mailer

Modification du fichier .env :

    ###> symfony/google-mailer ###
    # Gmail SHOULD NOT be used on production, use it in development only.
    MAILER_DSN=gmail://exemple@gmail.com:mdp@default?verify_peer=0
    ###< symfony/google-mailer ###

# Création des entités

Création des entités Article/ Categorie / Commentaire / Retrait

php bin/console make:entity 

# Modification de la BDD

php ./bin/console make:migration

php ./bin/console doctrine:migrations:migrate

# Utilisation des fixtures

composer require --dev orm-fixtures

php bin/console make:fixtures

php bin/console doctrine:fixtures:load

# Utilisation des données fakers

composer require fakerphp/faker