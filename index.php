<?php

echo '<body style="text-align: center">';
echo '<h1>Magnifique page d\'accueil</h1>';

//autoload classes
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

//debut de la session pour utiliser les variables $_SESSION
session_start();

//si le cookie contenant le nom d'utilisateur existe, on affiche son nom puis on interrompt le script
if(isset($_COOKIE['username'])){
    echo '<p>Bienvenue, vous êtes connecté en tant que : ' . $_COOKIE['username'] . '</p>';
    echo '<a href="deconnexion.php">Déconnexion</a>';
    die;
}

//instanciation de l'objet Database afin d'appeler ses fonctions
$repository = new DataBase();

//creation d'un id unique avec la fonction uniqid() et attribution de cet id dans une session
$_SESSION['sessionId'] = uniqid('sessionId');


//formulaire d'inscription. Faites pas le sytle pareil ou Benoist va vous tuer
echo '
<h2>Inscrivez-vous</h2>
<form action="inscription.php" method="get" style="display:flex; flex-direction:column; max-width: 1200px; margin: auto;">
    <label for="name">Votre nom d\'utilisateur</label>
    <input type="text" name="name" id="name" required/>
    <label for="email">Votre adresse email</label>
    <input type="email" name="email" id="email" required/>
    <label for="plainPassword">Choisissez un mot de passe</label>
    <input type="password" name="plainPassword" id="plainPassword" required/>
    <input type="submit" value="Inscription"/>
    <input type="hidden" name="sessionId" value="' . $_SESSION['sessionId'] . '">
</form>
';


//formulaire de connexion
echo '
<h2>Connectez-vous</h2>
<form action="connexion.php" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required/>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required/>
    <input type="submit" value="Connexion"/>
    <input type="hidden" name="sessionId" value="' . $_SESSION['sessionId'] . '">
</form>
';






echo '</body>';

