<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'tuk_sports');
define('DB_USER', 'root');
define('DB_PASS', '');

// Create database connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get user details
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
$sport = $_SESSION['sport'] ?? '';

// Get user registration details based on user type
if ($user_type == 'student') {
    $stmt = $pdo->prepare("
        SELECT u.*, pr.sport, pr.year_of_study, pr.status as registration_status, pr.registered_at 
        FROM users u 
        LEFT JOIN player_registrations pr ON u.id = pr.user_id 
        WHERE u.id = ?
    ");
} else {
    $stmt = $pdo->prepare("
        SELECT u.*, cr.sport, cr.status as registration_status, cr.registered_at 
        FROM users u 
        LEFT JOIN coach_registrations cr ON u.id = cr.user_id 
        WHERE u.id = ?
    ");
}

$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Get team members (for coaches) or teammates (for students)
if ($user_type == 'coach') {
    $team_stmt = $pdo->prepare("
        SELECT u.full_name, u.username, pr.year_of_study, pr.status 
        FROM player_registrations pr 
        JOIN users u ON pr.user_id = u.id 
        WHERE pr.sport = ? AND pr.status = 'approved'
        ORDER BY u.full_name
        LIMIT 8
    ");
    $team_stmt->execute([$sport]);
    $team_members = $team_stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $teammates_stmt = $pdo->prepare("
        SELECT u.full_name, u.username, pr.year_of_study 
        FROM player_registrations pr 
        JOIN users u ON pr.user_id = u.id 
        WHERE pr.sport = ? AND pr.status = 'approved' AND u.id != ?
        ORDER BY u.full_name
        LIMIT 8
    ");
    $teammates_stmt->execute([$sport, $user_id]);
    $teammates = $teammates_stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get recent registrations for the same sport
$recent_registrations = $pdo->prepare("
    SELECT u.full_name, u.username, 'student' as type 
    FROM player_registrations pr 
    JOIN users u ON pr.user_id = u.id 
    WHERE pr.sport = ? 
    ORDER BY pr.registered_at DESC 
    LIMIT 5
");
$recent_registrations->execute([$sport]);
$recent_members = $recent_registrations->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TU-K Sports Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header Styles */
        header {
            background: linear-gradient(135deg, #003366, #002244);
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            height: 60px;
            margin-right: 15px;
        }
        
        .logo-text {
            font-size: 1.4rem;
            font-weight: 600;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 10px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .nav-links a:hover, .nav-links a.active {
            background-color: #2E8B57;
        }
        
        /* Dashboard Styles */
        .dashboard-section {
            padding: 30px 0;
            min-height: 80vh;
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, #2E8B57, #26734d);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .welcome-banner h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .welcome-banner p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }
        
        .card-icon {
            font-size: 2rem;
            margin-right: 15px;
            color: #003366;
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #003366;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: auto;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        
        .info-value {
            color: #6c757d;
        }
        
        .member-list, .recent-list {
            list-style: none;
        }
        
        .member-item, .recent-item {
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .member-item:last-child, .recent-item:last-child {
            border-bottom: none;
        }
        
        .member-name {
            font-weight: 600;
            color: #003366;
            margin-bottom: 5px;
        }
        
        .member-details {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            justify-content: space-between;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 30px;
        }
        
        .action-btn {
            background: linear-gradient(135deg, #003366, #002244);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s;
            display: block;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 51, 102, 0.3);
        }
        
        .action-btn.sport {
            background: linear-gradient(135deg, #2E8B57, #26734d);
        }
        
        .action-btn.events {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
        
        .empty-state .icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
        
        /* Footer */
        footer {
            background-color: #003366;
            color: white;
            padding: 30px 0 20px;
            margin-top: 50px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .footer-section h3 {
            color: #2E8B57;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header-top {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .welcome-banner h1 {
                font-size: 2rem;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="header-top">
                <div class="logo-container">
                    <img src="https://media.tukenya.ac.ke/general/logo.png" alt="TU-K Logo" class="logo">
                    <div class="logo-text">TU-K Sports Portal</div>
                </div>
                
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="dashboard.php" class="active">Dashboard</a></li>
                        <?php if($user_type == 'coach' || $user_type == 'admin'): ?>
                            <li><a href="admin.php">Admin Panel</a></li>
                        <?php endif; ?>
                        <li><a href="sports.php">Sports</a></li>
                        <li><a href="events.php">Events</a></li>
                        <li><a href="logout.php">Logout (<?php echo htmlspecialchars($user['full_name']); ?>)</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Dashboard Section -->
    <section class="dashboard-section">
        <div class="container">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <h1>Welcome back, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
                <p>
                    <?php 
                    if ($user_type == 'student') {
                        echo "You are registered for " . ucfirst($sport) . " - Year " . ($user['year_of_study'] ?? 'N/A');
                    } else {
                        echo "You are coaching " . ucfirst($sport);
                    }
                    ?>
                </p>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Profile Card -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon">👤</div>
                        <h3 class="card-title">Profile Information</h3>
                        <span class="status-badge status-<?php echo $user['registration_status'] ?? 'pending'; ?>">
                            <?php echo ucfirst($user['registration_status'] ?? 'Pending'); ?>
                        </span>
                    </div>
                    <div class="card-content">
                        <div class="info-item">
                            <span class="info-label">Full Name:</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['full_name']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Username:</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['username']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone:</span>
                            <span class="info-value"><?php echo htmlspecialchars($user['contact_number']); ?></span>
                        </div>
                        <?php if($user_type == 'student'): ?>
                        <div class="info-item">
                            <span class="info-label">Year of Study:</span>
                            <span class="info-value">Year <?php echo $user['year_of_study']; ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="info-item">
                            <span class="info-label">Sport:</span>
                            <span class="info-value"><?php echo ucfirst($sport); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Member Since:</span>
                            <span class="info-value"><?php echo date('F j, Y', strtotime($user['created_at'])); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Team Information -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon">👥</div>
                        <h3 class="card-title">
                            <?php echo $user_type == 'coach' ? 'Team Members' : 'Teammates'; ?>
                        </h3>
                    </div>
                    <div class="card-content">
                        <?php if ($user_type == 'coach' && !empty($team_members)): ?>
                            <ul class="member-list">
                                <?php foreach ($team_members as $member): ?>
                                    <li class="member-item">
                                        <div class="member-name"><?php echo htmlspecialchars($member['full_name']); ?></div>
                                        <div class="member-details">
                                            <span><?php echo $member['username']; ?></span>
                                            <span>Year <?php echo $member['year_of_study']; ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php elseif ($user_type == 'student' && !empty($teammates)): ?>
                            <ul class="member-list">
                                <?php foreach ($teammates as $teammate): ?>
                                    <li class="member-item">
                                        <div class="member-name"><?php echo htmlspecialchars($teammate['full_name']); ?></div>
                                        <div class="member-details">
                                            <span><?php echo $teammate['username']; ?></span>
                                            <span>Year <?php echo $teammate['year_of_study']; ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="empty-state">
                                <div class="icon">👥</div>
                                <p>
                                    <?php 
                                    if ($user_type == 'coach') {
                                        echo 'No approved team members yet';
                                    } else {
                                        echo 'No teammates found';
                                    }
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon">🔄</div>
                        <h3 class="card-title">Recent Members</h3>
                    </div>
                    <div class="card-content">
                        <?php if (!empty($recent_members)): ?>
                            <ul class="recent-list">
                                <?php foreach ($recent_members as $member): ?>
                                    <li class="recent-item">
                                        <div class="member-name"><?php echo htmlspecialchars($member['full_name']); ?></div>
                                        <div class="member-details">
                                            <span><?php echo $member['username']; ?></span>
                                            <span>Student</span>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="empty-state">
                                <div class="icon">🔄</div>
                                <p>No recent members</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <div class="card-icon">📊</div>
                        <h3 class="card-title">Quick Stats</h3>
                    </div>
                    <div class="card-content">
                        <div class="info-item">
                            <span class="info-label">Sport:</span>
                            <span class="info-value"><?php echo ucfirst($sport); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">User Type:</span>
                            <span class="info-value"><?php echo ucfirst($user_type); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status:</span>
                            <span class="info-value status-<?php echo $user['registration_status'] ?? 'pending'; ?>">
                                <?php echo ucfirst($user['registration_status'] ?? 'Pending'); ?>
                            </span>
                        </div>
                        <?php if($user_type == 'coach'): ?>
                        <div class="info-item">
                            <span class="info-label">Team Size:</span>
                            <span class="info-value"><?php echo count($team_members); ?> members</span>
                        </div>
                        <?php else: ?>
                        <div class="info-item">
                            <span class="info-label">Teammates:</span>
                            <span class="info-value"><?php echo count($teammates); ?> players</span>
                        </div>
                        <?php endif; ?>
                        <div class="info-item">
                            <span class="info-label">Account Age:</span>
                            <span class="info-value">
                                <?php 
                                $created = new DateTime($user['created_at']);
                                $now = new DateTime();
                                $interval = $created->diff($now);
                                echo $interval->format('%a days');
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <?php
                // Determine the correct sport page
                $sport_pages = [
                    'football' => 'ball-games.php',
                    'basketball' => 'ball-games.php', 
                    'volleyball' => 'ball-games.php',
                    'handball' => 'ball-games.php',
                    'rugby' => 'ball-games.php',
                    'athletics' => 'athletics.php',
                    'martial-arts' => 'martial-arts.php'
                ];
                $sport_page = $sport_pages[$sport] ?? 'sports.php';
                ?>
                
                <a href="<?php echo $sport_page; ?>" class="action-btn sport">
                    View <?php echo ucfirst($sport); ?> Page
                </a>
                <a href="events.php" class="action-btn events">
                    View Events
                </a>
                <a href="schedule.php" class="action-btn">
                    Training Schedule
                </a>
                <?php if($user_type == 'student'): ?>
                    <a href="profile.php" class="action-btn">
                        Update Profile
                    </a>
                <?php else: ?>
                    <a href="admin.php" class="action-btn">
                        Manage Team
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="sports.php">Sports Programs</a></li>
                        <li><a href="events.php">Events Calendar</a></li>
                        <li><a href="contact.php">Contact Support</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Your Sports</h3>
                    <ul class="footer-links">
                        <li><a href="ball-games.php">Ball Games</a></li>
                        <li><a href="athletics.php">Athletics</a></li>
                        <li><a href="martial-arts.php">Martial Arts</a></li>
                        <li><a href="board-games.php">Board Games</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul class="footer-links">
                        <li><a href="help.php">Help Center</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="feedback.php">Feedback</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <p>Sports Department</p>
                    <p>Technical University of Kenya</p>
                    <p>Email: sports@tukenya.ac.ke</p>
                    <p>Phone: +254 20 2219929</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 Technical University of Kenya. All rights reserved. | 
                   Logged in as: <?php echo htmlspecialchars($user['full_name']); ?> (<?php echo ucfirst($user_type); ?>)</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add any interactive functionality here
            console.log('Dashboard loaded successfully');
        });
    </script>
</body>
</html>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
