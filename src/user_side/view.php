<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['email'])) {
    header('location: pages/login.php');
    exit();
}

if (isset($_SESSION['email'])) {
    $uemail = $_SESSION['email'];
    $sql_session = "SELECT * FROM users WHERE email = '$uemail'";
    $result_session = $conn->query($sql_session);

    if ($result_session->num_rows > 0) {
        $row_session = $result_session->fetch_assoc();
        $name = $row_session['name'];
    }
}




checkStatus($conn, $uemail);


function checkStatus($conn, $email) {
  
   

    $sql_check_waiting = "SELECT * FROM users WHERE email = '$email' AND status ='To Vote'";
    $result_check_waiting = $conn->query($sql_check_waiting);

    if ($result_check_waiting->num_rows > 0) {
        
       

        $_SESSION['[status]'] = "Vote First!";
        $_SESSION['[status_code]'] = "info";
        $_SESSION['[status_button]'] = "Okay";
        header('Location: vote.php');
        exit();
    } else {
     
       
    }
}
?>


<?php

function maskString($string) {
    // Replace the middle characters with asterisks, keeping the first and last characters intact
    $length = strlen($string);
    if ($length <= 2) {
        return str_repeat('*', $length); // Mask entirely if string length is 2 or less
    }
    return substr($string, 0, 1) . str_repeat('*', $length - 2) . substr($string, -1);
}

$sql = "SELECT * FROM votes WHERE vote_name = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Masking each piece of data
    $pres = maskString($row['voted_pres']);
    $vice = maskString($row['voted_vice']);
    $sec = maskString($row['voted_sec']);
    $trea = maskString($row['voted_trea']);
    $aud = maskString($row['voted_aud']);
    $pio1 = maskString($row['voted_pio1']);
    $pio2 = maskString($row['voted_pio2']);
    $pio3 = maskString($row['voted_pio3']);
    $pio4 = maskString($row['voted_pio4']);
    $po1 = maskString($row['voted_po1']);
    $po2 = maskString($row['voted_po2']);
    $po3 = maskString($row['voted_po3']);
    $rep = maskString($row['voted_representative']);
    $date = maskString($row['date_time']); // You can decide how to mask date/time
    $grade = maskString($row['grade']);   // You can adjust for numerical values if needed
}

?>

<?php
include("../includes/header.php");
?>
<body class="with-welcome-text">
  <div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
      
    </div>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
    <a class="navbar-brand brand-logo" href="../index.php">
        <img src="../assets/logos.png" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="../index.php">
        <img src="../assets/logos.png" alt="logo" />
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text" style = "color: #387ADF;">Hello, <span class="text-black fw-bold"><?php echo $name?></span></h1>
       
      </li>
    </ul>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
  <div id="settings-trigger"><i class="ti-settings"></i></div>
  <div id="theme-settings" class="settings-panel">
    <i class="settings-close ti-close"></i>
    <p class="settings-heading">SIDEBAR SKINS</p>
    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
      <div class="img-ss rounded-circle bg-light border me-3"></div>Light
    </div>
    <div class="sidebar-bg-options" id="sidebar-dark-theme">
      <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
    </div>
    <p class="settings-heading mt-2">HEADER SKINS</p>
    <div class="color-tiles mx-0 px-4">
      <div class="tiles success"></div>
      <div class="tiles warning"></div>
      <div class="tiles danger"></div>
      <div class="tiles info"></div>
      <div class="tiles dark"></div>
      <div class="tiles default"></div>
    </div>
  </div>
</div>
<div id="right-sidebar" class="settings-panel">
  <i class="settings-close ti-close"></i>
  
  <div class="tab-content" id="setting-content">
    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
      aria-labelledby="todo-section">
      <div class="add-items d-flex px-3 mb-0">
        <form class="form w-100">
          <div class="form-group d-flex">
            <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
            <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
          </div>
        </form>
      </div>
      <div class="list-wrapper px-3">
        <ul class="d-flex flex-column-reverse todo-list">
          <li>
            <div class="form-check">
              <label class="form-check-label">
                <input class="checkbox" type="checkbox">
                Team review meeting at 3.00 PM
              </label>
            </div>
            <i class="remove ti-close"></i>
          </li>
          <li>
            <div class="form-check">
              <label class="form-check-label">
                <input class="checkbox" type="checkbox">
                Prepare for presentation
              </label>
            </div>
            <i class="remove ti-close"></i>
          </li>
          <li>
            <div class="form-check">
              <label class="form-check-label">
                <input class="checkbox" type="checkbox">
                Resolve all the low priority tickets due today
              </label>
            </div>
            <i class="remove ti-close"></i>
          </li>
          <li class="completed">
            <div class="form-check">
              <label class="form-check-label">
                <input class="checkbox" type="checkbox" checked>
                Schedule meeting for next week
              </label>
            </div>
            <i class="remove ti-close"></i>
          </li>
          <li class="completed">
            <div class="form-check">
              <label class="form-check-label">
                <input class="checkbox" type="checkbox" checked>
                Project review
              </label>
            </div>
            <i class="remove ti-close"></i>
          </li>
        </ul>
      </div>
      <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
      <div class="events pt-4 px-3">
        <div class="wrapper d-flex mb-2">
          <i class="ti-control-record text-primary me-2"></i>
          <span>Feb 11 2018</span>
        </div>
        <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
        <p class="text-gray mb-0">The total number of sessions</p>
      </div>
      <div class="events pt-4 px-3">
        <div class="wrapper d-flex mb-2">
          <i class="ti-control-record text-primary me-2"></i>
          <span>Feb 7 2018</span>
        </div>
        <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
        <p class="text-gray mb-0 ">Call Sarah Graves</p>
      </div>
    </div>
    <!-- To do section tab ends -->
    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
      <div class="d-flex align-items-center justify-content-between border-bottom">
        <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
        <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
      </div>
      <ul class="chat-list">
        <li class="list active">
          <div class="profile"><img src="../assets/images/faces/face1.jpg" alt="image"><span class="online"></span>
          </div>
          <div class="info">
            <p>Thomas Douglas</p>
            <p>Available</p>
          </div>
          <small class="text-muted my-auto">19 min</small>
        </li>
        <li class="list">
          <div class="profile"><img src="../assets/images/faces/face2.jpg" alt="image"><span class="offline"></span>
          </div>
          <div class="info">
            <div class="wrapper d-flex">
              <p>Catherine</p>
            </div>
            <p>Away</p>
          </div>
          <div class="badge badge-success badge-pill my-auto mx-2">4</div>
          <small class="text-muted my-auto">23 min</small>
        </li>
        <li class="list">
          <div class="profile"><img src="../assets/images/faces/face3.jpg" alt="image"><span class="online"></span>
          </div>
          <div class="info">
            <p>Daniel Russell</p>
            <p>Available</p>
          </div>
          <small class="text-muted my-auto">14 min</small>
        </li>
        <li class="list">
          <div class="profile"><img src="../assets/images/faces/face4.jpg" alt="image"><span class="offline"></span>
          </div>
          <div class="info">
            <p>James Richardson</p>
            <p>Away</p>
          </div>
          <small class="text-muted my-auto">2 min</small>
        </li>
        <li class="list">
          <div class="profile"><img src="../assets/images/faces/face5.jpg" alt="image"><span class="online"></span>
          </div>
          <div class="info">
            <p>Madeline Kennedy</p>
            <p>Available</p>
          </div>
          <small class="text-muted my-auto">5 min</small>
        </li>
        <li class="list">
          <div class="profile"><img src="../assets/images/faces/face6.jpg" alt="image"><span class="online"></span>
          </div>
          <div class="info">
            <p>Sarah Graves</p>
            <p>Available</p>
          </div>
          <small class="text-muted my-auto">47 min</small>
        </li>
      </ul>
    </div>
    <!-- chat tab ends -->
  </div>
</div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Current Ranking</span>
      </a>
    </li>
    
    <li class="nav-item nav-category">Menu</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="vote.php" aria-expanded="false"
        aria-controls="form-elements">
        <i class="menu-icon mdi mdi-account-multiple-outline"></i>
        <span class="menu-title">Vote Now</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="partylist.php">View Vote Ballot</a>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="view.php" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-account-settings"></i>
        <span class="menu-title">View Vote Ballot</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="independent.php">Independent</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="logout.php" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-account-off"></i>
        <span class="menu-title">Logout</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="logout.php">Independent</a></li>
        </ul>
      </div>
    </li></li>
    
    
  </ul>
</nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
               
                  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View your voted Candidates!</h4>
                  <p class="card-description">
                    Review <code>your votes</code>
                  </p>
                  
                  <div class="vote-summary-banner mb-4">
                    <div class="banner-content">
                      <i class="mdi mdi-check-circle-outline banner-icon"></i>
                      <div>
                        <h3>Your Vote Has Been Recorded</h3>
                        <p>Thank you for participating in the Student Government election</p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/president.png" alt="President" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">President</h5>
                            <p class="position-value mb-0"><?php echo $pres?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/vice.png" alt="Vice President" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">Vice President</h5>
                            <p class="position-value mb-0"><?php echo $vice?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/sec.png" alt="Secretary" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">Secretary</h5>
                            <p class="position-value mb-0"><?php echo $sec?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/treasure.png" alt="Treasurer" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">Treasurer</h5>
                            <p class="position-value mb-0"><?php echo $trea?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/auditor.png" alt="Auditor" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">Auditor</h5>
                            <p class="position-value mb-0"><?php echo $aud?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/public.png" alt="Public Information Officers" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">Public Information Officers</h5>
                            <p class="position-value mb-0">
                              <span class="candidate-item">(1) <?php echo $pio1?></span> | 
                              <span class="candidate-item">(2) <?php echo $pio2?></span> | 
                              <span class="candidate-item">(3) <?php echo $pio3?></span> | 
                              <span class="candidate-item">(4) <?php echo $pio4?></span>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/peace.png" alt="Peace Officers" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">Peace Officers</h5>
                            <p class="position-value mb-0">
                              <span class="candidate-item">(1) <?php echo $po1?></span> | 
                              <span class="candidate-item">(2) <?php echo $po2?></span> | 
                              <span class="candidate-item">(3) <?php echo $po3?></span>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm position-card">
                        <div class="card-body d-flex align-items-center">
                          <div class="position-icon me-3">
                            <img src="../assets/images/peace.png" alt="Year Representative" class="position-icon-img">
                          </div>
                          <div>
                            <h5 class="position-title mb-1">Year Representative</h5>
                            <p class="position-value mb-0"><?php echo $rep ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="card mt-4 mb-4 thank-you-card">
                    <div class="card-body text-center">
                      <div class="d-flex justify-content-center mb-3">
                        <img src="../assets/logos.png" alt="Logo" class="me-3" width="50" height="50">
                        <img src="../assets/icons/ssglogo.jpg" alt="SSG Logo" width="50" height="50">
                      </div>
                      <p class="thank-you-message">
                        Thank you for voting in our school's Student Government election.<br>
                        Your support is instrumental in electing representatives who will advocate for<br>
                        the student body's interests and work towards enhancing our school experience.
                      </p>
                      <div class="mt-4">
                        <a href="index.php" class="btn btn-primary btn-lg">
                          <i class="mdi mdi-arrow-left me-2"></i>Back to Dashboard
                        </a>
                      </div>
                    </div>
                  </div>
                  
                  <style>
                    .vote-summary-banner {
                      background: linear-gradient(135deg, #387ADF 0%, #5a9cff 100%);
                      border-radius: 10px;
                      padding: 20px;
                      color: white;
                      box-shadow: 0 4px 15px rgba(56, 122, 223, 0.2);
                    }
                    
                    .banner-content {
                      display: flex;
                      align-items: center;
                    }
                    
                    .banner-icon {
                      font-size: 3rem;
                      margin-right: 20px;
                    }
                    
                    .banner-content h3 {
                      margin-bottom: 5px;
                      font-weight: 600;
                    }
                    
                    .banner-content p {
                      margin-bottom: 0;
                      opacity: 0.9;
                    }
                    
                    .position-icon {
                      width: 50px;
                      height: 50px;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      background-color: #f8f9fa;
                      border-radius: 50%;
                      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
                    }
                    
                    .position-icon-img {
                      width: 30px;
                      height: 30px;
                      object-fit: contain;
                    }
                    
                    .position-title {
                      color: #387ADF;
                      font-weight: 600;
                      font-size: 1.1rem;
                    }
                    
                    .position-value {
                      font-size: 1rem;
                      color: #333;
                    }
                    
                    .candidate-item {
                      display: inline-block;
                      padding: 2px 5px;
                      border-radius: 4px;
                      background-color: #f8f9fa;
                    }
                    
                    .thank-you-message {
                      font-size: 1.1rem;
                      color: #555;
                      line-height: 1.6;
                    }
                    
                    .position-card {
                      border-radius: 8px;
                      transition: all 0.3s ease;
                      border: 1px solid rgba(0,0,0,0.05);
                    }
                    
                    .position-card:hover {
                      transform: translateY(-5px);
                      box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
                    }
                    
                    .thank-you-card {
                      background: linear-gradient(to right, #f8f9fa, #ffffff);
                      border: none;
                      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                    }
                    
                    .btn-primary {
                      background-color: #387ADF;
                      border-color: #387ADF;
                      padding: 10px 20px;
                      font-weight: 500;
                      transition: all 0.3s ease;
                    }
                    
                    .btn-primary:hover {
                      background-color: #2a5fbf;
                      border-color: #2a5fbf;
                      transform: translateY(-2px);
                      box-shadow: 0 5px 10px rgba(56, 122, 223, 0.3);
                    }
                    
                    @media (max-width: 768px) {
                      .banner-content {
                        flex-direction: column;
                        text-align: center;
                      }
                      
                      .banner-icon {
                        margin-right: 0;
                        margin-bottom: 15px;
                      }
                    }
                  </style>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       <?php
        include("../includes/footer.php");
       ?>
  <?php
    include("../includes/script.php");
  ?>
</body>

</html>