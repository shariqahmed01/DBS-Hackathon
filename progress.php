<?php

    require_once "./connection.php";

    if(isset($_POST['sign_in'])){
        if (empty($_POST['username']) || empty($_POST['password'])) {
            header("location:login.php?Empty=Enter User Name and Password");
        } else {
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $login_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
            if (mysqli_num_rows($login_query) == 1) {
                while ($row = mysqli_fetch_assoc($login_query)) {
                    if (password_verify($password, $row['password'])) {
                        $login = true;
                        session_set_cookie_params(0);
                        session_start();
                        $_SESSION['user'] = $username;
                        header("location:customer.php");
                    } else {
                        header("location:login.php?Invalid=Password is incorrect");
                    }
                }
            } else {
                header("location:login.php?Invalid=Username or password is incorrect :(");
            }
        }
    }
    if(isset($_POST['sign_up'])){
        $username = $_POST['username'];
        $Hash  = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $result   = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($result) > 0){
            header("location: register.php?Invalid=Username already exists. Try another username");
        }else{
            $Newuser  = mysqli_query($con, "INSERT INTO users(username, password, category) VALUES('$username', '$Hash', 'customer')");
            if($Newuser){
                header("location: login.php?Success=Your Account Is Successfully Created. Try login now.");
            }else{
                header("location: register.php?Invalid=Some error occured. Try again later.");
            }
        }
    }
        // User Logout
        if (isset($_GET['logout'])) {
            $params = session_get_cookie_params(); 
            setcookie(session_name(), '', time() - 42000, 
                $params["path"], $params["domain"], 
                $params["secure"], $params["httponly"] 
            ); 
            session_destroy();
            header("location:login.php");
        }
if(isset($_POST['upload']))
{    
     $query = mysqli_query($con, "SELECT MarketStatus From users");
     if($row = mysqli_fetch_assoc($query)){  
         $MarketStauts = $row['MarketStatus'];
         if($MarketStauts == 1){
            $stock_name = $_POST['stock_name'];
            $order_type = $_POST['order_type'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $Insert_stock = mysqli_query($con, "INSERT INTO orders(stock_name, order_type, price, qty, status) VALUES ('$stock_name','$order_type','$price','$quantity', 'Placed')");
            if($Insert_stock){
                header("location:customer.php?Success=Order Sent :)");

            }else{
                header("location:customer.php?Invalid=some error in sent :(");
            }             
         }else{
            header("location:customer.php?Invalid=Market Not Yet Opened");
         }
     }

}