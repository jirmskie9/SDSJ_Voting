<?php
session_start();
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

  <title>SDSJ SSG Election</title>


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
    .btn - info {
      background - color: #077504 !important;
      border - color: #077504 !important;
      color: white !important;
      /* Ensures text is readable */
    }

    .btn - info:hover {
      background - color: #055a03 !important;
      /* Darker shade for hover effect */
      border - color: #055a03 !important;
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

    .modal {
      z-index: 1051 !important;
      /* Increase z-index */
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section long_section px-0">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="login.php">
          <img src="assets/logos.png" alt="" width=40 height=40>
          <span class="">
            Schola de San Jose SSG Election
          </span>
        </a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">

          </div>
          <div class="quote_btn-container">

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

                    <div class="card">

                      <div class="card-body">
                        <form method="POST" action="registerproc.php">
                          <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Student ID:</label>
                            <input type="text" class="form-control" name="studid" id="studid"
                              placeholder="Ex. 2021-01916" pattern="\d{4}-\d{5}"
                              title="Please enter a valid student ID in the format 'yyyy-xxxxx'" required>
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name"
                              placeholder="First and Last Name" aria-label="Name" pattern="[A-Za-z]+ [A-Za-z]+"
                              title="Please enter your first name and last name" required>
                          </div>
                          <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email"
                              required>
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control" name="pass" placeholder="Password"
                              aria-label="Password" id="passwordInput" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$"
                              title="Password must be at least 8 characters long and include at least one uppercase letter and one digit"
                              required>
                            <div class="password-strength" id="passwordStrength"><label>Password Strength: </label>
                            </div>
                            <div id="strength-bar"></div>
                          </div>
                          <div class="form-group">
                            <label for="gradeSelect">Grade:</label>
                            <select class="form-control" id="gradeSelect" name="grade" required>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="">Date of Birth:</label>
                            <input type="date" class="form-control" name="bday" placeholder="Date of Birth"
                              aria-label="DateofBirth" required>
                          </div>

                          <div class="modal-footer">
                            <a class="btn btn-primary" href="login.php">Login</a>
                            <button type="submit" class="btn btn-success" name="reg">Register</button>
                          </div>
                        </form>
                      </div>
                    </div>


                    <div class="btn-box"></div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="img-box">
                    <img src="assets/banner1.png" alt="">
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

  </div>
  <script>
    document.getElementById('passwordInput').addEventListener('input', function () {
      var password = document.getElementById('passwordInput').value;
      var strengthBadge = document.getElementById('passwordStrength');
      var strengthBar = document.getElementById('strength-bar');

      // Check password strength
      var strength = 0;
      if (password.match(/[a-z]+/)) {
        strength += 1;
      }
      if (password.match(/[A-Z]+/)) {
        strength += 1;
      }
      if (password.match(/[0-9]+/)) {
        strength += 1;
      }
      if (password.length >= 8) {
        strength += 1;
      }

      // Update the strength indicator and color bar
      switch (strength) {
        case 0:
          strengthBadge.innerHTML = 'Password Strength: Very Weak';
          strengthBar.className = 'very-weak';
          break;
        case 1:
          strengthBadge.innerHTML = 'Password Strength: Weak';
          strengthBar.className = 'weak';
          break;
        case 2:
          strengthBadge.innerHTML = 'Password Strength: Fair';
          strengthBar.className = 'fair';
          break;
        case 3:
          strengthBadge.innerHTML = 'Password Strength: Moderate';
          strengthBar.className = 'moderate';
          break;
        case 4:
          strengthBadge.innerHTML = 'Password Strength: Strong';
          strengthBar.className = 'strong';
          break;
      }
    });
  </script>


  <!-- furniture section -->


  <!-- end furniture section -->


  <!-- about section -->


  <!-- end info_section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> Information and Security Assurance
        <a href="https://html.design/">SY. 2023-2024, 2nd Semister</a>

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