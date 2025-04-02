<?php
include("../includes/header.php");
?>
<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['email'])) {
  header('location: ../login.php');
  exit();
}
?>

<?php

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
          <a class="" href="edit.php">
            <img class="img-fluid" src="../assets/logos.png" alt="logo" width=80 height=80 />
          </a>

        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text" style="color: #387ADF;">Hello, <span class="text-black fw-bold">Admin</span></h1>

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
                <div class="profile"><img src="../assets/images/faces/face1.jpg" alt="image"><span
                    class="online"></span>
                </div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../assets/images/faces/face2.jpg" alt="image"><span
                    class="offline"></span>
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
                <div class="profile"><img src="../assets/images/faces/face3.jpg" alt="image"><span
                    class="online"></span>
                </div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../assets/images/faces/face4.jpg" alt="image"><span
                    class="offline"></span>
                </div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../assets/images/faces/face5.jpg" alt="image"><span
                    class="online"></span>
                </div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../assets/images/faces/face6.jpg" alt="image"><span
                    class="online"></span>
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
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="partylist.php">Partylist</a>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="independent.php" aria-expanded="false"
              aria-controls="charts">
              <i class="menu-icon mdi mdi-account-settings"></i>
              <span class="menu-title">Independent</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="independent.php">Independent</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="logout.php" aria-expanded="false"
              aria-controls="charts">
              <i class="menu-icon mdi mdi-account-off"></i>
              <span class="menu-title">Logout</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="logout.php">Independent</a></li>
              </ul>
            </div>
          </li>


        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <?php
            $encoded_can_id = $_GET['id'];

            $id = base64_decode($encoded_can_id);

            if ($id) {
              $selectSql = "SELECT * FROM candidates WHERE can_id = $id";
              $result = mysqli_query($conn, $selectSql);

              if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $partylist = $row['partylist'];
                $slogan = $row['slogan'];
                $pres = $row['pres'];
                $vice = $row['vice'];
                $sec = $row['sec'];
                $trea = $row['trea'];
                $aud = $row['aud'];
                $pio1 = $row['pio1'];
                $pio2 = $row['pio2'];
                $pio3 = $row['pio3'];
                $pio4 = $row['pio4'];
                $po1 = $row['po1'];
                $po2 = $row['po2'];
                $po3 = $row['po3'];
                $g7 = $row['g7_rep'];
                $g8 = $row['g8_rep'];
                $g9 = $row['g9_rep'];
                $g10 = $row['g10_rep'];
                $g11 = $row['g11_rep'];
                $g12 = $row['g12_rep'];
              }

            }
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Partylist</h4>
                  <p class="card-description">
                    Enter valid data
                  </p>
                  <form class="forms-sample" method="POST" action="update.php">
                    <div class="form-group">
                      <input type="hidden" value="<?php echo $id ?>" name="partid">
                      <img src="../assets/images/diversity.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Partylist</label>
                      <input class="form-control" type="text" name="plist" placeholder="Partylist Name"
                        value="<?php echo $partylist ?>" required>
                    </div>
                    <div class="form-group">

                      <label for="" style="color: blue;">Slogan</label>
                      <textarea name="slogan" id="" class="form-control" style="height: 50px;"><?php echo $slogan?></textarea>
                    </div>
                    <div class="form-group">

                      <img src="../assets/images/president.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">President</label>
                      <input class="form-control" type="text" name="pres" placeholder="President"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $pres ?>" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/vice.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Vice President</label>
                      <input class="form-control" type="text" name="vice" placeholder="Vice President"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $vice ?>" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/sec.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Secretary</label>
                      <input class="form-control" type="text" name="sec" placeholder="Secretary"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $sec ?>" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/treasure.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Treasurer</label>
                      <input class="form-control" type="text" name="trea" placeholder="Treasuser"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $trea ?>" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/auditor.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Auditor</label>
                      <input class="form-control" type="text" name="aud" placeholder="Auditor"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $aud ?>" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/public.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Public Information Officers</label>
                      <input class="form-control" type="text" name="pio1" placeholder="Public Information Officer 1"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $pio1 ?>" required>
                      <br>
                      <input class="form-control" type="text" name="pio2" placeholder="Public Information Officer 2"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $pio2 ?>" required>
                      <br>
                      <input class="form-control" type="text" name="pio3" placeholder="Public Information Officer 3"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $pio3 ?>" required>
                      <br>
                      <input class="form-control" type="text" name="pio4" placeholder="Public Information Officer 4"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $pio4 ?>" required>

                    </div>
                    <div class="form-group">
                      <img src="../assets/images/peace.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Peace Officers</label>

                      <input class="form-control" type="text" name="po1" placeholder="Peace Officers 1"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $po1 ?>" required>
                      <br>
                      <input class="form-control" type="text" name="po2" placeholder="Peace Officers 2"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $po2 ?>" required>
                      <br>
                      <input class="form-control" type="text" name="po3" placeholder="Peace Officers 3"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $po3 ?>" required>

                    </div>
                    <div class="form-group">
                      <img src="../assets/images/rep.png" alt="Candidates" width="30" height="30">
                      <label for="" style="color: blue;">Year Representatives</label>

                      <input class="form-control" type="text" name="g7" placeholder="Grade 7 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $g7 ?>" required>
                      <br>
                      <label for="" style="color: blue;">Grade 8</label>
                      <input class="form-control" type="text" name="g8" placeholder="Grade 8 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $g8 ?>" required>
                      <br>
                      <label for="" style="color: blue;">Grade 9</label>
                      <input class="form-control" type="text" name="g9" placeholder="Grade 9 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $g9 ?>" required>
                      <br>
                      <label for="" style="color: blue;">Grade 10</label>
                      <input class="form-control" type="text" name="g10" placeholder="Grade 10 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $g10 ?>" required>
                      <br>
                      <label for="" style="color: blue;">Grade 11</label>
                      <input class="form-control" type="text" name="g11" placeholder="Grade 11 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $g11 ?>" required>
                      <br>
                      <label for="" style="color: blue;">Grade 12</label>
                      <input class="form-control" type="text" name="g12" placeholder="Grade 12 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name"
                        value="<?php echo $g12 ?>" required>
                    </div>



                    <button type="submit" class="btn btn-primary me-2 btn-sm" name="filec">Save Changes</button>
                    <a href="partylist.php" class="btn btn-light btn-sm">Cancel</a>
                  </form>
                  <br>
                  <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#likeModal">Delete</button>

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
                  <h12>Do you want to delete this Partylist?</h12>
                  <button type="button" class="close" data-dismiss="modal" style="border: none; background: none;">
                    <img src="../assets/logo.png" alt="Close" width="30" height="30">
                  </button>

                </div>
                <form method="POST" action="delete.php">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Enter PIN: </label>
                      <input class="form-control" type="password" name="pin">
                    </div>
                    <input type="hidden" name="id" id="id_part">
                    <input type="hidden" name="plist" value="<?php echo $partylist ?>">
                    <input type="hidden" name="part_id" value="<?php echo $id ?>">

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="delete">Confirm</button>
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