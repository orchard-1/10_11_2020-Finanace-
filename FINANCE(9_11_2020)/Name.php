<?php

/**
    * Name : getName
    * Purpose : To get a Valid name
    * Input : void
    * Returns : name if it is valid
*/
#validating Customer name
function getName()
{
    $count=0;
    # iterating untill name entered is Valid
    do
    {
        if($count==0)
        {
            $name=readline("Enter Customer name :");
            $count++;
        }
        else
        {
            $name=readline("Enter A Valid Customer name :"); 
        }

    }while(!preg_match('/[a-zA-Z]$/i', $name)); # using regex to validate name
    
    return $name;
}

?>