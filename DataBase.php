<?php

//classe contenant les méthodes d'accès à la DB
class DataBase{

    /**
     * fonction privée, d'ouverture de connexion à la DB. Uniquement utilisée par la classe
     *
     * @return PDO
     */
    private function connectToDb():PDO
    {
        try{
            $pdo = new PDO(
                'mysql:host=localhost;dbname=tpconnexion;charset=utf8',
                'root',
                'root',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
            return $pdo;
        }
        catch(PDOException $e){
            var_dump($e);
            die;
        }
    }


    /**
     * fonction de gestion de l'inscription d'un client. Vérifie si un email est déjà utilisé
     *
     * @param array $values
     * @return string
     */
    public function inscription(array $values):string
    {
        $isEmailSet = $this->getUserByEmail($values['email']);
        if(!empty($isEmailSet)){
            return 'Cet email est déjà utilisé';
        }

        $pdo = $this->connectToDb();
        $query = $pdo->prepare('INSERT INTO user (username, email, password) VALUES(:username, :email, :password )');
        $query->bindParam(':username', $values['username']);
        $query->bindParam(':email', $values['email']);
        $query->bindParam(':password', $values['cryptedPassword']);
        $query->execute();
        return 'Votre inscription a bien été prise en compte';
    }



    /**
     * fonction pour obtenir un utilisateur avec son email et l'instancier dans un objet User. Retourne null si l'email n'existe pas
     *
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email):?User
    {
        $pdo = $this->connectToDb();
        $query = $pdo->prepare('SELECT * FROM user WHERE email=:email');
        $query->bindParam(':email', $email);
        $query->execute();
        $returnedUser = $query->fetch();
        if($returnedUser){
            $user = new User($returnedUser['username'], $returnedUser['email'], $returnedUser['password']);
        }else {
            $user = null;
        }
        return $user;
    }


    /**
     * fonction pour connecter un utilisateur si son email et password correspondent
     *
     * @param array $values
     * @return User|null
     */
    public function connection(array $values):?User
    {
        $user = $this->getUserByEmail($values['email']);
        if($user && password_verify($values['password'], $user->getPassword())){
            return $user;
        }
        else {
            return null;
        }

    }


}

