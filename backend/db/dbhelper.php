<?php
require_once ('config.php');

function execute($sql) {
    //save data into table

    //open connection to database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    // insert, update, delete
    mysqli_query($con, $sql);

    // close connection
    mysqli_close($con);
}

function executeResult($sql) {
    //save data into table
    
    // open connection to database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    // insert, update, delete
    $result = mysqli_query($con, $sql);
    $data =[];

    while ($row = mysqli_fetch_array($result,1)) {
        $data[] =$row;
    }

    //cloes connection
    mysqli_close($con);
    return $data;
}

function getInset($sql) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
      if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
      }
      mysqli_close($conn);
      return $last_id;

}

?>