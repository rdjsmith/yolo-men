<link href="css/bootstrap.css" rel="stylesheet">
<div class="container">
<center>
<?php 
$username = "root";
$password = "";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");

mysql_select_db("code-gen",$dbhandle);
$result = mysql_query("SELECT * FROM codes ");   
while ($row = mysql_fetch_array($result)) {
   echo $row['code'];
   echo "  ";
   echo $row['phone'];
   echo "<br>";
  # code...
}


?>
</center>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script>

</script>