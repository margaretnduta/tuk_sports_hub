<?php
// Database connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'tuk_sports');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Simple session authentication
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin-login.php');
    exit;
}

// Get all registrations
$stmt = $pdo->query("SELECT * FROM ball_games_registrations ORDER BY registration_date DESC");
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get statistics
$total_registrations = $pdo->query("SELECT COUNT(*) as total FROM ball_games_registrations")->fetch()['total'];

$sport_stats = [];
$sports = ['Football', 'Basketball', 'Volleyball', 'Handball', 'Rugby', 'Netball'];
foreach ($sports as $sport) {
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM ball_games_registrations WHERE sport = ?");
    $stmt->execute([$sport]);
    $sport_stats[$sport] = $stmt->fetch()['count'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ball Games Registrations - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #003366;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #003366;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #003366;
        }
        .logout {
            float: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout">
            <a href="admin-logout.php">Logout</a>
        </div>
        <h1>Ball Games Registrations - Admin Panel</h1>
        
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_registrations; ?></div>
                <div>Total Registrations</div>
            </div>
            <?php foreach ($sport_stats as $sport => $count): ?>
            <div class="stat-card">
                <div class="stat-number"><?php echo $count; ?></div>
                <div><?php echo $sport; ?> Registrations</div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Student ID</th>
                    <th>Sport</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Year</th>
                    <th>Course</th>
                    <th>Experience</th>
                    <th>Position</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $registration): ?>
                <tr>
                    <td><?php echo htmlspecialchars($registration['name']); ?></td>
                    <td><?php echo htmlspecialchars($registration['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($registration['sport']); ?></td>
                    <td><?php echo htmlspecialchars($registration['email']); ?></td>
                    <td><?php echo htmlspecialchars($registration['phone']); ?></td>
                    <td><?php echo htmlspecialchars($registration['year']); ?></td>
                    <td><?php echo htmlspecialchars($registration['course']); ?></td>
                    <td><?php echo htmlspecialchars($registration['experience']); ?></td>
                    <td><?php echo htmlspecialchars($registration['position_role']); ?></td>
                    <td><?php echo htmlspecialchars($registration['registration_date']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php if (empty($registrations)): ?>
            <p style="text-align: center; margin-top: 20px;">No registrations found.</p>
        <?php endif; ?>
    </div>
</body>
</html>