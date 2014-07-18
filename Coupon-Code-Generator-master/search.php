<?php
$username = "influx_paalamcpn";
$password = "25o-U84-Cu2-qpu";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

mysql_select_db("influx_paalamcoupon", $dbhandle);



    $number = $_POST['number'];
    if ($number == "") {
        echo 1;
    } else if (strlen($number) < 10 || strlen($number) > 10) {
        echo 2;
    } else if (!is_numeric($number)) {
        echo 3;
    } else {
        
        $result = mysql_query("SELECT * FROM codes where phone ='$number'");
        
        if (@mysql_num_rows($result) == 0) {
            echo "4";
        }
        
        else {
            
            while ($row = @mysql_fetch_array($result)) {
                if($row['status']==0)
                echo $row['code'];
            else 
                echo 6;
                
            }
        }
        
    }

?>