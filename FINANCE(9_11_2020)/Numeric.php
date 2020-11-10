<?php

/**
 * Name : numeric
 * Purpose : To return the value only if it is numeric
 * Input : message to be displayed on console
 * Returns : returns a number 
 */
function numeric($msg="Enter a number : ")
{
    $cnt=0;
    do
    {
        if($cnt==0){
            $num= readline($msg);
            $cnt++;
        }
        else
        {
            $num= readline("Enter a numeric value :");
        }
   
    }while(!is_numeric($num)); # loop till the entered value is numeric

    return (int)$num;
}

?>