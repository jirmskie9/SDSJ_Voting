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
      <a class="" href="admin.php">
        <img class = "img-fluid" src="../assets/logos.png" alt="logo" width = 80 height = 80/>
      </a>
      
     
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text" style = "color: #387ADF;">HELLO, <span class="text-black fw-bold">ADMIN</span></h1>
       
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
      <a class="nav-link" data-bs-toggle="collapse" href="independent.php" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-account-settings"></i>
        <span class="menu-title">Independent</span>
        <i class="menu-arrow"></i>
      </a>
    
    </li>
    <li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="registered.php" aria-expanded="false" aria-controls="charts">
    <i class="menu-icon mdi mdi-account-plus"></i>
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
                          <div>
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
                            <p class="statistics-title">Registered Voters</p>
                            <h3 class="rate-percentage"><?php echo $total_reg?></h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><?php echo "<span id='span1'>" . getCurrentDate() . "</span>";?></p>
                          
                          </div>
                          <div>
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
                            <p class="statistics-title">Partylist</p>
                            <h3 class="rate-percentage"><?php echo $total_part ?></h3>
                            <p class="text-warning d-flex"><i class="mdi mdi-menu-up"></i><?php echo "<span id='span1'>" . getCurrentDate() . "</span>";?></p>
                          </div>
                          <div>
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
                            <p class="statistics-title">To Vote</p>
                            <h3 class="rate-percentage"><?php echo $total_tovote?></h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-up"></i><?php echo "<span id='span1'>" . getCurrentDate() . "</span>";?></p>
                          </div>
                          <div class="d-none d-md-block">

                          <?php
$query = "SELECT * FROM signal_db";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $signal = $row['description'];
    $class = ($signal == 'Started') ? 'text-success' : 'text-danger';
} else {
    echo "Error executing query: " . $conn->error;
}

?>
<p class="statistics-title">Voting Signal</p>
<h3 class="rate-percentage"><?php echo $signal ?></h3>
<p class="<?php echo $class; ?> d-flex"><i class="mdi mdi-menu-down"></i><?php echo "<span id='span1'>" . getCurrentDate() . "</span>";?></p>

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
                                    <h4 class="card-title card-title-dash">Pending Accounts</h4>
                                    <p class="card-subtitle card-subtitle-dash">Check here if student information enrolled on SY. 2023-2024. You have <label style = "color: blue; font-size: 15px;">(<?php echo $total_pending?>)</label> Account Pending</p>
                                  </div>
                                  <div>
                                    
                                  </div>
                                </div>
                                <button class="btn btn-success btn-lg text-white mb-0 me-0" type="button" data-toggle="modal" data-target="#likeModal">
                                        Start Voting Session</button>
                                        <button class="btn btn-danger btn-lg text-white mb-0 me-0" type="button" data-toggle="modal" data-target="#endModal">
                                        End Voting</button>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                             
                                          </div>
                                        </th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Grade</th>
                                      </tr>
                                    </thead>
                                    <?php

                                            include('../dbcon.php');


                                            $sql = "SELECT * FROM users WHERE confirmation = 'Verified' AND u_type != 'Admin'";
                                            $result = $conn->query($sql);


                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    
                                                    echo '<tr>';
                                                    echo '<td>';
                                                    echo '<div class="form-check form-check-flat mt-0">';
                                                    echo '<label class="form-check-label">';
                                                  
                                                    echo '</label>';
                                                    echo '</div>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<div class="d-flex">';
                                                    echo '<img src="graduated.png" alt="">';
                                                    echo '<div>';
                                                    echo '<h6>' . $row['student_id'] . '</h6>';
                                                    echo '<p>' . $row['u_type'] . '</p>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<h6>' . $row['name'] . '</h6>';
                                                    echo '<p>' . $row['email'] . '</p>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<div class="badge badge-opacity-warning">' . $row['grade'] . '</div>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<a class="btn btn-primary btn-sm text-white" href="confirmationproc.php?id=' . $row['user_id'] . '&name=' . urlencode($row['name']) . '&email=' . urlencode($row['email']) . '">Confirm</a>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                            } else {
                                              
                                                echo '<tr><td colspan="5">No records found</td></tr>';
                                            }



                                            ?>

                                  </table>
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
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">President Ranking</h4>
                                  </div>
                                  <div>
                                    
                                  </div>
                                </div>
                               
                                <div class="table-responsive  mt-1">
                                  <table id = "pres" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "vice" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "sec" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "trea" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "aud" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "pio" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "po" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "g7" class="table select-table">
                                    <thead>
                                      <tr>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php

$sql = "SELECT * FROM vote_counting WHERE position = 'Grade 7 Representative' ORDER BY count DESC";
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "g8" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "g9" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "g10" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "g11" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                  <table id = "g12" class="table select-table">
                                    <thead>
                                      <tr>
                                        
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
                        <img src="<?php echo $imageSource; ?>" alt="Country flag" width="30" height="30">
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
       xhr.onreadystatechange = function() {
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
                                                      <div><span class="text-light-green">' . $row['action'] .'</div>
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
                                                    <div><span class="text-light-green">' . $row['name'] .'</div>
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
                    <input class="form-control" type="password" name = "pin">
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
</body>

</html>