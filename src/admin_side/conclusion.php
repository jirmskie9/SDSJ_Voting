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
if (!isset($_SESSION['end'])) {
  header('location: admin.php');
  exit();
}
?>
<body class="with-welcome-text" onload="displayDateTime()">
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
        <img src="../assets/logos.png" alt="logo"  width = 80 height = 80/>
      </a>
      <a class="navbar-brand brand-logo-mini" href="admin.php">
        <img src="../assets/images/logo-mini.svg" alt="logo"  />
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
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="partylist.php">Partylist</a>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="independent.php" aria-expanded="false" aria-controls="charts">
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
        <script>
  function displayDateTime() {
    var currentDate = new Date();
    var date = currentDate.toLocaleDateString();
    var time = currentDate.toLocaleTimeString();
    document.getElementById("datetime").innerHTML = "Current Date: " + date + "<br>Live Time: " + time;
  }

  // Call displayDateTime function every second to keep updating time
  setInterval(displayDateTime, 1000);
</script>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Election Winners</h4>
                  <div class = "col-md-auto text-right" >
                    <label for="" style= "color: blue;"><div id="datetime"></div></label>
                  </div>
                  <p class="card-description">
               
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped" id = "myTable">
                      <thead>
                        <tr>
                        <th>
                           Position
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Partylist
                          </th>
                          <th>
                            Total Votes
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
    <?php
    // Define the order of positions
    $positionOrder = array(
        'President',
        'Vice President',
        'Secretary',
        'Treasurer',
        'Auditor',
        'Public Information Officer',
        'Peace Officer',
        'Grade 7 Representative',
        'Grade 8 Representative',
        'Grade 9 Representative',
        'Grade 10 Representative',
        'Grade 11 Representative',
        'Grade 12 Representative'
    );

    // Define the corresponding images for each position
    $positionImages = array(
        'President' => 'president.png',
        'Vice President' => 'vice.png',
        'Secretary' => 'sec.png',
        'Treasurer' => 'trea.png',
        'Auditor' => 'aud.png',
        'Public Information Officer' => 'pio.png',
        'Peace Officer' => 'peace.png',
        'Grade 7 Representative' => 'rep.png',
        'Grade 8 Representative' => 'rep.png',
        'Grade 9 Representative' => 'rep.png',
        'Grade 10 Representative' => 'rep.png',
        'Grade 11 Representative' => 'rep.png',
        'Grade 12 Representative' => 'rep.png'
    );

    // Select the candidate with the highest count for each position
    $selectSql = "SELECT position, MAX(count) AS max_count FROM vote_counting GROUP BY position ORDER BY FIELD(position, '" . implode("','", $positionOrder) . "')";
    $result = mysqli_query($conn, $selectSql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $position = $row['position'];
            $maxCount = $row['max_count'];

            // Now, select the candidate details with the highest count for each position
            $selectCandidateSql = "SELECT * FROM vote_counting WHERE position = '$position' AND count = $maxCount";
            $candidateResult = mysqli_query($conn, $selectCandidateSql);

            if ($candidateResult && mysqli_num_rows($candidateResult) > 0) {
                $candidateRow = mysqli_fetch_assoc($candidateResult);
                $name = $candidateRow['name'];
                $partylist = $candidateRow['partylist'];
                $image = isset($positionImages[$position]) ? $positionImages[$position] : 'default.png';
    ?>
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="img/<?php echo $image; ?>" class="avatar avatar-sm me-3" alt="<?php echo $position; ?>">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6><?php echo $position; ?></h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="btn btn-info btn-sm"><?php echo $name; ?></p>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm"><?php echo $partylist; ?></button>
                    </td>
                    <td>
                        <p class="btn btn-success btn-sm"><?php echo $maxCount; ?></p>
                    </td>
                </tr>
    <?php
            }
        }
    } else {
        echo '<tr><td colspan="3">No candidates found</td></tr>';
    }
    ?>
</tbody>

                    </table>
                  </div>
                </div>
               
              </div>
              
            </div>
            
          </div>
          <form method = "POST" action="reset.php">
          <button type = "submit" class = "btn btn-info" name = "set">Confirm</button>
          <a href="view_all.php" class="btn btn-warning" target="_blank">View All votes</a>
          </form>
        
          <br>
          <br>
          <label for="">Print:</label>
          <br>
          <br>
       
          <button class = "btn btn-success" onclick="printCsv()">EXCEL</button>
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
function printTable() {
    var table = document.getElementById('myTable').outerHTML;
    var printWindow = window.open('', '_Reporters');
    printWindow.document.write('<html><head><title>Print Election Winners</title></head><body>');
    printWindow.document.write('<style type="text/css" media="print">');
    printWindow.document.write('body { font-family: Arial, sans-serif; }');
    printWindow.document.write('table { border-collapse: collapse; width: 100%; }');
    printWindow.document.write('th, td { border: 1px solid #000; padding: 8px; text-align: left; }');
    printWindow.document.write('th { background-color: #f2f2f2; }');
    printWindow.document.write('</style>');
    printWindow.document.write('<h1>Print Election Winners</h1>');
    printWindow.document.write(table);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.print();
}
</script>
<script>

  function convertTableToCSV() {
    var table = document.getElementById('myTable');
    var rows = table.getElementsByTagName('tr');
    var csvData = '';

    for (var i = 0; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName('td');
      for (var j = 0; j < cells.length; j++) {
        csvData += cells[j].innerText + ',';
      }
      csvData += '\n';
    }

    return csvData;
  }

  function printCsv() {
    var csvData = convertTableToCSV();
    var blob = new Blob([csvData], { type: 'text/csv' });
    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = 'election_winner .csv';
    link.click();
  }
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
</body>

</html>