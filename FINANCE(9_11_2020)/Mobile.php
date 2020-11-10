 <?php

 /**
    * Name : getMobile
    * Purpose : to validate the mobile number 
    * Input : void
    * Returns : mobile number if it is valid
*/
#validate mobile
function getMobile()
{
    $count=0;
    # iterating till user inputs a valid mobile number
    do
    {
        if($count==0){
            $mobile=readline("\nEnter Mobile number : ");
            $count++;
        }
        else
        {
            $mobile=readline("\nEnter A valid Mobile number : ");
        }

    }while(!preg_match('/[6-9][0-9]{9}/', $mobile)); # using the regex to validate mobile
    
    return $mobile;
}

?>