<?php
    include_once 'conn.php';
    
    $sql = "SELECT * FROM ym_sizes";
    $query = mysql_query($sql);
    $result = array();
    
    while ($row = mysql_fetch_object($query))
        array_push($result, array('Unit', $row[0],
                                  'Size', $row[1],
                                  'Length', $row[2],
                                  'Chest', $row[3],
                                  'Waist', $row[4],
                                  'Shoulder', $row[5],
                                  'Sleeve', $row[6],
                                  'Hip', $row[7],
                                  'Height', $row[8],
                                  'Weight', $row[9],
        ));

?>