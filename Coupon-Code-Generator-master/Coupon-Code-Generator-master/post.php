<?php 
$username = "root";
$password = "";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");

mysql_select_db("code-gen",$dbhandle);


$number=$_POST['number'];
if($number=="")
{
	echo 1;
}
else if (strlen($number)<10 || strlen($number)>10)
{
	echo 2;
}
else if(!is_numeric($number))
{
	echo 3;
}
else{

	$result = mysql_query("SELECT * FROM codes where phone ='$number'");    
    
    if(@mysql_num_rows($result)==0 )
  	{
	$length=5;
 		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = str_shuffle($characters);
    $code = substr(str_shuffle(implode(array_merge(range(0,9), range('A', 'H'),range('J', 'K'),range('M', 'N'),range('P', 'Z'), range('a', 'h'),range('j', 'k'),range('m', 'n'),range('p', 'z')))), 0, $length);
    echo $code;

    mysql_query("insert into codes (phone, code,status ) values ('$number', '$code', '0')");
  	}

    else {

    	while($row = @mysql_fetch_array($result))
		  {
        if($row['status']!=1)
        {
 			 echo $row['code'];
      }
      else
        echo 6;
  		}
    }
    


}
?>