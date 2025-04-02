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

  }
}

?>

<?php

function checkWaitingStatus($conn)
{
  $sql_check_waiting = "SELECT * FROM signal_db WHERE description = 'Waiting'";
  $result_check_waiting = $conn->query($sql_check_waiting);

  if ($result_check_waiting->num_rows > 0) {
    $_SESSION['[status]'] = "Voting is not started yet!";
    $_SESSION['[status_code]'] = "info";
    $_SESSION['[status_button]'] = "Okay";
    header('Location: ../login.php');
    exit();
  }
}

checkWaitingStatus($conn);
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
            <div class="col-lg- grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Partial Votes</h4>
                  <img src="../assets/icons/president.png" alt="" width=30 height=30>
                  <p class="card-description">
                    President<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="pres" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'President' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("pres").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/president.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Vice President<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="vice" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Vice President' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>
                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("vice").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/vice.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Secretary<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="sec" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Secretary' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("sec").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/sec.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Treasurer<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="trea" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Treasurer' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("trea").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/trea.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Auditor<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="aud" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Auditor' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("aud").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/aud.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    PIO<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="pio" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Public Information Officer' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("pio").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/pio.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>

                  </div>
                  <br>
                  <p class="card-description">
                    P.O<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="po" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Peace Officer' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("po").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/po.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Grade 7 Representative<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="g7" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $sql = "SELECT * FROM vote_counting WHERE position = 'Grade 7 Representative' ORDER BY count DESC";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                            $counter = 0; // Counter to track the row
                            while ($row = $result->fetch_assoc()) {
                              $counter++;
                              ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                            }
                          } else {
                            echo "0 results";
                          }
                          ?>



                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("g7").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/g7.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Grade 8 Representative<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="g8" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Grade 8 Representative' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("g8").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/g8.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Grade 9 Representative<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="g9" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Grade 9 Representative' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("g9").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/g9.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Grade 10 Representative<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="g10" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Grade 10 Representative' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("g10").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/g10.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Grade 11 Representative<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="g11" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Grade 11 Representative' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("g11").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/g11.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
                  </div>
                  <br>
                  <p class="card-description">
                    Grade 12 Representative<code> Ranking</code>
                  </p>
                  <div class="table-responsive">
                    <table id="g12" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Rank.
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Votes
                          </th>

                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        $sql = "SELECT * FROM vote_counting WHERE position = 'Grade 12 Representative' ORDER BY count DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          $counter = 0; // Counter to track the row
                          while ($row = $result->fetch_assoc()) {
                            $counter++;
                            ?>
                            <tr>
                              <td class="py-1">
                                <?php

                                $imageSource = '';
                                switch ($counter) {
                                  case 1:
                                    $imageSource = '../assets/icons/first.png';
                                    break;
                                  case 2:
                                    $imageSource = '../assets/icons/second.png';
                                    break;
                                  case 3:
                                    $imageSource = '../assets/icons/third.png';
                                    break;
                                  default:
                                    $imageSource = '../assets/icons/ssglogo.jpg';
                                    break;
                                }
                                ?>
                                <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
                              </td>
                              <td>
                                <?php echo $row['name']; ?>
                              </td>

                              <td>
                                <?php echo $row['count']; ?>
                              </td>

                            </tr>
                            <?php
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>
                      </tbody>
                    </table>
                    <script>

                      function updateData() {

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                          if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {

                              document.getElementById("g12").innerHTML = xhr.responseText;
                            } else {
                              console.error('Error: ' + xhr.status);
                            }
                          }
                        };
                        xhr.open("GET", "../get_student/g12.php", true);
                        xhr.send();
                      }


                      setInterval(updateData, 5000);
                    </script>
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
        <script>
          $(document).ready(function () {
            $("#loveThisButton").click(function () {
              $("#likeModal").modal('show');
            });
          });
        </script>

</body>

</html>