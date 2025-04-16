<?php
include('dbcon.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

// Get user information
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get candidate information
$sql_candidates = "SELECT * FROM candidate";
$result_candidates = $conn->query($sql_candidates);
$candidates = [];
if ($result_candidates) {
    while ($row = $result_candidates->fetch_assoc()) {
        $candidates[] = $row;
    }
}

// Get candidates table information
$sql_candidates_table = "SELECT * FROM candidates";
$result_candidates_table = $conn->query($sql_candidates_table);
$candidates_table = [];
if ($result_candidates_table) {
    while ($row = $result_candidates_table->fetch_assoc()) {
        $candidates_table[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Information - SDSJ Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="logos.png" type="image/x-icon">
    <style>
        :root {
            --primary-color: #077504;
            --primary-light: #0a8a06;
            --primary-dark: #055a03;
            --secondary-color: #f8f9fa;
            --accent-color: #ffc107;
            --accent-dark: #e0a800;
            --accent-light: #ffeeba;
            --text-light: #ffffff;
            --text-dark: #333333;
            --gold: #ffd700;
            --gold-dark: #ccac00;
            --blue: #007bff;
            --blue-dark: #0056b3;
            --success-light: #d4edda;
            --success-dark: #155724;
            --info-light: #d1ecf1;
            --info-dark: #0c5460;
            --warning-light: #fff3cd;
            --warning-dark: #856404;
            --danger-light: #f8d7da;
            --danger-dark: #721c24;
            --teal: #20c997;
            --teal-dark: #138496;
            --purple: #6f42c1;
            --purple-dark: #563d7c;
            --orange: #fd7e14;
            --orange-dark: #d35400;
        }

        body {
            background-color: #f8f9fa;
            padding-top: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-bottom: 3px solid var(--accent-color);
        }

        .navbar-brand {
            color: var(--text-light) !important;
            font-weight: 600;
        }

        .card {
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            font-weight: 600;
            padding: 15px 20px;
            border-bottom: 3px solid var(--accent-color);
        }

        .card-body {
            padding: 20px;
        }

        .table-responsive {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            border: none;
            padding: 12px 15px;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .alert {
            margin-top: 20px;
            border-radius: 8px;
            border: none;
        }

        .alert-warning {
            background-color: var(--accent-light);
            color: #856404;
            border-left: 4px solid var(--accent-color);
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid var(--blue);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .status-badge {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--accent-color);
        }

        .user-info {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid var(--primary-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .user-info:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .user-info p {
            margin-bottom: 8px;
        }

        .user-info strong {
            color: var(--primary-color);
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid var(--primary-color);
            position: relative;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.05);
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-color) 0%, var(--gold) 100%);
        }

        .footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            padding: 20px 0;
            margin-top: 40px;
            text-align: center;
            border-top: 3px solid var(--accent-color);
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Candidate Card Styles */
        .candidate-card,
        .partylist-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .candidate-card:hover,
        .partylist-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .candidate-card .card-header,
        .partylist-card .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            padding: 15px;
            border-bottom: 3px solid var(--accent-color);
        }

        .candidate-info,
        .partylist-info {
            padding: 10px 0;
        }

        .candidate-info p,
        .partylist-info p {
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .candidate-info p:last-child,
        .partylist-info p:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .candidate-info strong,
        .partylist-info strong {
            color: var(--primary-color);
            display: inline-block;
            min-width: 100px;
        }

        .candidate-info i,
        .partylist-info i {
            color: var(--gold);
        }

        /* Logo Banner */
        .logo-banner {
            background: linear-gradient(135deg, rgba(7, 117, 4, 0.1) 0%, rgba(5, 90, 3, 0.1) 100%);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: 1px solid rgba(7, 117, 4, 0.2);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .logo-banner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 193, 7, 0.05) 100%);
            z-index: 0;
        }

        .logo-banner img {
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        .logo-banner h2 {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            position: relative;
            z-index: 1;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.05);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .candidate-card,
            .partylist-card {
                margin-bottom: 20px;
            }
        }

        .partylist-info {
            padding: 10px 0;
        }

        .partylist-info p {
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .partylist-info p:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .partylist-info strong {
            color: var(--primary-color);
            display: inline-block;
            min-width: 100px;
        }

        .partylist-info i {
            color: var(--gold);
        }
        
        /* Enhanced Partylist Styles */
        .position-group {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-left: 5px solid var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .position-group:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }
        
        .position-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(7, 117, 4, 0.2);
            display: flex;
            align-items: center;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.05);
        }
        
        .position-title i {
            color: var(--gold);
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        .position-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }
        
        .position-item:hover {
            background-color: rgba(7, 117, 4, 0.05);
            border-radius: 5px;
            padding-left: 5px;
            padding-right: 5px;
        }
        
        .position-item:last-child {
            border-bottom: none;
        }
        
        .position-label {
            font-weight: 600;
            color: var(--text-dark);
            flex: 1;
        }
        
        .position-value {
            font-weight: 700;
            color: var(--primary-color);
            text-align: right;
            padding-left: 10px;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.05);
        }
        
        .party-info {
            background: linear-gradient(135deg, rgba(7, 117, 4, 0.1) 0%, rgba(5, 90, 3, 0.1) 100%);
            border-radius: 12px;
            padding: 20px;
            margin-top: 25px;
            border: 1px solid rgba(7, 117, 4, 0.2);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .party-info:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }
        
        .party-info .position-title {
            color: var(--primary-color);
            border-bottom: 1px solid rgba(7, 117, 4, 0.3);
        }
        
        .party-info .position-value {
            color: var(--gold-dark);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .position-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .position-value {
                text-align: left;
                padding-left: 0;
                margin-top: 5px;
                color: var(--primary-color);
            }
        }

        .partylist-title, .candidate-title {
            color: var(--primary-color);
            font-weight: 800;
            font-size: 1.3rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            padding: 12px 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
            border-radius: 8px;
            margin: -5px 0;
            border-bottom: 3px solid var(--primary-color);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }
        
        .partylist-title:after, .candidate-title:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(7, 117, 4, 0.1) 0%, rgba(5, 90, 3, 0.05) 100%);
            z-index: -1;
        }
        
        .partylist-title span, .candidate-title span {
            position: relative;
            z-index: 1;
            display: inline-block;
            padding: 0 15px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logos.png" alt="SDSJ Logo" height="40" class="me-2">
                <i class="fas fa-vote-yea me-2"></i>SDSJ Voting System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="user_side/logout.php">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Logo Banner -->
        <div class="row mb-4">
            <div class="col-12 text-center logo-banner">
                <img src="logos.png" alt="SDSJ Logo" class="img-fluid" style="max-height: 120px;">
                <h2 class="mt-3">SDSJ Voting System</h2>
            </div>
        </div>

        <!-- Account Status Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-clock me-2"></i>Account Status
                    </div>
                    <div class="card-body">


                        <div class="user-info">
                            <h4 class="section-title"><i class="fas fa-user me-2"></i>User Information</h4>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                            <p><strong>User Type:</strong> <span
                                    class="status-badge"><?php echo htmlspecialchars($user['u_type']); ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Candidate Information Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-users me-2"></i>Candidate Information
                    </div>
                    <div class="card-body">
                        <h4 class="section-title"><i class="fas fa-list me-2"></i>Independent Candidates</h4>
                        <div class="row">
                            <?php if (empty($candidates)): ?>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>No independent candidates found.
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($candidates as $candidate): ?>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100 candidate-card">
                                            <div class="card-header bg-white">
                                                <h5 class="mb-0 text-center candidate-title">
                                                    <span><?php echo htmlspecialchars($candidate['name']); ?></span>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="candidate-info">
                                                    <p><strong><i class="fas fa-briefcase me-2"></i>Position:</strong>
                                                        <?php echo htmlspecialchars($candidate['running_for']); ?></p>
                                                    <?php if (isset($candidate['party']) && !empty($candidate['party'])): ?>
                                                        <p><strong><i class="fas fa-flag me-2"></i>Party:</strong>
                                                            <?php echo htmlspecialchars($candidate['party']); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (isset($candidate['slogan']) && !empty($candidate['slogan'])): ?>
                                                        <p><strong><i class="fas fa-quote-left me-2"></i>Slogan:</strong>
                                                            <?php echo htmlspecialchars($candidate['slogan']); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (isset($candidate['projects']) && !empty($candidate['projects'])): ?>
                                                        <p><strong><i class="fas fa-tasks me-2"></i>Projects:</strong>
                                                            <?php echo htmlspecialchars($candidate['projects']); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (isset($candidate['votes'])): ?>
                                                        <p><strong><i class="fas fa-vote-yea me-2"></i>Votes:</strong>
                                                            <?php echo htmlspecialchars($candidate['votes']); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <h4 class="section-title mt-4"><i class="fas fa-table me-2"></i>Partylist</h4>
                        <div class="row">
                            <?php if (empty($candidates_table)): ?>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>No partylist candidates found.
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($candidates_table as $candidate): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 partylist-card">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0 text-center partylist-title">
                                                <span><?php 
                                                // Display the partylist name if available
                                                if (isset($candidate['partylist_name']) && !empty($candidate['partylist_name'])) {
                                                    echo htmlspecialchars($candidate['partylist_name']);
                                                } else {
                                                    // Fallback to the first non-empty value
                                                    $display_name = '';
                                                    foreach ($candidate as $key => $value) {
                                                        if ($key !== 'can_id' && !empty($value)) {
                                                            $display_name = $value;
                                                            break;
                                                        }
                                                    }
                                                    echo htmlspecialchars($display_name);
                                                }
                                                ?></span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="partylist-info">
                                                <?php if ((isset($candidate['slogan']) && !empty($candidate['slogan'])) || 
                                                         (isset($candidate['projects']) && !empty($candidate['projects']))): ?>
                                                <div class="party-info mb-3">
                                                    <h6 class="position-title"><i class="fas fa-info-circle me-2"></i>Additional Information</h6>
                                                    
                                                    <?php if (isset($candidate['slogan']) && !empty($candidate['slogan'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label"><i class="fas fa-quote-left me-2"></i>Slogan</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['slogan']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['projects']) && !empty($candidate['projects'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label"><i class="fas fa-tasks me-2"></i>Projects</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['projects']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php endif; ?>
                                                
                                                <div class="position-group">
                                                    <h6 class="position-title"><i class="fas fa-star me-2"></i>Executive Positions</h6>
                                                    
                                                    <?php if (isset($candidate['pres']) && !empty($candidate['pres'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">President</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['pres']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['vice']) && !empty($candidate['vice'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Vice President</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['vice']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['sec']) && !empty($candidate['sec'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Secretary</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['sec']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['treas']) && !empty($candidate['treas'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Treasurer</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['treas']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['aud']) && !empty($candidate['aud'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Auditor</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['aud']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['pio1']) && !empty($candidate['pio1'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Public Information Officers:</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['pio1']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['pio2']) && !empty($candidate['pio2'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label"></div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['pio2']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['pio3']) && !empty($candidate['pio3'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label"></div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['pio3']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['pio4']) && !empty($candidate['pio4'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label"></div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['pio4']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['po1']) && !empty($candidate['po1'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Peace Officers:</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['po1']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['po2']) && !empty($candidate['po2'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label"></div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['po2']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['po3']) && !empty($candidate['po3'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label"></div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['po3']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <div class="position-group mt-3">
                                                    <h6 class="position-title"><i class="fas fa-users me-2"></i>Representatives</h6>
                                                    
                                                    <?php if (isset($candidate['g7_rep']) && !empty($candidate['g7_rep'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Grade 7 Representative</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['g7_rep']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['g8_rep']) && !empty($candidate['g8_rep'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Grade 8 Representative</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['g8_rep']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['g9_rep']) && !empty($candidate['g9_rep'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Grade 9 Representative</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['g9_rep']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['g10_rep']) && !empty($candidate['g10_rep'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Grade 10 Representative</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['g10_rep']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['g11_rep']) && !empty($candidate['g11_rep'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Grade 11 Representative</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['g11_rep']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (isset($candidate['g12_rep']) && !empty($candidate['g12_rep'])): ?>
                                                    <div class="position-item">
                                                        <div class="position-label">Grade 12 Representative</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['g12_rep']); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <?php if (isset($candidate['party']) && !empty($candidate['party'])): ?>
                                                <div class="party-info mt-3">
                                                    <h6 class="position-title"><i class="fas fa-flag me-2"></i>Party Information</h6>
                                                    <div class="position-item">
                                                        <div class="position-label">Party Name</div>
                                                        <div class="position-value"><?php echo htmlspecialchars($candidate['partylist_name']); ?></div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="container">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> SDSJ Voting System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>