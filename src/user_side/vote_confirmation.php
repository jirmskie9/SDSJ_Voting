<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['email'])) {
  header('location: ../login.php');
  exit();
}
if (!isset($_SESSION['voter'])) {
  header('location: vote.php');
  exit();
}

if (isset($_SESSION['email'])) {
  $uemail = $_SESSION['email'];
  $sql_session = "SELECT * FROM users WHERE email = '$uemail'";
  $result_session = $conn->query($sql_session);

  if ($result_session->num_rows > 0) {
    $row_session = $result_session->fetch_assoc();
    $name = $row_session['name'];
    $email = $row_session['email'];
    $grade = $row_session['grade'];

  }
}


if (isset($_SESSION['voter'])) {

    $name = $_SESSION['voter'];
    $pres = $_SESSION['pres'];
    $vice = $_SESSION['vice'];
    $sec = $_SESSION['sec'];
    $trea = $_SESSION['trea'];
    $aud = $_SESSION['aud'];
    $pio1 = $_SESSION['pio1'];
    $pio2 = $_SESSION['pio2'];
    $pio3 = $_SESSION['pio3'];
    $pio4 = $_SESSION['pio4'];
    $po1 = $_SESSION['po1'];
    $po2 = $_SESSION['po2'];
    $po3 = $_SESSION['po3'];
    $rep = $_SESSION['rep'];
  
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
                  <h4 class="card-title">Vote Wisely!</h4>
                  <p class="card-description">
                    Review <code>your votes</code>
                  </p>
                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/president.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">President:</label>
                    <h9><?php echo $pres?></9>
                  
                    </div>
                  </div>
                  </div>
                  
                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/vice.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">Vice President:</label>
                    <h9><?php echo $vice?></9>
                  
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/sec.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">Secretary:</label>
                    <h9><?php echo $sec?></9>
                  
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/treasure.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">Treasurer:</label>
                    <h9><?php echo $trea?></9>
                  
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/auditor.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">Auditor:</label>
                    <h9><?php echo $aud?></9>
                  
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/public.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">Public Information Officers:</label>
                    <h9>(1)<?php echo $pio1?></h9> <h9>(2)<?php echo $pio2?></h9> <h9>(3)<?php echo $pio3?></h9><h9>(4)<?php echo $pio4?></9>
                  
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/peace.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">Peace Officers:</label>
                    <h9>(1)<?php echo $po1?></h9> <h9>(2)<?php echo $po2?></h9> <h9>(3)<?php echo $po3?></h9>
                  
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    <img src="../assets/images/peace.png" alt="" width = 30 height = 30>
                    <label for="" style = "color: #387ADF;">Year Representative:</label>
                    <h9><?php echo $rep ?></h9>
                  
                    </div>
                  </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                    
                    <button type="submit" class="btn btn-info me-2" name = "conf" data-toggle="modal" data-target="#likeModal">Confirm</button>
                    <a href="vote.php" class="btn btn-danger me-2">Back</a>
                  
                    </div>
                  </div>
                  </div>
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="bootstrap-modal">
    <div class="modal fade" id="likeModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h12>Are you done reviewing your ballot?</h12>
                  <button type="button" class="close" data-dismiss="modal" style="border: none; background: none;">
                  <img src="../assets/logos.png" alt="Close" width="30" height="30">
              </button>
                </div>
                <form method="POST" action="voteconf.php">
                    <div class="modal-body">
                    <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Enter Password: </label>
                    <input class="form-control" type="password" name = "password">
                  </div>
                  <input type="hidden" name = "name_v" value = "<?php echo $name?>">
                        <input type="hidden" name="id" id="id_part">
                        <input type="hidden" name="grade" value="<?php echo $grade?>">
                        <input type="hidden" name = "voted_pres" value = "<?php echo $pres?>">
                        <input type="hidden" name = "voted_vice" value = "<?php echo $vice?>">
                        <input type="hidden" name = "voted_sec" value = "<?php echo $sec?>">
                        <input type="hidden" name = "voted_trea" value = "<?php echo $trea?>">
                        <input type="hidden" name = "voted_aud" value = "<?php echo $aud?>">
                        <input type="hidden" name = "voted_pio1" value = "<?php echo $pio1?>">
                        <input type="hidden" name = "voted_pio2" value = "<?php echo $pio2?>">
                        <input type="hidden" name = "voted_pio3" value = "<?php echo $pio3?>">
                        <input type="hidden" name = "voted_pio4" value = "<?php echo $pio4?>">
                        <input type="hidden" name = "voted_po1" value = "<?php echo $po1?>">
                        <input type="hidden" name = "voted_po2" value = "<?php echo $po2?>">
                        <input type="hidden" name = "voted_po3" value = "<?php echo $po3?>">
                        <input type="hidden" name = "voted_representative" value = "<?php echo $rep?>">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="conf">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to open the like modal
    function openLikeModal() {
        // Use jQuery to trigger the modal show event
        $('#likeModal').modal('show');
    }
</script>

        
        
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       <?php
        include("../includes/footer.php");
       ?>
  <?php
    include("../includes/script.php");
  ?>
  <script src="../sweetalert.min.js"></script>

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