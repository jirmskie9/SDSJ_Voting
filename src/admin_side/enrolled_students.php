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

// Handle Excel/CSV file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
  $file = $_FILES['excel_file'];
  $allowed_types = ['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if (!in_array($file['type'], $allowed_types)) {
    $_SESSION['[status]'] = "Please upload a valid Excel or CSV file.";
    $_SESSION['[status_code]'] = "error";
    $_SESSION['[status_button]'] = "OK";
  } else {
    try {
      $handle = fopen($file['tmp_name'], "r");
      
      // Skip header row
      fgetcsv($handle);
      
      $success_count = 0;
      $update_count = 0;
      $error_count = 0;
      
      while (($data = fgetcsv($handle)) !== FALSE) {
        if (count($data) >= 3) {
          $lrn = mysqli_real_escape_string($conn, $data[0]);
          $name = mysqli_real_escape_string($conn, $data[1]);
          $year_level = mysqli_real_escape_string($conn, $data[2]);
          
          // Check if LRN already exists
          $check_query = "SELECT student_id FROM students WHERE lrn = '$lrn'";
          $check_result = mysqli_query($conn, $check_query);
          
          if (mysqli_num_rows($check_result) > 0) {
            // Update existing record
            $update_query = "UPDATE students SET name = '$name', year_level = '$year_level' WHERE lrn = '$lrn'";
            if (mysqli_query($conn, $update_query)) {
              $update_count++;
            } else {
              $error_count++;
            }
          } else {
            // Insert new record
            $insert_query = "INSERT INTO students (lrn, name, year_level) VALUES ('$lrn', '$name', '$year_level')";
            if (mysqli_query($conn, $insert_query)) {
              $success_count++;
            } else {
              $error_count++;
            }
          }
        }
      }
      
      fclose($handle);
      
      $_SESSION['[status]'] = "Successfully imported $success_count new students. Updated $update_count existing students. Failed to process $error_count records.";
      $_SESSION['[status_code]'] = "success";
      $_SESSION['[status_button]'] = "OK";
    } catch (Exception $e) {
      $_SESSION['[status]'] = "Error processing file: " . $e->getMessage();
      $_SESSION['[status_code]'] = "error";
      $_SESSION['[status_button]'] = "OK";
    }
  }
  
  header("Location: enrolled_students.php");
  exit();
}

// Get all students
$query = "SELECT * FROM students ORDER BY lrn ASC";
$result = mysqli_query($conn, $query);
$students = [];
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
  }
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
            <!-- Excel/CSV Upload Form -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                  <h4 class="card-title mb-0">
                    <i class="mdi mdi-upload text-primary me-2"></i>Import Students from Excel/CSV
                  </h4>
                </div>
                <div class="card-body">
                  <p class="card-description text-muted">
                    Upload an Excel or CSV file with student data. The file should have the following columns: LRN, Name, Year Level.
                    <br>
                    <strong>Note:</strong> If a student with the same LRN already exists, their information will be updated.
                  </p>
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="excel_file" class="form-label">Select Excel or CSV File</label>
                      <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xls,.xlsx,.csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                      <i class="mdi mdi-upload me-1"></i> Import Students
                    </button>
                  </form>
                </div>
              </div>
            </div>

            <!-- Students Table -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                  <h4 class="card-title mb-0">
                    <i class="mdi mdi-table text-primary me-2"></i>View Enrolled Students
                  </h4>
                  <p class="card-description text-muted mb-0">
                    List of all enrolled students in the system
                  </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="table-light">
                        <tr>
                          <th>LRN</th>
                          <th>Name</th>
                          <th>Year Level</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (count($students) > 0): ?>
                          <?php foreach ($students as $student): ?>
                            <tr>
                              <td><?php echo htmlspecialchars($student['lrn']); ?></td>
                              <td><?php echo htmlspecialchars($student['name']); ?></td>
                              <td>
                                <span class="badge bg-info"><?php echo htmlspecialchars($student['year_level']); ?></span>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="3" class="text-center py-4">
                              <div class="d-flex flex-column align-items-center">
                                <i class="mdi mdi-account-multiple-outline text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-2 mb-0">No students found</p>
                              </div>
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
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
                      <input class="form-control" type="password" name="pin">
                    </div>
                    <input type="hidden" name="id" id="id_part">
                    <input type="hidden" name="name" id="name_part">


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