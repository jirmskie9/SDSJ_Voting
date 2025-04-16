<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['email'])) {
  header('location: ../login.php');
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

?>

<?php

function checkStatus($conn, $email)
{
  $sql_check_waiting = "SELECT * FROM users WHERE email = '$email' AND status ='Voted'";
  $result_check_waiting = $conn->query($sql_check_waiting);

  if ($result_check_waiting->num_rows > 0) {
    $_SESSION['[status]'] = "You have already Voted!";
    $_SESSION['[status_code]'] = "info";
    $_SESSION['[status_button]'] = "Okay";
    header('Location: index.php');
    exit();
  }
}


checkStatus($conn, $email);
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
            <h1 class="welcome-text" style="color: #387ADF;">Hello, <span
                class="text-black fw-bold"><?php echo $name ?></span></h1>

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
          </li>


        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Vote Now!</h4>
                  <p class="card-description">
                    Select your <code>candidates</code>
                  </p>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <form class="forms-sample" method="POST" action="confirmation.php">
                          <div class="form-group">
                            <input type="hidden" value="<?php echo $name ?>" name="voter">
                            <img src="../assets/icons/president.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">President</label>
                            <select class="form-control" id="president" name="pres">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['pres'] . '">' .
                                  '&#128081; ' . $row['pres'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'President' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'President'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>

                            </select>


                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/vice.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Vice President</label>
                            <select class="form-control" id="" name="vice">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['vice'] . '">' .
                                  '&#128081; ' . $row['vice'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'Vice President' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'Vice President'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/sec.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Secretary</label>
                            <select class="form-control" id="" name="sec">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['sec'] . '">' .
                                  '&#128081; ' . $row['sec'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'Secretary' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'Secretary'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>
                            </select>

                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/trea.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Treasurer</label>
                            <select class="form-control" id="" name="trea">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['trea'] . '">' .
                                  '&#128081; ' . $row['trea'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'Treasurer' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'Treasurer'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/aud.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Auditor</label>
                            <select class="form-control" id="" name="aud">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['aud'] . '">' .
                                  '&#128081; ' . $row['aud'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'Auditor' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'Auditor'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/pio.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Public Information Officer 1</label>
                            <select class="form-control" id="" name="pio1">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates WHERE pio1 IS NOT NULL AND pio1 != ''";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['pio1'] . '">' .
                                  '&#128081; ' . $row['pio1'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'PIO' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'PIO'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>

                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/peace.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Public Information Officer 2</label>

                            <select class="form-control" id="" name="pio2">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates WHERE pio2 IS NOT NULL AND pio2 != ''";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['pio2'] . '">' .
                                  '&#128081; ' . $row['pio2'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'PIO' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'PIO'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>

                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/rep.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Public Information Officer 3</label>

                            <select class="form-control" id="" name="pio3">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates WHERE pio3 IS NOT NULL AND pio3 != ''";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['pio3'] . '">' .
                                  '&#128081; ' . $row['pio3'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'PIO' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'PIO'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/rep.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Public Information Officer 4</label>

                            <select class="form-control" id="" name="pio4">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates WHERE pio4 IS NOT NULL AND pio4 != ''";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['pio4'] . '">' .
                                  '&#128081; ' . $row['pio4'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'PIO' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'PIO'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>

                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/rep.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Peace Officer 1</label>
                            <select class="form-control" id="" name="po1">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates WHERE po1 IS NOT NULL AND po1 != ''";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['po1'] . '">' .
                                  '&#128081; ' . $row['po1'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'PO' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'PO'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>

                            </select>
                          </div>

                          <div class="form-group">
                            <img src="../assets/icons/rep.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Peace Officer 2</label>
                            <select class="form-control" id="" name="po2">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates WHERE po2 IS NOT NULL AND po2 != ''";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['po2'] . '">' .
                                  '&#128081; ' . $row['po2'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'PO' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'PO'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/rep.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Peace Officer 3</label>
                            <select class="form-control" id="" name="po3">
                              <option value="" disabled selected>-- Select Candidate --</option>
                              <?php
                              // Fetch candidates from the 'candidates' table
                              $candidatesQuery = "SELECT * FROM candidates WHERE po3 IS NOT NULL AND po3 != ''";
                              $candidatesResult = mysqli_query($conn, $candidatesQuery);

                              while ($row = mysqli_fetch_assoc($candidatesResult)) {
                                echo '<option class="fw-bold text-primary" value="' . $row['po3'] . '">' .
                                  '&#128081; ' . $row['po3'] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                  '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }

                              // Fetch independent candidates running for 'PO' from the 'candidate' table
                              $independentQuery = "SELECT * FROM candidate WHERE running_for = 'PO'";
                              $independentResult = mysqli_query($conn, $independentQuery);

                              while ($row = mysqli_fetch_assoc($independentResult)) {
                                echo '<option class="fw-bold text-danger" value="' . $row['name'] . '">' .
                                  '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                  '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                  '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                              }
                              ?>

                            </select>
                          </div>
                          <div class="form-group">
                            <img src="../assets/icons/rep.png" alt="Logo" width=30 height=30>
                            <label for="exampleInputUsername1">Representative</label>

                            <?php
                            echo '<select class="form-control" id="position" name="rep" required>
        <option value="" disabled selected class="fw-bold text-muted">-- Select Candidate --</option>';

                            // Fetch candidates from the 'candidates' table
                            $candidatesQuery = "SELECT * FROM candidates";
                            $candidatesResult = mysqli_query($conn, $candidatesQuery);

                            while ($row = mysqli_fetch_assoc($candidatesResult)) {
                              $grade_rep = 'g' . $grade . '_rep';
                              echo '<option class="fw-semibold text-primary" value="' . $row[$grade_rep] . '">' .
                                '&#128081; ' . $row[$grade_rep] . ' (Slogan: <span class="text-secondary">' . $row['slogan'] . '</span>) (' .
                                '<span class="fw-semibold text-success">Partylist: ' . $row['partylist'] . '</span>)' .
                                '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                            }

                            // Fetch independent candidates running for the grade representative position
                            $runningFor = 'Grade ' . $grade . ' Representative';
                            $independentQuery = "SELECT * FROM candidate WHERE running_for = '$runningFor'";
                            $independentResult = mysqli_query($conn, $independentQuery);

                            while ($row = mysqli_fetch_assoc($independentResult)) {
                              echo '<option class="fw-semibold text-danger" value="' . $row['name'] . '">' .
                                '&#127775; ' . $row['name'] . ' - <span class="text-secondary">' . $row['slogan'] . '</span> (' .
                                '<span class="fw-semibold text-warning">' . $row['partylist'] . '</span>)' .
                                '<br><span class="text-info">Projects: ' . $row['projects'] . '</span></option>';
                            }

                            echo '</select>';
                            ?>



                          </div>
                          <button type="submit" class="btn btn-info me-2" name="conf">Proceed</button>


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