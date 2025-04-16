<?php
include("../includes/header.php");
include("../get_student/line.php");
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
if (isset($_POST['export_csv'])) {
  // Clear any existing output buffer to prevent header issues
  ob_end_clean();

  // Set the headers for the CSV download
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="exported_data.csv"');

  // Open the output stream
  $output = fopen('php://output', 'w');

  // Query 1: Export data from "candidate" table
  $query_candidate = "SELECT * FROM candidate";
  $result_candidate = mysqli_query($conn, $query_candidate);

  if ($result_candidate) {
    // Add a section title for "Candidate"
    fputcsv($output, ['Candidate Data']);
    // Add the header row
    fputcsv($output, ['ID', 'Name', 'Position', 'Date & Time Added']);
    // Fetch and write rows
    while ($row = mysqli_fetch_assoc($result_candidate)) {
      fputcsv($output, [
        $row['id'],
        $row['name'],
        $row['running_for'],
        $row['date_time']
      ]);
    }
    // Add a blank row for separation
    fputcsv($output, []);
  } else {
    fputcsv($output, ['Error fetching candidate data.']);
  }

  // Query 2: Export data from "candidates" table
  $query_candidates = "SELECT * FROM candidates";
  $result_candidates = mysqli_query($conn, $query_candidates);

  if ($result_candidates) {
    // Add a section title for "Candidates"
    fputcsv($output, ['Candidates Data']);
    // Add the header row
    fputcsv($output, ['ID', 'Partylist', 'Date & Time Added']);
    // Fetch and write rows
    while ($row = mysqli_fetch_assoc($result_candidates)) {
      fputcsv($output, [
        $row['can_id'],
        $row['partylist'],
        $row['date_time']
      ]);
    }
    // Add a blank row for separation
    fputcsv($output, []);
  } else {
    fputcsv($output, ['Error fetching candidates data.']);
  }

  // Query 3: Export data from "users" table
  $query_users = "SELECT * FROM users WHERE u_type != 'Admin' AND confirmation = 'Complete'";
  $result_users = mysqli_query($conn, $query_users);

  if ($result_users) {
    // Add a section title for "Users"
    fputcsv($output, ['Users Data']);
    // Add the header row
    fputcsv($output, ['User ID', 'Name', 'Email', 'User Type', 'Date Confirmed']);
    // Fetch and write rows
    while ($row = mysqli_fetch_assoc($result_users)) {
      fputcsv($output, [
        $row['user_id'],
        $row['name'],
        $row['email'],
        $row['u_type'],
        $row['confirmation_date'] ?? 'N/A'
      ]);
    }
  } else {
    fputcsv($output, ['Error fetching users data.']);
  }

  // Close the output stream
  fclose($output);

  // End the script to prevent additional output
  exit;
}
?>

<?php
// Function to get the current readable date
function getCurrentDate()
{
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
          <a class="" href="admin.php">
            <img class="img-fluid" src="../assets/logos.png" alt="logo" width=80 height=80 />
          </a>


        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text" style="color: #387ADF;">HELLO, <span class="text-black fw-bold">ADMIN</span></h1>

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
            <a class="nav-link" href="admin.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="backup.php">
              <i class="mdi mdi-cloud-upload menu-icon"></i>
              <span class="menu-title">Back up Database</span>
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
            <a class="nav-link" data-bs-toggle="collapse" href="independent.php" aria-expanded="false"
              aria-controls="charts">
              <i class="menu-icon mdi mdi-account-settings"></i>
              <span class="menu-title">Independent</span>
              <i class="menu-arrow"></i>
            </a>

          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="registered.php" aria-expanded="false"
              aria-controls="charts">
              <i class="menu-icon mdi mdi-account-plus"></i>
              <span class="menu-title">Registered Voters</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="enrolled_students.php" aria-expanded="false"
              aria-controls="charts">
              <i class="menu-icon mdi mdi-school"></i>
              <span class="menu-title">Enrolled Students</span>
              <i class="menu-arrow"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="logout.php" aria-expanded="false"
              aria-controls="charts">
              <i class="menu-icon mdi mdi-account-off"></i>
              <span class="menu-title">Logout</span>
              <i class="menu-arrow"></i>
            </a>

          </li>


        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab"
                        aria-controls="overview" aria-selected="true">Overview</a>
                    </li>

                  </ul>
                  <div>

                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-sm-12">

                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div class="stat-card bg-gradient-primary text-white rounded-lg p-4 shadow-lg border-0">
                            <?php
                            $query = "SELECT COUNT(*) AS registered FROM users WHERE confirmation = 'Complete'";
                            $result = $conn->query($query);

                            if ($result) {
                              $row = $result->fetch_assoc();
                              $total_reg = $row['registered'];
                            } else {
                              echo "Error executing query: " . $conn->error;
                            }
                            ?>
                            <div class="d-flex align-items-center">
                              <div class="stat-icon bg-white text-primary rounded-circle p-3 me-3 shadow-sm">
                                <i class="mdi mdi-account-multiple fs-1"></i>
                              </div>
                              <div>
                                <p class="statistics-title mb-1 fw-light text-white">Registered Voters</p>
                                <h3 class="rate-percentage mb-0 fw-bold text-white"><?php echo $total_reg ?></h3>
                                <p class="text-white-50 d-flex align-items-center mt-1">
                                  <i class="mdi mdi-calendar me-1"></i>
                                  <span id='span1' class="text-white-50"><?php echo getCurrentDate(); ?></span>
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="stat-card bg-gradient-primary text-white rounded-lg p-4 shadow-lg border-0">
                            <?php
                            $query = "SELECT COUNT(*) AS part FROM candidates";
                            $result = $conn->query($query);

                            if ($result) {
                              $row = $result->fetch_assoc();
                              $total_part = $row['part'];
                            } else {
                              echo "Error executing query: " . $conn->error;
                            }
                            ?>
                            <div class="d-flex align-items-center">
                              <div class="stat-icon bg-white text-success rounded-circle p-3 me-3 shadow-sm">
                                <i class="mdi mdi-account-group fs-1"></i>
                              </div>
                              <div>
                                <p class="statistics-title mb-1 fw-light text-white">Partylist</p>
                                <h3 class="rate-percentage mb-0 fw-bold text-white"><?php echo $total_part ?></h3>
                                <p class="text-white-50 d-flex align-items-center mt-1">
                                  <i class="mdi mdi-calendar me-1"></i>
                                  <span id='span1' class="text-white-50"><?php echo getCurrentDate(); ?></span>
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="stat-card bg-gradient-warning text-white rounded-lg p-4 shadow-lg border-0">
                            <?php
                            $query = "SELECT COUNT(*) AS tovote FROM users WHERE status = 'To Vote' AND confirmation = 'Complete' AND u_type != 'Admin'";
                            $result = $conn->query($query);

                            if ($result) {
                              $row = $result->fetch_assoc();
                              $total_tovote = $row['tovote'];
                            } else {
                              echo "Error executing query: " . $conn->error;
                            }
                            ?>
                            <div class="d-flex align-items-center">
                              <div class="stat-icon bg-white text-warning rounded-circle p-3 me-3 shadow-sm">
                                <i class="mdi mdi-vote fs-1"></i>
                              </div>
                              <div>
                                <p class="statistics-title mb-1 fw-light text-white">To Vote</p>
                                <h3 class="rate-percentage mb-0 fw-bold text-white"><?php echo $total_tovote ?></h3>
                                <p class="text-white-50 d-flex align-items-center mt-1">
                                  <i class="mdi mdi-calendar me-1"></i>
                                  <span id='span1' class="text-white-50"><?php echo getCurrentDate(); ?></span>
                                </p>
                              </div>
                            </div>
                          </div>
                          <div
                            class="stat-card bg-gradient-info text-white rounded-lg p-4 shadow-lg border-0 d-none d-md-block">
                            <?php
                            $query = "SELECT * FROM signal_db";
                            $result = $conn->query($query);

                            if ($result) {
                              $row = $result->fetch_assoc();
                              $signal = $row['description'];
                              $class = ($signal == 'Started') ? 'text-success' : 'text-danger';
                              $icon = ($signal == 'Started') ? 'mdi-check-circle' : 'mdi-close-circle';
                            } else {
                              echo "Error executing query: " . $conn->error;
                            }
                            ?>
                            <div class="d-flex align-items-center">
                              <div class="stat-icon bg-white text-info rounded-circle p-3 me-3 shadow-sm">
                                <i class="mdi <?php echo $icon; ?> fs-1"></i>
                              </div>
                              <div>
                                <p class="statistics-title mb-1 fw-light text-white">Voting Signal</p>
                                <h3 class="rate-percentage mb-0 fw-bold text-white"><?php echo $signal ?></h3>
                                <p class="text-white-50 d-flex align-items-center mt-1">
                                  <i class="mdi mdi-calendar me-1"></i>
                                  <span id='span1' class="text-white-50"><?php echo getCurrentDate(); ?></span>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <?php


                        $query = "SELECT COUNT(*) AS pending FROM users WHERE confirmation = 'Verified'";
                        $result = $conn->query($query);

                        if ($result) {
                          $row = $result->fetch_assoc();
                          $total_pending = $row['pending'];

                        } else {
                          echo "Error executing query: " . $conn->error;
                        }


                        ?>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   
                                  
                                    </p>
                                  </div>
                                </div>

                                <div class="d-flex justify-content-start mt-3 mb-3">
                                  <button class="btn btn-success btn-lg text-white me-2" type="button"
                                    data-toggle="modal" data-target="#likeModal">
                                    <i class="mdi mdi-play-circle me-1"></i> Start Voting Session
                                  </button>
                                  <button class="btn btn-danger btn-lg text-white" type="button" data-toggle="modal"
                                    data-target="#endModal">
                                    <i class="mdi mdi-stop-circle me-1"></i> End Voting
                                  </button>
                                </div>

                                
                                <div class="row mt-4">
                                  <div class="col-12">
                                    <div class="card card-rounded">
                                      <div class="card-body">
                                        <div class="d-sm-flex justify-content-between align-items-start">
                                          <div>
                                            <h4 class="card-title card-title-dash">Vote Ranking Overview</h4>
                                            <p class="card-subtitle card-subtitle-dash">Visual representation of votes
                                              across all positions</p>
                                          </div>
                                          <div>
                                          
                                          </div>
                                        </div>
                                        <div class="position-tabs">
                                          <button class="tab-button active" data-position="President">President</button>
                                          <button class="tab-button" data-position="Vice President">Vice
                                            President</button>
                                          <button class="tab-button" data-position="Secretary">Secretary</button>
                                          <button class="tab-button" data-position="Treasurer">Treasurer</button>
                                          <button class="tab-button" data-position="Auditor">Auditor</button>
                                          <button class="tab-button"
                                            data-position="Public Information Officer">PIO</button>
                                          <button class="tab-button" data-position="Peace Officer">Peace
                                            Officer</button>
                                          <button class="tab-button" data-position="Grade 7 Representative">Grade
                                            7</button>
                                          <button class="tab-button" data-position="Grade 8 Representative">Grade
                                            8</button>
                                          <button class="tab-button" data-position="Grade 9 Representative">Grade
                                            9</button>
                                          <button class="tab-button" data-position="Grade 10 Representative">Grade
                                            10</button>
                                          <button class="tab-button" data-position="Grade 11 Representative">Grade
                                            11</button>
                                          <button class="tab-button" data-position="Grade 12 Representative">Grade
                                            12</button>
                                        </div>

                                        <style>
                                          .position-tabs {
                                            display: flex;
                                            flex-wrap: wrap;
                                            gap: 8px;
                                            margin-bottom: 20px;
                                          }

                                          .tab-button {
                                            padding: 8px 16px;
                                            background-color: #f8f9fa;
                                            border: 1px solid #dee2e6;
                                            border-radius: 4px;
                                            cursor: pointer;
                                            transition: all 0.3s ease;
                                            font-size: 14px;
                                          }

                                          .tab-button:hover {
                                            background-color: #e9ecef;
                                          }

                                          .tab-button.active {
                                            background-color: #387ADF;
                                            color: white;
                                            border-color: #387ADF;
                                          }

                                          .chart-container {
                                            height: 400px;
                                            margin-top: 20px;
                                            background-color: #fff;
                                            border-radius: 8px;
                                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                                            padding: 20px;
                                          }

                                          .chart-header {
                                            margin-bottom: 15px;
                                          }

                                          .chart-icon {
                                            width: 60px;
                                            height: 60px;
                                            object-fit: contain;
                                            margin-bottom: 10px;
                                          }
                                          
                                          .dashboard-card {
                                            background-color: #fff;
                                            border-radius: 8px;
                                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                                            padding: 20px;
                                            margin-bottom: 20px;
                                            transition: transform 0.3s ease, box-shadow 0.3s ease;
                                          }
                                          
                                          .dashboard-card:hover {
                                            transform: translateY(-5px);
                                            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                                          }
                                          
                                          .dashboard-card-title {
                                            font-size: 18px;
                                            font-weight: 600;
                                            margin-bottom: 15px;
                                            color: #333;
                                          }
                                          
                                          .dashboard-card-subtitle {
                                            font-size: 14px;
                                            color: #6c757d;
                                            margin-bottom: 20px;
                                          }
                                          
                                          .stat-card {
                                            background: linear-gradient(135deg, #387ADF 0%, #2c5aa0 100%);
                                            color: white;
                                            border-radius: 8px;
                                            padding: 20px;
                                            margin-bottom: 20px;
                                            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                                          }
                                          
                                          .stat-card h3 {
                                            font-size: 28px;
                                            font-weight: 700;
                                            margin-bottom: 5px;
                                          }
                                          
                                          .stat-card p {
                                            font-size: 14px;
                                            opacity: 0.8;
                                            margin-bottom: 0;
                                          }
                                          
                                          .stat-icon {
                                            font-size: 24px;
                                            margin-right: 10px;
                                          }
                                          
                                          .table-container {
                                            background-color: #fff;
                                            border-radius: 8px;
                                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                                            padding: 20px;
                                            margin-bottom: 20px;
                                          }
                                          
                                          .table {
                                            margin-bottom: 0;
                                          }
                                          
                                          .table thead th {
                                            background-color: #f8f9fa;
                                            border-bottom: 2px solid #dee2e6;
                                            font-weight: 600;
                                            color: #495057;
                                          }
                                          
                                          .table tbody tr:hover {
                                            background-color: #f8f9fa;
                                          }
                                          
                                          .btn-primary {
                                            background-color: #387ADF;
                                            border-color: #387ADF;
                                          }
                                          
                                          .btn-primary:hover {
                                            background-color: #2c5aa0;
                                            border-color: #2c5aa0;
                                          }
                                          
                                          .btn-success {
                                            background-color: #28a745;
                                            border-color: #28a745;
                                          }
                                          
                                          .btn-success:hover {
                                            background-color: #218838;
                                            border-color: #218838;
                                          }
                                          
                                          .btn-danger {
                                            background-color: #dc3545;
                                            border-color: #dc3545;
                                          }
                                          
                                          .btn-danger:hover {
                                            background-color: #c82333;
                                            border-color: #c82333;
                                          }
                                        </style>

                                        <div class="chart-container">
                                          <canvas id="voteRankingChart"></canvas>
                                        </div>

                                        <div class="chart-container mt-4">
                                          <div class="d-sm-flex justify-content-between align-items-start">
                                            <div>
                                              <h4 class="card-title card-title-dash">Voting Status Overview</h4>
                                              <p class="card-subtitle card-subtitle-dash">Distribution of voting participation</p>
                                            </div>
                                            <div>
                                             
                                            </div>
                                          </div>
                                          <canvas id="votingStatusChart"></canvas>
                                        </div>

                                      </div>
                                    </div>
                                  </div>
                                </div>


                              </div>
                            </div>
                          </div>
                        </div>
                        <form method="post">
                          <button type="submit" name="export_csv" class="btn btn-secondary">Export Data</button>
                        </form>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">

                            </div>
                          </div>
                        </div>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">President Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="pres" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'President' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/president.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Vice President Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="vice" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Vice President' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/vice.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Secretary Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="sec" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Secretary' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/sec.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Treasurer Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="trea" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Treasurer' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/trea.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Auditor Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="aud" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Auditor' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/aud.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Public Information Officer Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="pio" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Public Information Officer' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/pio.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Peace Officer Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="po" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Peace Officer' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/po.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Grade 7 Representative Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="g7" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Grade 7 Representative' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/g7.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Grade 8 Representative Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="g8" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Grade 8 Representative' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/g8.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Grade 9 Representative Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="g9" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Grade 9 Representative' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/g9.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Grade 10 Representative Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="g10" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Grade 10 Representative' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/g10.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Grade 11 Representative Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="g11" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Grade 11 Representative' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/g11.php", true);
                                      xhr.send();
                                    }


                                    setInterval(updateData, 5000);
                                  </script>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Grade 12 Representative Ranking</h4>
                                  </div>
                                  <div>

                                  </div>
                                </div>

                                <div class="table-responsive  mt-1">
                                  <table id="g12" class="table select-table">
                                    <thead>
                                      <tr>

                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php

                                      $sql = "SELECT name, position, count FROM vote_counting WHERE position = 'Grade 12 Representative' ORDER BY count DESC";
                                      $result = $conn->query($sql);

                                      if ($result->num_rows > 0) {
                                        $counter = 0; // Counter to track the row
                                        while ($row = $result->fetch_assoc()) {
                                          $counter++;
                                          ?>
                                          <tr>
                                            <td class="w-30">
                                              <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                  <?php
                                                  $imageSource = '';
                                                  switch ($counter) {
                                                    case 1:
                                                      $imageSource = 'img/first.png';
                                                      break;
                                                    case 2:
                                                      $imageSource = 'img/second.png';
                                                      break;
                                                    case 3:
                                                      $imageSource = 'img/third.png';
                                                      break;
                                                    default:
                                                      $imageSource = 'img/ssglogo.png';
                                                      break;
                                                  }
                                                  ?>
                                                  <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30"
                                                    height="30">
                                                </div>
                                                <div class="ms-4">
                                                  <p class="text-xs font-weight-bold mb-0">Name:</p>
                                                  <h6 class="text-sm mb-0"><?php echo $row['name']; ?></h6>
                                                </div>
                                              </div>
                                            </td>

                                            <td>
                                              <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Current Votes:</p>
                                                <h6 class="text-sm mb-0"><?php echo $row['count']; ?></h6>
                                              </div>
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
                                      xhr.open("GET", "../get/g12.php", true);
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
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">




                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4 class="card-title card-title-dash">Activities</h4>
                                    <p class="mb-0">Recent</p>
                                  </div>
                                  <ul class="bullet-line-list" style="overflow-y: auto; max-height: 200px;">
                                    <?php
                                    $sql2 = "SELECT * FROM activity_log ORDER BY activity_id DESC";
                                    $result2 = $conn->query($sql2);

                                    if ($result2->num_rows > 0) {
                                      while ($row = $result2->fetch_assoc()) {
                                        $formattedDateTime = date('F j, Y - g:i A', strtotime($row['date_time']));
                                        echo '<li>
                                                    <div class="d-flex justify-content-between">
                                                      <div><span class="text-light-green">' . $row['action'] . '</div>
                                                      <p>' . $formattedDateTime . '</p>
                                                    </div>
                                                  </li>';
                                      }
                                    } else {
                                      echo "<li>No records found</li>";
                                    }
                                    ?>
                                  </ul>

                                  <div class="list align-items-center pt-3">
                                    <div class="wrapper w-100">
                                      <p class="mb-0">
                                        <a href="#" class="fw-bold text-primary">Show all <i
                                            class="mdi mdi-arrow-right ms-2"></i></a>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4 class="card-title card-title-dash">Audit Log</h4>
                                    <p class="mb-0">Recent Student Logged in</p>
                                  </div>
                                  <ul class="bullet-line-list" style="overflow-y: auto; max-height: 200px;">
                                    <?php
                                    $sql2 = "SELECT * FROM audit_log ORDER BY id DESC";
                                    $result2 = $conn->query($sql2);

                                    if ($result2->num_rows > 0) {
                                      while ($row = $result2->fetch_assoc()) {
                                        $formattedDateTime = date('F j, Y - g:i A', strtotime($row['date_time']));
                                        echo '<li>
                                                  <div class="d-flex justify-content-between">
                                                    <div><span class="text-light-green">' . $row['name'] . '</div>
                                                    <p>' . $formattedDateTime . '</p>
                                          </div>
                                                </li>';
                                      }
                                    } else {
                                      echo "<li>No records found</li>";
                                    }
                                    ?>
                                  </ul>

                                  <div class="list align-items-center pt-3">
                                    <div class="wrapper w-100">
                                      <p class="mb-0">
                                        <a href="#" class="fw-bold text-primary">Show all <i
                                            class="mdi mdi-arrow-right ms-2"></i></a>
                                      </p>
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
                </div>
              </div>
            </div>
          </div>

          <div class="bootstrap-modal">
            <div class="modal fade" id="likeModal">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h12>Start Voting?</h12>
                    <button type="button" class="close" data-dismiss="modal" style="border: none; background: none;">
                      <img src="../assets/logos.png" alt="Close" width="30" height="30" class="img-fluid">
                    </button>

                  </div>
                  <form method="POST" action="start_voting.php">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Enter PIN: </label>
                        <input class="form-control" type="password" name="pin">
                      </div>
                      <input type="hidden" name="id" id="id_part">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="conf">Confirm</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="bootstrap-modal">
            <div class="modal fade" id="endModal">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h12>Do you want to end the voting session?</h12>
                    <button type="button" class="close" data-dismiss="modal" style="border: none; background: none;">
                      <img src="../assets/logos.png" alt="Close" width="30" height="30">
                    </button>
                  </div>
                  <form method="POST" action="stop_voting.php">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Enter PIN:</label>
                        <input class="form-control" type="password" name="pin">
                      </div>
                      <input type="hidden" name="id" id="id_part">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="conf">Confirm</button>
                    </div>
                  </form>
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

            <script>
              function updateChart(data) {
                console.log('Updating chart...');
                const canvas = document.getElementById('voteRankingChart');
                if (!canvas) {
                  console.error('Canvas element not found!');
                  return;
                }

                const ctx = canvas.getContext('2d');
                if (window.voteRankingChart) {
                  console.log('Destroying existing chart');
                  window.voteRankingChart.destroy();
                }

                // Extract labels (Candidate Names) and positions
                const candidates = data.map(item => `${item.name} (${item.position})`);
                const votes = data.map(item => item.count);

                const backgroundColors = candidates.map(() => {
                  return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.7)`;
                });

                try {
                  window.voteRankingChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: candidates,
                      datasets: [{
                        label: 'Votes',
                        data: votes,
                        backgroundColor: backgroundColors,
                        borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                        borderWidth: 1
                      }]
                    },
                    options: {
                      responsive: true,
                      maintainAspectRatio: false,
                      scales: {
                        x: {
                          title: {
                            display: true,
                            text: 'Candidate'
                          }
                        },
                        y: {
                          beginAtZero: true,
                          title: {
                            display: true,
                            text: 'Votes'
                          }
                        }
                      },
                      plugins: {
                        title: {
                          display: true,
                          text: 'Vote Count Per Candidate',
                          font: {
                            size: 16
                          }
                        },
                        legend: {
                          display: false
                        },
                        tooltip: {
                          callbacks: {
                            title: function (context) {
                              const index = context[0].dataIndex;
                              return candidates[index];
                            },
                            label: function (context) {
                              return `Votes: ${context.raw}`;
                            }
                          }
                        }
                      }
                    }
                  });
                  console.log('Chart created successfully');
                } catch (error) {
                  console.error('Error creating chart:', error);
                  canvas.parentNode.innerHTML =
                    '<div class="alert alert-danger">Error creating chart: ' + error.message + '</div>';
                }
              }

            </script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                console.log('DOM loaded, initializing chart...');

                // Check if Chart.js is loaded
                if (typeof Chart === 'undefined') {
                  console.error('Chart.js is not loaded!');
                  document.querySelector('.chart-container').innerHTML = '<div class="alert alert-danger">Error: Chart.js library not loaded</div>';
                  return;
                }

                let voteRankingChart = null;
                const canvas = document.getElementById('voteRankingChart');
                let allVoteData = []; // Store all vote data
                let currentPosition = 'President'; // Default position

                if (!canvas) {
                  console.error('Canvas element not found!');
                  return;
                }

                function fetchVoteData() {
                  console.log('Fetching vote data...');
                  fetch('vote_data.php')
                    .then(response => {
                      if (!response.ok) {
                        throw new Error('Network response was not ok');
                      }
                      return response.json();
                    })
                    .then(data => {
                      console.log('Received data:', data);
                      if (data && data.length > 0) {
                        allVoteData = data; // Store all data
                        filterAndUpdateChart(currentPosition); // Filter and update chart with current position
                      } else {
                        console.log('No data received');
                        canvas.parentNode.innerHTML = '<div class="alert alert-info">No voting data available yet</div>';
                      }
                    })
                    .catch(error => {
                      console.error('Error fetching data:', error);
                      canvas.parentNode.innerHTML = '<div class="alert alert-danger">Error loading vote data: ' + error.message + '</div>';
                    });
                }

                function filterAndUpdateChart(position) {
                  console.log('Filtering data for position:', position);
                  const filteredData = allVoteData.filter(item => item.position === position);
                  console.log('Filtered data:', filteredData);

                  if (filteredData.length > 0) {
                    updateChart(filteredData);
                  } else {
                    canvas.parentNode.innerHTML = '<div class="alert alert-info">No data available for ' + position + '</div>';
                  }
                }

                function updateChart(data) {
                  console.log('Updating chart with data:', data);

                  // Destroy existing chart if it exists
                  if (voteRankingChart) {
                    voteRankingChart.destroy();
                  }

                  // Prepare data for chart
                  const labels = data.map(item => item.name);
                  const votes = data.map(item => item.count);

                  // Generate colors
                  const backgroundColors = labels.map(() =>
                    `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.7)`
                  );

                  // Create new chart
                  try {
                    voteRankingChart = new Chart(canvas, {
                      type: 'bar',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: 'Votes',
                          data: votes,
                          backgroundColor: backgroundColors,
                          borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                          borderWidth: 1
                        }]
                      },
                      options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                          x: {
                            ticks: {
                              maxRotation: 45,
                              minRotation: 45
                            }
                          },
                          y: {
                            beginAtZero: true,
                            ticks: {
                              stepSize: 1
                            }
                          }
                        },
                        plugins: {
                          title: {
                            display: true,
                            text: currentPosition + ' Vote Count',
                            font: {
                              size: 16
                            },
                            padding: {
                              top: 10,
                              bottom: 30
                            }
                          },
                          legend: {
                            display: false
                          },
                          tooltip: {
                            callbacks: {
                              title: function (context) {
                                return context[0].label;
                              },
                              label: function (context) {
                                return `Votes: ${context.raw}`;
                              }
                            }
                          }
                        }
                      }
                    });
                    console.log('Chart created successfully');
                  } catch (error) {
                    console.error('Error creating chart:', error);
                    canvas.parentNode.innerHTML = '<div class="alert alert-danger">Error creating chart: ' + error.message + '</div>';
                  }
                }

                // Set up position tabs
                const tabButtons = document.querySelectorAll('.tab-button');
                tabButtons.forEach(button => {
                  button.addEventListener('click', function () {
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    // Get position from data attribute
                    currentPosition = this.getAttribute('data-position');
                    console.log('Tab clicked:', currentPosition);
                    // Filter and update chart
                    filterAndUpdateChart(currentPosition);
                  });
                });

                // Set up refresh button
                const refreshButton = document.getElementById('refreshChart');
                if (refreshButton) {
                  refreshButton.addEventListener('click', function () {
                    console.log('Refresh button clicked');
                    fetchVoteData();
                  });
                }

                // Initial data fetch
                fetchVoteData();

                // Auto-refresh every 30 seconds
                setInterval(fetchVoteData, 30000);
              });
            </script>

            <script>
            // ... existing code ...

            // Add this after the existing chart initialization code
            function initVotingStatusChart() {
              const statusCanvas = document.getElementById('votingStatusChart');
              if (!statusCanvas) {
                console.error('Voting status canvas not found');
                return;
              }

              let votingStatusChart = null;

              function updateVotingStatusChart() {
                fetch('../get/voting_status.php')
                  .then(response => response.json())
                  .then(data => {
                    if (votingStatusChart) {
                      votingStatusChart.destroy();
                    }

                    const total = data.to_vote + data.voted;
                    const toVotePercentage = Math.round((data.to_vote / total) * 100);
                    const votedPercentage = Math.round((data.voted / total) * 100);

                    votingStatusChart = new Chart(statusCanvas, {
                      type: 'doughnut',
                      data: {
                        labels: ['To Vote', 'Voted'],
                        datasets: [{
                          data: [data.to_vote, data.voted],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',  // Red for To Vote
                            'rgba(75, 192, 192, 0.8)'   // Green for Voted
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)'
                          ],
                          borderWidth: 2,
                          hoverOffset: 10
                        }]
                      },
                      options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '60%',
                        plugins: {
                          legend: {
                            position: 'bottom',
                            labels: {
                              padding: 20,
                              font: {
                                size: 14,
                                weight: 'bold'
                              },
                              generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                  return data.labels.map((label, i) => {
                                    const value = data.datasets[0].data[i];
                                    const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    
                                    return {
                                      text: `${label}: ${value} (${percentage}%)`,
                                      fillStyle: data.datasets[0].backgroundColor[i],
                                      strokeStyle: data.datasets[0].borderColor[i],
                                      lineWidth: 2,
                                      hidden: false,
                                      index: i
                                    };
                                  });
                                }
                                return [];
                              }
                            }
                          },
                          tooltip: {
                            callbacks: {
                              label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                              }
                            },
                            padding: 12,
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                              size: 14,
                              weight: 'bold'
                            },
                            bodyFont: {
                              size: 13
                            }
                          },
                          title: {
                            display: true,
                            text: 'Voting Participation',
                            font: {
                              size: 16,
                              weight: 'bold'
                            },
                            padding: {
                              top: 10,
                              bottom: 30
                            }
                          }
                        },
                        animation: {
                          animateScale: true,
                          animateRotate: true,
                          duration: 1000
                        }
                      }
                    });
                  })
                  .catch(error => {
                    console.error('Error fetching voting status:', error);
                    statusCanvas.parentNode.innerHTML = '<div class="alert alert-danger">Error loading voting status data</div>';
                  });
              }

              // Initial update
              updateVotingStatusChart();

              // Update every 30 seconds
              setInterval(updateVotingStatusChart, 30000);
              
              // Add refresh button functionality
              const refreshButton = document.getElementById('refreshStatusChart');
              if (refreshButton) {
                refreshButton.addEventListener('click', function() {
                  updateVotingStatusChart();
                });
              }
            }

            // Update the existing chart code to make it more professional
            function updateChart(data) {
              console.log('Updating chart with data:', data);

              // Destroy existing chart if it exists
              if (voteRankingChart) {
                voteRankingChart.destroy();
              }

              // Prepare data for chart
              const labels = data.map(item => item.name);
              const votes = data.map(item => item.count);

              // Generate colors with a more professional palette
              const backgroundColors = [
                'rgba(56, 122, 223, 0.7)',  // Primary blue
                'rgba(40, 167, 69, 0.7)',   // Success green
                'rgba(220, 53, 69, 0.7)',   // Danger red
                'rgba(255, 193, 7, 0.7)',   // Warning yellow
                'rgba(23, 162, 184, 0.7)',  // Info cyan
                'rgba(111, 66, 193, 0.7)',  // Purple
                'rgba(253, 126, 20, 0.7)',  // Orange
                'rgba(108, 117, 125, 0.7)', // Gray
                'rgba(40, 167, 69, 0.7)',   // Green
                'rgba(220, 53, 69, 0.7)',   // Red
                'rgba(255, 193, 7, 0.7)',   // Yellow
                'rgba(23, 162, 184, 0.7)'   // Cyan
              ];

              // Create new chart
              try {
                voteRankingChart = new Chart(canvas, {
                  type: 'bar',
                  data: {
                    labels: labels,
                    datasets: [{
                      label: 'Votes',
                      data: votes,
                      backgroundColor: backgroundColors,
                      borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                      borderWidth: 1,
                      borderRadius: 5,
                      barThickness: 'flex',
                      maxBarThickness: 35
                    }]
                  },
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      x: {
                        ticks: {
                          maxRotation: 45,
                          minRotation: 45,
                          font: {
                            size: 12
                          }
                        },
                        grid: {
                          display: false
                        }
                      },
                      y: {
                        beginAtZero: true,
                        ticks: {
                          stepSize: 1,
                          font: {
                            size: 12
                          }
                        },
                        grid: {
                          color: 'rgba(0, 0, 0, 0.05)'
                        }
                      }
                    },
                    plugins: {
                      title: {
                        display: true,
                        text: currentPosition + ' Vote Count',
                        font: {
                          size: 16,
                          weight: 'bold'
                        },
                        padding: {
                          top: 10,
                          bottom: 30
                        }
                      },
                      legend: {
                        display: false
                      },
                      tooltip: {
                        callbacks: {
                          title: function (context) {
                            return context[0].label;
                          },
                          label: function (context) {
                            return `Votes: ${context.raw}`;
                          }
                        },
                        padding: 12,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                          size: 14,
                          weight: 'bold'
                        },
                        bodyFont: {
                          size: 13
                        }
                      }
                    },
                    animation: {
                      duration: 1000,
                      easing: 'easeInOutQuart'
                    }
                  }
                });
                console.log('Chart created successfully');
              } catch (error) {
                console.error('Error creating chart:', error);
                canvas.parentNode.innerHTML = '<div class="alert alert-danger">Error creating chart: ' + error.message + '</div>';
              }
            }

            // Initialize both charts when the page loads
            document.addEventListener('DOMContentLoaded', function() {
              // ... existing chart initialization code ...
              initVotingStatusChart();
            });
            </script>
</body>

</html>