<?php

# class for Admin
class Admin extends BajajFinance implements LoginSystem
{
    # function for Admin login
    /** 
        * Name: login
        * purpose : To validate the admin credentials
        * Input :  void
        * returns : (bool) True if credentials are valid /
        *           false if credentials are Incorrect
    */

    public function login()
    {
        $mail = getEmail();

        # checking the existance of admin mail in admins array
        if(array_key_exists($mail,parent::$admins))
        {
            $pass = readline("Enter admin password :");

            # Comparing the Entered password with actual password
            if(parent::$admins[$mail]["password"]==$pass)
            {
                echo "login successful,".parent::$admins[$mail]["name"]."\n";
                return true;
            }
            else
            {
                echo "Incorrect Password";
            }

        }
        else
        {
            echo "Admin does not exists";
        }
        
        return false;
    }

    # function to add a new loan
    /**
     * Name : addLoan
     * Purpose : To add a new loan to the loans array
     * Input :  void
     * Returns : void
    */ 

    public function addLoan()
    {
        # acquiring loan details from the console
        $loanName = readline("Enter loan name :");
        $amount = numeric("Enter amount :");
        $duration = numeric("Enter duration of the loan in months : ");
        $intrest = numeric("Enter Intrest : ");
        $minSal = numeric("Monthly income to eligible for loan : ");

        # adding loan details to the loans array in BajajFinance
        parent::$loans[$loanName]["amount"] = $amount;
        parent::$loans[$loanName]["duration"] = $duration;
        parent::$loans[$loanName]["intrest"] = $intrest;
        parent::$loans[$loanName]["minSal"] = $minSal;
        $emi = $this->emiCalculator($amount, $intrest, $duration);
        parent::$loans[$loanName]["emi"] = $emi;

    }

    # function to display details of the customer
    /**
     * Name : getCustDetails
     * Purpose : To print the customer details 
     * Input :  void
     * Returns : void
    */
    public function getCustDetails()
    {
        # reading mobile number from console and validating
        $custMob =getMobile();

        # checking for the existence of customer Mobile in the customers array
        if(array_key_exists($custMob,parent::$customers))
        {
            # printing all the customer details   
            $customer=parent::$customers[$custMob];
            echo "============ CUSTOMER DETAILS ============\n";
            echo "Name : ".$customer->getName()."\n";
            echo "Age : ".$customer->getAge()."\n";
            echo "Mobile :".$customer->getMobile()."\n";
            echo "Address :".$customer->getAddress()."\n"; 
            echo "password :".$customer->getPassword()."\n"; 
                    
            # printing loans of customer
            echo "=========== LOANS ================\n";

            # iterating through all the loans of the customer
            foreach($customer->custLoans as $key=>$value)
            {
                foreach($value as $subkey=>$subvalue)
                {
                    echo $subkey." : ".$subvalue."\n";
                }
                echo "\n=================================\n";
            }
        }
        else
        {
            echo "customer does not exists\n";
        }

    }
    
    
    # function to dispaly all the available loans
    /**
     * Name : checkLoans
     * Purpose : To print all the loans offered 
     * Input :  void
     * Returns : void
    */
    public function checkLoans()
    {
        echo "============ Loans available ==================\n";

        # iterating through all the loans 
        foreach (parent::$loans as $loanName => $value)
        {
            echo "Loan name:" . $loanName . "\n";
            echo "Loan Amount :" . $value["amount"] . "\n";
            echo "INTREST RATE :" . $value["intrest"] . "%\n";
            echo "DURATION :" . $value["duration"] . " months\n";
            echo "MINIMUM SALARY : " . $value["minSal"] . "\n";
            echo "EMI :" . $value["emi"] . "\n";
            echo "\n=================================\n";
        }
    }

    /**
     * Name : addCustomer
     * Purpose : To add a customer to customers array 
     * Input :  void
     * Returns : void
    */
    
    # function to add customer to customer array
    public function addCustomer()
    {
        # obtaining the details of the customer
        $mobile = getMobile();
        $name = getName();
        $age=numeric("Enter Age :");
        $password = readline("password : ");
        $address = readline("Address : ");
        $salary = numeric("salary : ");

        # creating a customer object with the entered details
        $custObj = new Customer($name,$age,$mobile,$address,$salary,$password);
        
        # adding customer object to the customers array
        parent::$customers[$mobile] = $custObj;
        echo "Successfully Added customer : ".$name."\n";
        
    }

    /**
     * Name : emiCalculator
     * Purpose : To caluculate the EMI 
     * Input :  amount,intrest,months
     * Returns : emi
    */
    function emiCalculator($amount, $intrest, $months)
    {
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

        # iterate until months is > 0
        while($months <=0)
        {
            $intrest = readline("Months should be > 0 : ");
        }        

        # intrest per month
        $intrest = $intrest / (12 * 100);
    
        /**  Mathematical formula to calculate EMI
          
         *  EMI = [P x R x (1+R)^N]/[(1+R)^ (N-1)],
         *  In this formula the variables stand for:
         *  EMI – the equated monthly installment
         *  P – the principal or the amount that is borrowed as a loan
         *  R – the rate of interest that is levied on the loan amount (the interest rate should be a monthly rate)
         *  N – the tenure of repayment of the loan or the number of monthly installments that you will pay (tenure should be in months)
        
         */

        # logic for calculating emi
        $emi = ($amount * $intrest * pow(1 + $intrest, $months)) / (pow(1 + $intrest, $months) - 1);
            
        # rounding the EMI value
        return ceil($emi);
    }

}

?>
