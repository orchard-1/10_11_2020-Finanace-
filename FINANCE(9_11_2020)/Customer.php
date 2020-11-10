<?php

/**
 * class : Customer
 * extends : BajajFinance
 * implements : LoginSystem
 */
class Customer extends BajajFinance implements LoginSystem
{
    # variables to store customer details
    private $custName;
    private $custAge;
    private $custMob;
    private $custAddr;
    private $custSal;
    private $custPass;
    public  $custLoans=array();    
    
    /**
     * Name : __construct 
     * Purpose : To create object of the customer class
     * Input : customerName,customerAge,customerMobile,customerAddress,customerSalary,customerPassword
     * Returns : customer object
    */
    # constructor for Customer to create Object
    public function __construct($custName="",$custAge=0,$custMob=0,$custAddr="",$custSal=0,$custPass=0)
    {
        # setting the values to the customer object
        $this->custName = $custName;
        $this->custAge = $custAge;
        $this->custMob = $custMob;
        $this->custAddr = $custAddr;
        $this->custPass = $custPass;
        $this->custSal = $custSal;
        return $this;
    }

    /**
     * Name : getName 
     * Purpose : To retrive customer Name 
     * Input : void
     * Returns : customer Name
    */
    public function getName()
    {
        return $this->custName;
    }

    /**
     * Name : setName 
     * Purpose : To set customer Name 
     * Input : customer Name
     * Returns : void
    */
    public function setName($custName)
    {
        $this->custName = $custName;

    }

 
    public function getAge()
    {
        return $this->custAge;
    }


    public function setAge($custAge)
    {
        $this->custAge = $custAge;

        return $this;
    }


    public function getMobile()
    {
        return $this->custMob;
    }

 
    public function setMobile($custMob)
    {
        $this->custMob = $custMob;

    }

 
    public function getAddress()
    {
        return $this->custAddr;
    }


    public function setAddress($custAddr)
    {
        $this->custAddr=$custAddr;

    }
 
    public function getPassword()
    {
        return $this->custPass;
    }


    public function setPassword($custPass)
    {
        $this->custPass = $custPass;

        return $this;
    }
 

    public function getSal()
    {
        return $this->custSal;
    }

 
    public function setSal($custSal)
    {
        $this->custSal = $custSal;

        return $this;
    }

    /**
     * Name : checkLoans
     * Purpose : To print all the loans offered
     * Input : void
     * Returns : void
    */    
    public function checkLoans()
    {
        echo "============ Loans available ==================\n";
        # iterating through all the loans
        foreach(parent::$loans as $loanName=>$value)
        {
            echo "Loan name:".$loanName."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "DURATION :".$value["duration"]."months\n";
            echo "minSal".$value["minSal"]."\n";
            echo "EMI :".$value["emi"]."\n";
            echo "\n=================================\n";
        }
    }

    /**
     * Name : getDetails
     * Purpose : To print all the details of a customer
     * Input : void
     * Returns : void
    */
    public function getDetails()
    {
        echo "========== Details ============\n";
        echo "Name : ".$this->getName()."\n";
        echo "Age : ".$this->getAge()."\n";
        echo "Mobile :".$this->getMobile()."\n";
        echo "Address :".$this->getAddress()."\n";
        echo "============ LOANS ==============\n";

        # iterating through all the loans of customer
        foreach($this->custLoans as $loanName=>$value)
        {
            echo "Loan name:".$loanName."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "PENDING INSTALLMENTS :".$value["duration"]."months\n";
             echo "MINIMUM SALARY : ".$value["minSal"]."\n";
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due"]."\n";
            echo "\n=================================\n";
        }

    }

    /**
     * Name : payLoan
     * Purpose : To clear the total due of the Loan 
     * Input : void
     * Returns : void 
    */    
    public function payLoan()
    {
           
        echo "============ Loans to Pay ==================\n";
        # iterating through all the loans of customer
        foreach($this->custLoans as $key=>$value)
        {
            echo "Loan name:".$key."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "DURATION :".$value["duration"]."months\n";
            echo "minSal".$value["minSal"];
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due"]."\n";
            echo "\n=================================\n";
        }
        $loanName=readline("Enter the loan name you want to repay :");

        # checking for the existence of loan entered in customer loans
        if(array_key_exists($loanName,$this->custLoans))
        {
            # clearing the loan
            $this->custLoans[$loanName]["due"]=0;
            $this->custLoans[$loanName]["duration"]=0;
            echo "succesfully cleared the loan :". $loanName."\n";
               
        }
        else
        {
            echo "No loan exists with that name $loanName\n";
        }
    }

    /**
     * Name : applyLoan
     * Purpose : To apply for specific loan offered  
     * Input : void
     * Returns : void
    */
    public function applyLoan()
    {
        $loan=readline("\nEnter loan name : ");
        $loanApplied=$loan;

        # checking for the existence of loan in loans array
        if(array_key_exists($loan,parent::$loans))
        {
            # checking for minimum salary criteria
            if(parent::$loans[$loan]["minSal"]<=$this->getSal())
            {
                # sanctioning the loan to the customer
                $this->custLoans[$loan]["name"]=$loanApplied;
                $this->custLoans[$loan]["amount"]=parent::$loans[$loan]["amount"];
                $this->custLoans[$loan]["intrest"]=parent::$loans[$loan]["intrest"];
                $this->custLoans[$loan]["due"]=parent::$loans[$loan]["amount"];
                $this->custLoans[$loan]["minSal"]=parent::$loans[$loan]["minSal"];
                $this->custLoans[$loan]["emi"]=parent::$loans[$loan]["emi"];
                $this->custLoans[$loan]["duration"]=parent::$loans[$loan]["duration"];
                echo "Sucessfully Sanctioned the loan\n";  
            }
            else
            {
                echo "\n You are not elgible for this loan.";
            }
        }
        else
        {
            echo "loan does not exists";
        }
    }

    /**
     * Name : login
     * Purpose : To validate the customer login credentials 
     * Input : void
     * Returns : customer object if customer credentials matches,else returns false 
    */
    public function login()
    {
        $mobile=readline("Enter mobile number : ");
        
        # check for existence of customer mobile in customers array
        if(array_key_exists($mobile,parent::$customers))
        {
            $password=readline("Enter password : ");

            # comparing the entered password with actual password
            if(parent::$customers[$mobile]->getPassword()==$password)
            {
                return parent::$customers[$mobile];
            }
            else
            {
                echo "Incorrect password";
                return false;
            }
        }
        else
        {
            echo "Customer Doesn't Exists ";
            return false;
        }
    }
    
    /**
     * Name : payInstallment
     * Purpose : To pay monthly installement of a parrticular loan  
     * Input : void
     * Returns : void
    */            
    function payInstallment()
    {
        echo "============ Loans to Pay ==================\n";
        # iterating through all the loans taken by customer
        foreach($this->custLoans as $key=>$value)
        {
            echo "Loan name:".$key."\n";
            echo "Loan Amount :".$value["amount"]."\n"; 
            echo "INTREST RATE :".$value["intrest"]."%\n";
            echo "pending Installments :".$value["duration"]." months\n";
            echo "minSal".$value["minSal"];
            echo "EMI :".$value["emi"]."\n";
            echo "DUE :" .$value["due"]."\n";
            echo "\n=================================\n";
        }
        $loanName=readline("Enter the loan name you want to repay :");

        # checking for the existence of entered loan in customer loans
        if(array_key_exists($loanName,$this->custLoans))
        {

            $amountPaying=$this->custLoans[$loanName]["emi"];
            echo "paying installement amount $amountPaying\n";
            $due=$this->custLoans[$loanName]["due"];
            if($due>0)
            {
                if($due>=$amountPaying)
                {
                    # decrementing installments and due amount
                    $this->custLoans[$loanName]["due"]-=$amountPaying;
                    $this->custLoans[$loanName]["duration"]-=1;
                    echo "The due is :". $this->custLoans[$loanName]["due"];
                }
                else
                {
                    echo "you are paying more.. transaction cancelled\n";
                }
                    
            }
            else
            {
                echo "There is no due for the loan $loanName\n";
            }
                
        }
        else
        {
            echo "No loan exists with that name $loanName\n";
        }
    }

     
}

?>