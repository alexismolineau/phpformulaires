<?php

class User{

    private string $userName = '';
    private string $email = '';
    private string $password = '';

    /**
     * Undocumented function
     *
     * @param string $userName
     * @param string $email
     * @param string $password
     */
    public function __construct(string $userName, string $email, string $password){
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
	public function getPassword() :string
    { 
        return $this->password; 
	} 

    /**
     * Undocumented function
     *
     * @param string $password
     * @return void
     */
	public function setPassword(string $password) 
    {  
		$this->password = password_hash($password, PASSWORD_DEFAULT); 
	} 

    /**
     * Undocumented function
     *
     * @return string
     */
	public function getUserName():string
    { 
        return $this->userName; 
	} 

    /**
     * Undocumented function
     *
     * @param string $userName
     * @return void
     */
	public function setUserName(string $userName) 
    {  
		$this->userName = $userName; 
	} 

    /**
     * Undocumented function
     *
     * @return string
     */
	public function getEmail():string
    { 
        return $this->email; 
	} 

    /**
     * Undocumented function
     *
     * @param string $email
     * @return void
     */
	public function setEmail(string $email) 
    {  
		$this->email = $email; 
	} 
}