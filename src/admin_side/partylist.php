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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Partylist</h4>
                  <p class="card-description">
                    Enter valid data
                  </p>
                  <form class="forms-sample" method="POST" action="partylistproc.php">
                    <div class="form-group">
                      <img src="../assets/images/diversity.png" alt="Candidates" width="30" height="30">
                      <input class="form-control" type="text" name="plist" placeholder="Partylist Name" required>
                    </div>
                    <div class="form-group">
                     <label for="">Slogan</label>
                    <textarea name="slogan" id="" class="form-control" style="height: 50px;"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="">Projects</label>
                      <textarea name="projects" id="" class="form-control" style="height: 100px;" placeholder="Enter your projects and initiatives..."></textarea>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/president.png" alt="Candidates" width="30" height="30">
                      <input class="form-control" type="text" name="pres" placeholder="President"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/vice.png" alt="Candidates" width="30" height="30">
                      <input class="form-control" type="text" name="vice" placeholder="Vice President"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/sec.png" alt="Candidates" width="30" height="30">
                      <input class="form-control" type="text" name="sec" placeholder="Secretary"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/treasure.png" alt="Candidates" width="30" height="30">
                      <input class="form-control" type="text" name="trea" placeholder="Treasuser"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/auditor.png" alt="Candidates" width="30" height="30">
                      <input class="form-control" type="text" name="aud" placeholder="Auditor"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/public.png" alt="Candidates" width="30" height="30">
                      <label for="">Public Information Officers</label>
                      <div id="pio-container">
                        <input class="form-control" type="text" name="pio1" placeholder="Public Information Officer 1"
                          pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                      </div>
                      <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-pio-btn">Add PIO</button>
                      <span id="pio-count" class="text-muted ms-2">1/4</span>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/peace.png" alt="Candidates" width="30" height="30">
                      <label for="">Peace Officers</label>
                      <div id="po-container">
                        <input class="form-control" type="text" name="po1" placeholder="Peace Officer 1"
                          pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                      </div>
                      <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-po-btn">Add PO</button>
                      <span id="po-count" class="text-muted ms-2">1/3</span>
                    </div>
                    <div class="form-group">
                      <img src="../assets/images/rep.png" alt="Candidates" width="30" height="30">
                      <label for="">Junior High School Representatives</label>

                      <input class="form-control" type="text" name="g7" placeholder="Grade 7 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                      <br>
                      <input class="form-control" type="text" name="g8" placeholder="Grade 8 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                      <br>
                      <input class="form-control" type="text" name="g9" placeholder="Grade 9 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                      <br>
                      <input class="form-control" type="text" name="g10" placeholder="Grade 10 Representative"
                        pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                    </div>

                    <div class="form-group">
                      <img src="../assets/images/rep.png" alt="Candidates" width="30" height="30">
                      <label for="">Senior High School Representatives</label>
                      
                      <div class="mb-3">
                        <label for="g11" class="form-label">Grade 11 Representative</label>
                        <input class="form-control" type="text" name="g11" placeholder="Grade 11 Representative"
                          pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                        <select class="form-select mt-2" name="g11_strand" required>
                          <option value="" selected disabled>Select Strand</option>
                          <option value="STEM">STEM (Science, Technology, Engineering, and Mathematics)</option>
                          <option value="ABM">ABM (Accountancy, Business, and Management)</option>
                          <option value="HUMSS">HUMSS (Humanities and Social Sciences)</option>
                          <option value="GAS">GAS (General Academic Strand)</option>
                          <option value="TVL">TVL (Technical-Vocational-Livelihood)</option>
                        </select>
                      </div>
                      
                      <div class="mb-3">
                        <label for="g12" class="form-label">Grade 12 Representative</label>
                        <input class="form-control" type="text" name="g12" placeholder="Grade 12 Representative"
                          pattern="[A-Za-z]+ [A-Za-z]+" title="Please enter a valid first name and last name" required>
                        <select class="form-select mt-2" name="g12_strand" required>
                          <option value="" selected disabled>Select Strand</option>
                          <option value="STEM">STEM (Science, Technology, Engineering, and Mathematics)</option>
                          <option value="ABM">ABM (Accountancy, Business, and Management)</option>
                          <option value="HUMSS">HUMSS (Humanities and Social Sciences)</option>
                          <option value="GAS">GAS (General Academic Strand)</option>
                          <option value="TVL">TVL (Technical-Vocational-Livelihood)</option>
                        </select>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2" name="filec">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Added Partylist</h4>
                  <p class="card-description">


                    <!-- Table that shows the data -->
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Date & Time Added</th>
                      </tr>
                    </thead>
                    <?php
                    $query = "SELECT * FROM candidates";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                      $encoded_can_id = base64_encode($row['can_id']);

                      echo '<tbody>';
                      echo '<tr>';
                      echo '<td class="py-1"><img src="../assets/images/ssglogo.png" alt="image" /></td>';
                      echo '<td>' . $row['partylist'] . '</td>';
                      echo '<td>' . $row['date_time'] . '</td>';
                      echo '<td>';
                      echo '<a class="btn btn-info btn-sm" href="edit.php?id=' . urlencode($encoded_can_id) . '">Edit</a>';
                      echo '</td>';
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

          // Dynamic input fields for PIO and PO
          document.addEventListener('DOMContentLoaded', function() {
            // PIO functionality
            const pioContainer = document.getElementById('pio-container');
            const addPioBtn = document.getElementById('add-pio-btn');
            const pioCountSpan = document.getElementById('pio-count');
            let pioCount = 1;

            addPioBtn.addEventListener('click', function() {
              if (pioCount < 4) {
                pioCount++;
                const newInput = document.createElement('input');
                newInput.className = 'form-control mt-2';
                newInput.type = 'text';
                newInput.name = 'pio' + pioCount;
                newInput.placeholder = 'Public Information Officer ' + pioCount;
                newInput.pattern = '[A-Za-z]+ [A-Za-z]+';
                newInput.title = 'Please enter a valid first name and last name';
                newInput.required = true;
                pioContainer.appendChild(newInput);
                pioCountSpan.textContent = pioCount + '/4';
                
                if (pioCount === 4) {
                  addPioBtn.disabled = true;
                }
              }
            });

            // PO functionality
            const poContainer = document.getElementById('po-container');
            const addPoBtn = document.getElementById('add-po-btn');
            const poCountSpan = document.getElementById('po-count');
            let poCount = 1;

            addPoBtn.addEventListener('click', function() {
              if (poCount < 3) {
                poCount++;
                const newInput = document.createElement('input');
                newInput.className = 'form-control mt-2';
                newInput.type = 'text';
                newInput.name = 'po' + poCount;
                newInput.placeholder = 'Peace Officer ' + poCount;
                newInput.pattern = '[A-Za-z]+ [A-Za-z]+';
                newInput.title = 'Please enter a valid first name and last name';
                newInput.required = true;
                poContainer.appendChild(newInput);
                poCountSpan.textContent = poCount + '/3';
                
                if (poCount === 3) {
                  addPoBtn.disabled = true;
                }
              }
            });
          });
        </script>
</body>

</html>