<?php

require_once "./connection.php";
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
      <?php 
                      if(@$_GET['Invalid']){
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. $_GET['Invalid'] .'</strong></div>';
                      } 
                      if(@$_GET['Success']){
                          echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. $_GET['Success'] .'</strong></div>';
                      }                 
                  ?>
        <div class="container">
            <div class="row mx-0 mt-4">
                <a name="" id="" class="btn btn-info rounded-0 mx-2" href="admin.php?marketstatus=1" role="button">Open Market</a>
                <a name="" id="" class="btn btn-info rounded-0 mx-2" href="admin.php?closeMarket=1" role="button">Close Market</a>
                      <a name="" id="" class="btn btn-danger" href="progress.php?logout=1" role="button">logout</a>
            </div>
            <?php
                    if(@$_GET['marketstatus']){
                        $update_customer = mysqli_query($con, "UPDATE users SET MarketStatus = 1");
                        $marketstatus = 'Opened';
                    }else{
                        $marketstatus = 'Not Opened';
                    }if(@$_GET['closeMarket']){
                        $update_customer = mysqli_query($con, "UPDATE users SET MarketStatus = 0");
                    }
            ?>
            <h4 class="mt-2"><b>Market Status: </b><span class="ml-3"><?php echo $marketstatus; ?></span></h4>
            
            <div class="row">
                      <form action="admin.php" method="post" class="row mx-0 mt-3">
                          <div class="Chosse">
                              <div class="form-group mx-3">
                                <label for="">Choose Stock</label>
                                <select class="form-control" name="stock_name" id="">
                                  <option>DBS</option>
                                  <option>SBI</option>
                                  <option>Bank of Baroda</option>
                                </select>
                              </div>
                          </div>
                          <div class="from_date">
                              <div class="form-group mx-3">
                                <label for="">From Date</label>
                                <input type="date"
                                  class="form-control" name="fromdate" id="fromdate" aria-describedby="helpId" placeholder="">
                              </div>
                          </div>
                          <div class="from_date">
                              <div class="form-group">
                                <label for="">To Date</label>
                                <input type="date"
                                  class="form-control" name="todate" id="" aria-describedby="helpId" placeholder="">
                              </div>
                          </div>
                          <div class="submit">
                            <button type="submit" name="filter" class="btn btn-primary rounded-0 btn-sm mx-2 mt-4">Show Orders</button>
                          </div>
                      </form>
            </div>
            <table class="table table-striped table-inverse table-bordered mt-5">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>s.no</th>
                                    <th>Stock Name</th>
                                    <th>Order Qty</th>
                                    <th>Order Type</th>
                                    <th>Exe. Qty</th>
                                    <th>Price</th>
                                    <th>Order Status</th>
                                    <th>Order Date</th>
                                </tr>
                                </thead>
                                <tbody>
            <?php 
            
                    if(isset($_POST['filter'])){ 
                            $stock_name = $_POST['stock_name'];
                            $fGivenDate  = $_POST['fromdate'];
                            $tGivenDate  = $_POST['todate'];

                        ?>
<?php
                                    require_once "./connection.php";
                                        $today = date('Y-m-d');
                                        $sno = 0;
                                        $query = mysqli_query($con, "SELECT * FROM orders WHERE stock_name = '$stock_name' AND ('$fGivenDate' < Date AND '$tGivenDate' > Date)");
                                        while($row = mysqli_fetch_assoc($query)){
                                            $sno = $sno +1;
                                            $stock_name = $row['stock_name'];
                                            $order_qty  = $row['qty'];
                                            $order_type = $row['order_type'];
                                            $exe_qty    = $row['ExeQty'];
                                            $price      = $row['price'];
                                            $status     = $row['status'];
                                            $Date       = date("d-M-Y", strtotime($row['Date']));
                                        
                                    ?>
                                    <tr>
                                        <td scope="row"><?php echo $sno; ?></td>
                                        <td><?php echo $stock_name; ?></td>
                                        <td><?php echo $order_qty; ?></td>
                                        <td><?php echo $order_type; ?></td>
                                        <td><?php echo $exe_qty; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $Date; ?></td>
                                    </tr>
                                    <?php } ?>
                    
            </tbody>
    </table> 
                    <div class="row mx-0">
    <form action="admin.php" method="post" class="row mx-0">
        <div class="form-group mx-2">
          <label for="">Execution Qty</label>
          <input type="text" class="form-control" name="exe_qty" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group mx-2">
          <label for="">Execution Price</label>
          <input type="text" class="form-control" name="exe_price" id="" aria-describedby="helpId" placeholder="">
        </div>
        <input type="hidden" name="stock_name" value="<?php echo $stock_name; ?>">
        <div class="submit mx-2">
            <button type="submit" name="check" class="btn btn-primary rounded-0 btn-sm mt-4">Execute Orders</button>
        </div>
    </form>
</div>
                    
                    <?php }else{ ?>

                                    <?php
                                        $today = date('Y-m-d');
                                        $sno = 0;
                                        $query = mysqli_query($con, "SELECT * FROM orders");
                                        while($row = mysqli_fetch_assoc($query)){
                                            $sno = $sno +1;
                                            $stock_name = $row['stock_name'];
                                            $order_qty  = $row['qty'];
                                            $order_type = $row['order_type'];
                                            $exe_qty    = $row['ExeQty'];
                                            $price      = $row['price'];
                                            $Date       = date("d-M-Y", strtotime($row['Date']));
                                            $status     = $row['status'];

                                        
                                    ?>
                                    <tr>
                                        <td scope="row"><?php echo $sno; ?></td>
                                        <td><?php echo $stock_name; ?></td>
                                        <td><?php echo $order_qty; ?></td>
                                        <td><?php echo $order_type; ?></td>
                                        <td><?php echo $exe_qty; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $Date; ?></td>
                                    </tr>
                                    <?php } ?>
                    <?php }

            ?>
            </tbody>
    </table> 


<?php
if(isset($_POST['check'])){
    $exe_qty  = $_POST['exe_qty'];
    $exe_price = $_POST['exe_price'];
    $stock_name = $_POST['stock_name'];
    $get_orders = mysqli_query($con, "SELECT * FROM orders WHERE stock_name = '$stock_name'");
    while($row = mysqli_fetch_assoc($get_orders)){
        $order_type = $row['order_type'];
        $qty  = $row['qty'];
        $price = $row['price'];
        $ID  = $row['ID'];
        if($order_type == 'Limit'){
            if($price < $exe_price){
                $query = mysqli_query($con, "UPDATE orders SET status = 'REJECTED', ExeQty = '$exe_qty', price = '$exe_price' WHERE stock_name = '$stock_name' AND ID = $ID");
            }else{

                $query = mysqli_query($con, "UPDATE orders SET status = 'ACCEPTED', ExeQty = '$exe_qty' WHERE stock_name = '$stock_name' AND ID = $ID");
            }
        }
        if($order_type == 'Market'){

            $query = mysqli_query($con, "UPDATE orders SET status = 'ACCEPTED', ExeQty = '$exe_qty', price = '$exe_price' WHERE stock_name = '$stock_name' AND ID = $ID");
        }
    }
}

?>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>