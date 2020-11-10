<?php 

namespace calc
{
    /**
     * Name : emiCalculator
     * Purpose : To calculate monthly EMI 
     * Input : pricipal amount,intrest,number of months
     * Returns : emi
    */    
    function emiCalculator($amount, $intrest, $months) 
    { 
        $emi; 

        # iterate until amount is > 0 
        while($amount <=0)
        {
            $amount = readline("principal amount should be > 0 : ");
        }
        
        # iterate until intrest is > 0
        while($intrest <=0)
        {
            $intrest = readline("Intresrt should be > 0 : ");
        }

        # exception for divide by zero exception
        try
        {
            if($months<1)
            {
                # throwing the exception
                throw new Exception("MONTHS SHOULD BE >=1 ");
            }
        }
        # catching the exception thrown 
        catch(Exception $e)
        {
            echo $e->getMessage();
            $months=readline("\nEnter months:");
        }

        # calculating monthly intrest
        $intrest = $intrest /  (12*100);

        /* Mathematical formula to calculate EMI
            EMI = [P x R x (1+R)^N]/[(1+R)^ (N-1)],
                
            In this formula the variables stand for:

            EMI – the equated monthly installment
            P – the principal or the amount that is borrowed as a loan
            R – the rate of interest that is levied on the loan amount (the interest rate should be a monthly rate)
            N – the tenure of repayment of the loan or the number of monthly installments that you will pay (tenure should be in months)
        */

        # logic for calculating emi
        $emi = ($amount * $intrest * pow(1 + $intrest, $months)) /  (pow(1 + $intrest, $months) - 1); 
        
        # rounding the emi value
        return ceil($emi); 
    }
}

?>