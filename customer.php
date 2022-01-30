<?php require_once "./Connection.php";
    session_start();
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $query = mysqli_query($con, "SELECT * FROM users Where username = '$user'");
        if($row = mysqli_fetch_assoc($query)){
          $marketstatus = $row['MarketStatus'];
          if($marketstatus == 1){
            $marketstatus = 'Market Opened';
          }else{
            $marketstatus = 'Market Not Yet Opened';
          }
        }
        
    }else{
        header("location: login.php");
    }
    ?>
<!doctype html>
<html lang="en">
  <head>
    <title>OBS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      <div class="container-fluid bg-primary navbar">
        <h3 class="text-light">Order Booking System [OBS]</h3>
      </div>
      <div class="container-fluid bodybox">
      <h4 class="mt-2"><b>Market Status: </b><span class="ml-3"><?php echo $marketstatus; ?></span></h4>
      <?php 
                      if(@$_GET['Invalid']){
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. $_GET['Invalid'] .'</strong></div>';
                      } 
                      if(@$_GET['Success']){
                          echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. $_GET['Success'] .'</strong></div>';
                      }                 
                  ?>
        <div class="login_container card shadow border py-5 px-3 my-2 rounded" style="width: 650px;">
            <h3 class="text-center text-secondary">Book Order here</h3>
            <form method="post" action="progress.php">
                <br>
                <label for="" class="">Choose  a stock </label>
                <select class="form-control" name="stock_name">
                  <option selected>Choose a stock</option>
                  <option>DBS</option>
                  <option>SBI</option>
                  <option>Bank of Baroda</option>
                </select>
                <br>
                <label for="" class="">Order Type</label>
                <select class="form-control" name="order_type" id="ordertype" onchange="checkOrderType()">
                  <option selected>Order Type</option>
                  <option>Limit</option>
                  <option>Market</option>
                </select>
                <br>
                <div class="form-group" id="Price">
                  <label for="">Price</label>
                  <input type="number" class="form-control" name="price" aria-describedby="helpId" placeholder="Enter Price">
                </div>
                <div class="form-group">
                  <label for="">Quantify</label>
                  <input type="number" class="form-control" name="quantity" id="" aria-describedby="helpId" placeholder="Enter Price">
                </div>
              <br>
                <center><button type="submit" name="upload" class="btn btn-primary">Place Order</button>
                      <a name="" id="" class="btn btn-danger" href="progress.php?logout=1" role="button">logout</a>
                </center>
            </form>
            
            </div>
        </div>
      </div>
      <script>
          function checkOrderType(){
          let order_type = document.getElementById('ordertype').value;
          if(order_type == 'Market'){
              document.getElementById('Price').style.display = 'none';
          }
        }
      </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>