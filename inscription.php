<?php

//autoloading des classes utilisées
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

//début de la session
session_start();

echo '<a href="./">Retour à la page d\'accueil</a>';

//instanciation des classes Utils et DataBase
$utils = new Utils();
$repository = new DataBase();

//verification des variables normalement transmises par le formulaire d'inscription et controle des inputs
if(
    isset($_GET['name']) &&
    isset($_GET['email']) &&
    isset($_GET['plainPassword']) &&
    isset($_GET['sessionId']) &&
    $_GET['sessionId'] === $_SESSION['sessionId']
){
    $userName = $utils->checkInput($_GET['name']);
    $email = $utils->checkInput($_GET['email']);
    $password = $utils->checkInput($_GET['plainPassword']);
    $sessionId = $utils->checkInput($_GET['sessionId']);
}
else{
    echo '<h1>You dirty hacker</h1>';
    die;
}

//appel de la fonction inscription de l'objet DataBase en lui passant les valeurs du formulaire
$retour = $repository->inscription([
    'username' => $userName,
    'email' => $email,
    'cryptedPassword' => password_hash($password, PASSWORD_DEFAULT),
]);


//redirection automatique après 5 secondes
header("refresh:5;url=./");
echo $retour;
echo '<p>Redirection vers la page d\'accueil dans 5 secondes...';
