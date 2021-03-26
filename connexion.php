<?php

//autoloading des classes
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

//début de la session pour utiliser les variables de $_SESSION
session_start();

//instanciation des objets
$utils = new Utils();
$repository = new DataBase();


//vérification des inputs utilisateurs sur le formulaire de connexion
if(
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['sessionId']) &&
    $_POST['sessionId'] === $_SESSION['sessionId']
){
    $email = $utils->checkInput($_POST['email']);
    $password = $utils->checkInput($_POST['password']);
    $sessionId = $utils->checkInput($_POST['sessionId']);
}
else {
    echo '<h1>You dirty hacker</h1>';
    die;
}

//utilisation de la méthode de connection de l'objet DataBase
$user = $repository->connection([
    'email' => $email,
    'password' => $password
]);

//affichage d'un message d'erreur si le nom d'utilisateur et/ou le mdp ne sont pas trouvés en bdd
if(!$user){
    echo '<h1>Nom de compte ou mot de passe invalide</h1>';
    die;
}

//si la variable $user n'est pas nulle, on set le cookie 'username' avec le nom de l'utilisateur
setcookie('username', $user->getUserName());




echo '<a href="./">Retour à la page d\'accueil</a>';

echo '<p>Bienvenue ' . $user->getUserName() . ' !</p>';
echo '<p>Redirection vers la page d\'accueil dans 5 secondes...';

//redirection au bout de 5 secondes
header("refresh:5;url=./");
