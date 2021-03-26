<?php

class Utils {

    /**
     * fonction de vérification des inputs utilisateurs
     *
     * @param string $input
     * @return string
     */
    public function checkInput(string $input):string
    {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripslashes($input);
        return $input;
    }
}