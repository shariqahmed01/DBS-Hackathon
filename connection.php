<?php

    $host     = "localhost";
    $root     = "root";
    $database = "obs";
    $password = "";

    $con = mysqli_connect($host, $root, $password, $database);
    if(!$con){
        echo "Database Connection Failed. Please Contact Your Adminstrator";
    }