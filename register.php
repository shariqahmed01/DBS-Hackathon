<!doctype html>
<html lang="en">
  <head>
    <title>OBS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
      <div class="bg-primary navbar mx-0 row">
        <img src="./logo.jpg" class="logo1 border shadow" alt="" style="width: 50px; height: auto;">
        <h3 class="text-light col-7">Order Booking System [OBS]</h3>
      </div>
      <div class="container-fluid bodybox">
        <div class="row mx-0 whole_content align-items-center">
          <div class="col-6">
              <img src="./logo.jpg" class=" logo border shadow" alt="">
          </div>
          <div class="col-6">
          <div class="login_container card shadow border py-5 mt-4 rounded">
            <h4 class="text-center text-primary font-weight-bold"><u>Register Here</u></h4>
                <?php 
                      if(@$_GET['Invalid']){
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>'. $_GET['Invalid'] .'</strong></div>';
                      }                 
                  ?>
                <script>
                  $(".alert").alert();
                </script>
                <form action="progress.php" method="post">
                    <div class="form-group">
                      <label for="">username</label>
                      <input type="text" class="form-control" name="username" id="" placeholder="eg: rakesh">
                    </div>
                    <div id="message" class="text-danger"></div>
                    <div class="form-group">
                      <label for="">password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="eg. ****">
                    </div>
                    <div class="form-group">
                      <label for="">confirm password</label>
                      <input type="password" class="form-control" name="cpassword" id="cpassword" onchange="checkpassword()" placeholder="eg. ****">
                    </div>
                    <center>
                   <a name="" id="" class="btn btn-info" href="./login.php" role="button">Login</a>
                   <button type="submit" name="sign_up" class="btn btn-primary">Register</button></center>
                </form>
            </div>
          </div>
        </div>

      </div>
      <img src="./bg.jpg" class="bg_img" alt="">
      <script>
          function checkpassword(){
              let pass = document.getElementById('password').value;
                let cpass = document.getElementById('cpassword').value;
                if(pass != cpass){
                    document.getElementById("message").innerHTML = "password doesnt match"; 
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