<?php

/**
    * Name : getEmail 
    * Purpose : To validate entered email  
    * Input : void
    * Returns : email if email entered is valid
*/
function getEmail(){
    $count=0;
    do
    {
        if($count==0)
        {
            $email=readline("Enter email ");
            $count++;
        }
        else
        {
              $email=readline("Enter a valid email ");
        }
        
    }while (!filter_var($email, FILTER_VALIDATE_EMAIL));
       
    
    return $email;
    
}

?>