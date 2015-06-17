<?php
/**
 * @author: kim kiogora <kimkiogora@gmail.com>
*/ 
$check_file="Singleton.php";
$cmd="ps aux | grep -i $check_file | grep -v \"grep\"|awk '{print $2}'";
$result =array();
exec($cmd,$result);

if(isset($result[0]) && (int)$result[0]> 0){
        echo "\nFound another instance\n";
        exit(1);
}
echo "\nNo ther instance found.Proceed\n";
