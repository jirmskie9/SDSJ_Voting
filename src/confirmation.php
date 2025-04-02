<?php
session_start();
include('dbcon.php');

if (!isset($_SESSION['uemail'])) {
  header('location: login.php');
  exit();
}

if (isset($_SESSION['uemail'])) {
  $uemail = $_SESSION['uemail'];
  $sql_session = "SELECT * FROM users WHERE email = '$uemail'";
  $result_session = $conn->query($sql_session);

  if ($result_session->num_rows > 0) {
    $row_session = $result_session->fetch_assoc();
    $email = $row_session['email'];
  }
}
?>


<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="assets/logos.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Schola de San Jose SSG Election</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="login/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- font awesome style -->
  <link href="login/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="login/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="login/css/responsive.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>


    // Ensure Toastr is properly initialized
    toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: 'toast-top-right',
      preventDuplicates: true,
      onclick: null,
      showDuration: '400',
      hideDuration: '1000',
      timeOut: '7000',
      extendedTimeOut: '1000',
      showEasing: 'swing',
      hideEasing: 'linear',
      showMethod: 'fadeIn',
      hideMethod: 'fadeOut'
    };

    document.addEventListener('DOMContentLoaded', function () {
      <?php echo $error_message; ?>
    });
  </script>

  <style>
    .btn-info {
      background-color: #077504 !important;
      border-color: #077504 !important;
      color: white !important;
      /* Ensures text is readable */
    }

    .btn-info:hover {
      background-color: #055a03 !important;
      /* Darker shade for hover effect */
      border-color: #055a03 !important;
    }

    .password-strength {
      margin-top: 5px;
      font-size: 12px;
    }

    #strength-bar {
      height: 5px;
      margin-top: 5px;
    }

    .very-weak {
      height: 5px;
      background-color: #ff4d4d;
    }

    .weak {
      background-color: #ffa07a;
    }

    .fair {
      background-color: #ffd700;
    }

    .moderate {
      background-color: #add8e6;
    }

    .strong {
      background-color: #90ee90;
    }

    .very-strong {
      background-color: #00cc00;
    }
  </style>
</head>

<body>



  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section long_section px-0">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="login.php">
          <img src="assets/logos.png" alt="" width=30 height=30>
          <span>
          Schola de San Jose SSG Election
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">

          </div>
          <div class="quote_btn-container">
            <button class="btn btn-info" data-toggle="modal" data-target="#likeModal">Login</button>

          </div>
        </div>
      </nav>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section long_section">
      <div id="customCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-5">
                  <div class="detail-box">
                    <h2>
                      Confirm your <br>
                      Account!
                    </h2>
                    <p>
                      OTP Sent to <?php echo $email ?>
                    </p>
                    <form method="POST" action="confproc.php">
                      <input type="number" class="form-control" id="exampleInputUsername1" placeholder="OTP" name="otp">
                      <br>
                      <input type="hidden" value="<?php echo $email ?>" name="email">
                      <div class="btn-box">

                        <button type="submit" class="btn2" name="ver">Confirm</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="img-box">
                  <img src="assets/vector.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <ol class="carousel-indicators">
        <li data-target="#customCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#customCarousel" data-slide-to="1"></li>
        <li data-target="#customCarousel" data-slide-to="2"></li>
      </ol>
  </div>
  </section>
  <!-- end slider section -->
  </div>

  <!-- furniture section -->


  <!-- end furniture section -->


  <!-- about section -->


  <!-- end info_section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> Developed by
        <a href="https://html.design/">Cristy Mae Balaba</a>

      </p>
    </div>
  </footer>
  <!-- footer section -->


  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->
  <script>
    $(document).ready(function () {
      $("#loveThisButton").click(function () {
        $("#likeModal").modal('show');
      });
    });
  </script>
  <script src="sweetalert.min.js"></script>

  <?php
  if (isset($_SESSION['[status]']) && $_SESSION['[status]'] != '') {
    ?>
    <script>
      swal({
        title: "<?php echo $_SESSION['[status]']; ?>",
        icon: "<?php echo $_SESSION['[status_code]']; ?>",
        button: "<?php echo $_SESSION['[status_button]']; ?>",
      });
    </script>
    <?php
    unset($_SESSION['[status]']);
    unset($_SESSION['[status_code]']);
    unset($_SESSION['[status_button]']);
  }
  ?>
</body>

</html>