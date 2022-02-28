# Symfony Individual Project
Maëva Mezzasalma

DMII1 2021-2022

## Installation :
    git clone https://github.com/mezzasam/symfony-events-project.git

    npm install
    composer install

Générer des utilisateurs et des évènements :

    php bin/console doctrine:fixtures:load

Vous êtes prêt à lancer le projet à l'aide de :

    symfony server:start
    yarn watch

Events est consultable à l'adresse : http://localhost:8000/

## Description du projet :
Ce projet permet à un collectif de renseigner ses évènements auprès d'internautes.
Leurs adhérents peuvent s'inscrire sur les évènements en question mais il faut au préalable avoir un compte.
(Normalement) A chaque création d'évènement, un mail automatique est envoyé à tous les adhérents.
