<?php

//on détruit le cookie en lui attribuant la valeur null
setcookie('username', null, -1);

echo 'Vous êtes à présent déconnecté. A très vite !';

//redirection vers la page d'accueil après 5 secondes
header("refresh:5;url=./");
echo '<p>Redirection vers la page d\'accueil dans 5 secondes...';

