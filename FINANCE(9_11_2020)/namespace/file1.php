<?php
include "calc.php";
include "file2.php";

use namespace_1\A as A2;
class A
{
    function __construct()
    {
        echo "object created from class in file 1\n";
    }
}

$obj=new A();
$obj2= new A2();
echo calc\emiCalculator(1,1,1);