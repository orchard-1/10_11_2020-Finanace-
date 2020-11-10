<?php

#creating a class for BajajFinance
class BajajFinance{
    public const COMPANY="BAJAJ FINANCE";
    protected  $address="Pune, Maharashtra, India";
    protected  $about ="this is bajaj";
    protected static $admins=array("1@gmail.com"=>array("name"=>"chinmaya","password"=>"1234"));
    protected static $customers=array();
    protected static $loans=array();
        
        
    # varaiable to hold the object/instance
    private static $instance;

    /**
     * Name : createObject
     * Purpose : To create a singleton object for BajajFinance 
     * Input :  void
     * Returns : instance : BajajFinance
    */
    # function to create object (singleton) of BajajFinance 
    public static function createObject()
    {
        # check wether object is created earlier
        if(!isset(self::$instance))
        {
            # if object is not created previously create a object
            self::$instance = new BajajFinance();
        }
        # return the existing object 
        return self::$instance;
    }

    /**
     * Name : rootLogin
     * Purpose : To validate credentials of root user 
     * Input :  void
     * Returns : (bool) true if credentials are valid, else returns false
    */
    # function for root login
    public function rootLogin()
    {
        $rootPassword=readline("Enter root password : ");

        # checking root  password with default root password
        if($rootPassword==1234)
        {
            echo "login successful , root.\n ";
            return true;
        }
        else
        {
            echo "Invalid root password\n";
        }
        return false;
    }

    /**
     * Name : addAdmin
     * Purpose : To add a new Admin to the Admins array 
     * Input :  void
     * Returns : void
    */
    # function to add admin 
    public function addAdmin()
    {
        $email=getEmail();
        $name=readline("Enter admin name :");
        $pass=readline("Enter Admin password :");
        self::$admins[$email]["name"]=$name;
        self::$admins[$email]["password"]=$pass;
        echo "sucessfully added the admin  $name\n";
    }

    /**
     * Name : updateAddress
     * Purpose : To update the address of the company 
     * Input :  void
     * Returns : void
    */    
    # function to update the address of the company
    public function updateAddress()
    {
        $this->address=readline("Enter new Address : ");
        echo "The updated address is : ".$this->address."\n";
    }

    /**
     * Name : updateAbout
     * Purpose : To update the information of the company 
     * Input :  void
     * Returns : void
    */     
    # function to update the informatiom about the company
    public function updateAbout()
    {
        $this->about=readline("Enter new about : ");
        echo "The updated about is : ".$this->about."\n";
    }
        

}


?>