<?php
session_start();
include('../dbcon.php');
if (!isset($_SESSION['email'])) {
  header('Location: ../login.php');
  exit();
}
?>
<?php
include("../includes/header.php");
?>
<?php
function getCurrentDate() {
    return date("l, F j, Y");
}
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
    <a class="" href="partylist.php">
        <img class = "img-fluid" src="../assets/logo.png" alt="logo" width = 80 height = 80/>
      </a>
   
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text" style = "color: #387ADF;">Hello, <span class="text-black fw-bold">Admin</span></h1>
       
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
      <a class="nav-link" href="admin.php">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <li class="nav-item nav-category">Manage</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="partylist.php" aria-expanded="false"
        aria-controls="form-elements">
        <i class="menu-icon mdi mdi-account-multiple-outline"></i>
        <span class="menu-title">Partylist</span>
        <i class="menu-arrow"></i>
      </a>
     
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="independent.php" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-account-settings"></i>
        <span class="menu-title">Independent</span>
        <i class="menu-arrow"></i>
      </a>
    </li>
     <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="voters.php" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-account-check"></i>
        <span class="menu-title">Registered Voters</span>
        <i class="menu-arrow"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="logout.php" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-account-off"></i>
        <span class="menu-title">Logout</span>
        <i class="menu-arrow"></i>
      </a>
     
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
                  <h4 class="card-title">View Registered Voters</h4>
                  <p class="card-description">
                     <code>Current Date</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>
                           
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                           Grade
                          </th>
                          <th>
                           Status
                          </th>
                          
                        </tr>
                      </thead>
                      <?php

                            $query = "SELECT * FROM users WHERE u_type= 'Voter' AND confirmation = 'Complete'";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tbody>';
                                echo '<tr>';
                                echo '<td class="py-1">';
                                echo '<img src="../assets/images/graduated.png" alt="image" />';
                                echo '</td>';
                                echo '<td><span class="badge bg-primary">' . $row['name'] . '</span></td>';
                                echo '<td>' . $row['grade'] . '</td>';
                                $status = $row['status'];
                                $badge_class = '';

                                if ($status == 'To Vote') {
                                    $badge_class = 'badge bg-danger';
                                } elseif ($status == 'Voted') {
                                    $badge_class = 'badge bg-success';
                                }
                                echo '<td><span class="' . $badge_class . '">' . $status . '</span></td>';
                                echo '</tr>';
                                echo '</tbody>';
                            }

                            ?>

                    </table>
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
                  <h12>Do you want to delete this Candidate?</h12>
                  <button type="button" class="close" data-dismiss="modal" style="border: none; background: none;">
                  <img src="../assets/logo.png" alt="Close" width="30" height="30">
              </button>

                </div>
                <form method="POST" action="deleteind.php">
                    <div class="modal-body">
                    <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Enter PIN: </label>
                    <input class="form-control" type="password" name = "pin">
                  </div>
                        <input type= "hidden" name="id" id="id_part">
                        <input type= "hidden" name="name" id="name_part">
                       
             
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
    $(document).ready(function () {
        $("#loveThisButton").click(function () {
            $("#likeModal").modal('show');
        });
    });
</script>
<script>
    function setModalData(id, name) {
        $("#id_part").val(id);
        $("#name_part").val(name);
        $("#likeModal").modal('show');
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
<script>
  
  var timeoutDuration = 60000;


  var timeoutTimer;


  function resetTimer() {
    clearTimeout(timeoutTimer);
    timeoutTimer = setTimeout(logout, timeoutDuration);
  }

  
  function logout() {
    window.location.href = 'directing.php';
  }

  document.addEventListener('mousemove', resetTimer);
  document.addEventListener('keydown', resetTimer);

  // Initialize the timer on page load
  resetTimer();
</script>
</body>

</html>