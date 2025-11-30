<?php
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-registration'])) {
    $registration_data = [
        'sport' => $_POST['selected-sport'] ?? '',
        'name' => $_POST['student-name'] ?? '',
        'student_id' => $_POST['student-id'] ?? '',
        'email' => $_POST['student-email'] ?? '',
        'phone' => $_POST['student-phone'] ?? '',
        'year' => $_POST['student-year'] ?? '',
        'course' => $_POST['student-course'] ?? '',
        'experience' => $_POST['experience-level'] ?? 'Beginner',
        'preferred_event' => $_POST['preferred-event'] ?? '',
        'personal_best' => $_POST['personal-best'] ?? '',
        'medical_notes' => $_POST['medical-notes'] ?? '',
        'emergency_contact' => $_POST['emergency-contact'] ?? ''
    ];

    // Validate required fields
    $required_fields = ['sport', 'name', 'student_id', 'email', 'phone', 'year', 'course', 'emergency_contact'];
    $valid = true;
    
    foreach ($required_fields as $field) {
        if (empty($registration_data[$field])) {
            $valid = false;
            break;
        }
    }
    
    if ($valid) {
        try {
            // Check if student is already registered for this sport
            $check_stmt = $pdo->prepare("SELECT id FROM athletics_registrations WHERE student_id = ? AND sport = ?");
            $check_stmt->execute([$registration_data['student_id'], $registration_data['sport']]);
            
            if ($check_stmt->rowCount() > 0) {
                $registration_error = "You are already registered for " . $registration_data['sport'];
            } else {
                // Insert new registration
                $sql = "INSERT INTO athletics_registrations 
                        (sport, name, student_id, email, phone, year, course, experience, preferred_event, personal_best, medical_notes, emergency_contact) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $registration_data['sport'],
                    $registration_data['name'],
                    $registration_data['student_id'],
                    $registration_data['email'],
                    $registration_data['phone'],
                    $registration_data['year'],
                    $registration_data['course'],
                    $registration_data['experience'],
                    $registration_data['preferred_event'],
                    $registration_data['personal_best'],
                    $registration_data['medical_notes'],
                    $registration_data['emergency_contact']
                ]);
                
                $registration_success = true;
                $success_sport = $registration_data['sport'];
            }
        } catch(PDOException $e) {
            $registration_error = "Database error: " . $e->getMessage();
        }
    } else {
        $registration_error = "Please fill all required fields.";
    }
}

// Function to get registration count for a specific sport
function getRegistrationCount($pdo, $sport) {
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM athletics_registrations WHERE sport = ?");
    $stmt->execute([$sport]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}

// Function to get all athletics programs
function getAthleticsPrograms($pdo) {
    $stmt = $pdo->query("SELECT * FROM athletics_programs WHERE active = 1");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get athletics programs
$programs = getAthleticsPrograms($pdo);

// Calculate total athlete counts for each program
$athlete_counts = [];
foreach ($programs as $program) {
    $registration_count = getRegistrationCount($pdo, $program['name']);
    $athlete_counts[$program['name']] = $program['base_athlete_count'] + $registration_count;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athletics - Technical University of Kenya</title>
    <style>
        /* Your existing CSS styles remain exactly the same */
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #ffffff;
            color: #000000;
            line-height: 1.6;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header Styles */
        header {
            background-color: #fff;
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
            background-color: white;
            border: none;
        }
        
        .logo {
            height: 150px;
            width: 450px;
            margin-right: 15px;
        }
        
        .logo-text {
            font-size: 1.8rem;
            font-weight: lighter;
            color: #003366;
        }
        
        /* Navigation */
        nav {
            background-color: white;
        }
        
        .nav-container {
            display: flex;
            justify-content: flex-end;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            position: relative;
        }
        
        .nav-links a {
            color: green;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            transition: background-color 0.3s;
        }
        
        .nav-links a:hover {
            color: black;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 51, 102, 0.8), rgba(0, 51, 102, 0.8)), url('https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 0;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
            font-weight: normal;
        }
        
        /* Athletics Section */
        .athletics-section {
            padding: 60px 0;
            background-color: #f9f9f9;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: #003366;
            font-size: 2.2rem;
            font-weight: bold;
        }
        
        .sports-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .sport-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .sport-card:hover {
            transform: translateY(-5px);
        }
        
        .sport-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .sport-content {
            padding: 25px;
        }
        
        .sport-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #003366;
            border-bottom: 2px solid #f0f8ff;
            padding-bottom: 10px;
        }
        
        .sport-info {
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-label {
            font-weight: bold;
            color: #003366;
        }
        
        .info-value {
            color: #000000;
        }
        
        .stats-container {
            background-color: #f0f8ff;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }
        
        .stats-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #003366;
            text-align: center;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            text-align: center;
        }
        
        .stat-item {
            padding: 8px;
            border-radius: 4px;
        }
        
        .gold {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .silver {
            background-color: #e2e3e5;
            color: #383d41;
        }
        
        .bronze {
            background-color: #e8d5c4;
            color: #7a5c3c;
        }
        
        /* Registration Button */
        .register-btn {
            display: block;
            width: 100%;
            background-color: #2E8B57;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
            text-align: center;
            text-decoration: none;
        }
        
        .register-btn:hover {
            background-color: #26734d;
        }
        
        /* Registration Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .modal-header {
            padding: 20px;
            background-color: #003366;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #000000;
            font-weight: normal;
        }
        
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            color: #000000;
        }
        
        .form-group textarea {
            min-height: 80px;
            resize: vertical;
        }
        
        .submit-btn {
            background-color: #2E8B57;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        
        .submit-btn:hover {
            background-color: #26734d;
        }
        
        /* Success and Error Messages */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            text-align: center;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            text-align: center;
        }
        
        /* Footer */
        footer {
            background-color: #000;
            color: #fff;
            border-top: 4px solid #003366;
        }
        
        .footer-content {
            padding: 50px 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .footer-section h3 {
            color: #cc0000;
            margin-bottom: 20px;
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
            font-weight: normal;
        }
        
        .footer-links a:hover {
            color: #fff;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #333;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            color: white;
            transition: background-color 0.3s;
        }
        
        .social-icon:hover {
            background-color: #003366;
        }
        
        .footer-bottom {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #333;
            font-size: 0.9rem;
            color: #aaa;
            font-weight: normal;
        }
        
        /* Contact Information in Footer */
        .contact-info p {
            color: #ddd;
            margin-bottom: 8px;
            font-weight: normal;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header-top {
                flex-direction: column;
                text-align: center;
            }
            
            .logo-container {
                margin-bottom: 15px;
            }
            
            .nav-container {
                justify-content: center;
            }
            
            .nav-links {
                flex-direction: column;
                width: 100%;
            }
            
            .nav-links li {
                text-align: center;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .sports-container {
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
                    <img src="https://media.tukenya.ac.ke/general/logo.png" alt="Technical University of Kenya Logo" class="logo">
                    <div class="logo-text">Student Online Portal</div>
                </div>
                
                <!-- Navigation in the same container as logo -->
                <nav>
                    <ul class="nav-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="admin.php">Admin</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="registration.php">Registration</a></li>
                        <li><a href="schedule.php">Events</a></li>
                        <li><a href="blog.php">Blogs</a></li>                        
                        <li><a href="athletics.php" class="active">Athletics</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>ATHLETICS AT TU-K</h1>
            <p>Discover our competitive athletics programs, dedicated coaches, and talented student athletes representing the Technical University of Kenya in track and field events.</p>
        </div>
    </section>

    <!-- Athletics Section -->
    <section class="athletics-section">
        <div class="container">
            <h2 class="section-title">Our Athletics Programs</h2>
            
            <div class="sports-container">
                <?php foreach ($programs as $program): ?>
                <div class="sport-card">
                    <img src="<?php echo htmlspecialchars($program['image_url']); ?>" alt="<?php echo htmlspecialchars($program['name']); ?>" class="sport-image">
                    <div class="sport-content">
                        <h3 class="sport-title"><?php echo htmlspecialchars($program['name']); ?></h3>
                        <div class="sport-info">
                            <div class="info-item">
                                <span class="info-label">Registered Athletes:</span>
                                <span class="info-value"><?php echo $athlete_counts[$program['name']]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Coach:</span>
                                <span class="info-value"><?php echo htmlspecialchars($program['head_coach']); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Coaches:</span>
                                <span class="info-value"><?php echo htmlspecialchars($program['assistant_coaches']); ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value"><?php echo htmlspecialchars($program['year_integrated']); ?></span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Competition Medals</div>
                            <div class="stats-grid">
                                <div class="stat-item gold">
                                    <div>Gold</div>
                                    <div><?php echo $program['gold_medals']; ?></div>
                                </div>
                                <div class="stat-item silver">
                                    <div>Silver</div>
                                    <div><?php echo $program['silver_medals']; ?></div>
                                </div>
                                <div class="stat-item bronze">
                                    <div>Bronze</div>
                                    <div><?php echo $program['bronze_medals']; ?></div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="<?php echo htmlspecialchars($program['name']); ?>">
                            Register for <?php echo htmlspecialchars($program['name']); ?>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Registration Modal -->
    <div class="modal" id="registration-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Register for <span id="sport-name"></span></h3>
                <button class="modal-close" id="registration-close">&times;</button>
            </div>
            <div class="modal-body">
                <?php if (isset($registration_success) && $registration_success): ?>
                    <div class="success-message">
                        <h4>Registration Successful!</h4>
                        <p>Thank you for registering for <?php echo $success_sport; ?>. Our coach will contact you shortly with training schedule details.</p>
                    </div>
                <?php elseif (isset($registration_error)): ?>
                    <div class="error-message">
                        <h4>Registration Error</h4>
                        <p><?php echo $registration_error; ?></p>
                    </div>
                <?php endif; ?>
                
                <form id="registration-form" method="POST" action="">
                    <input type="hidden" id="selected-sport" name="selected-sport">
                    <input type="hidden" name="submit-registration" value="1">
                    
                    <div class="form-group">
                        <label for="student-name">Full Name *</label>
                        <input type="text" id="student-name" name="student-name" value="<?php echo isset($_POST['student-name']) ? htmlspecialchars($_POST['student-name']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-id">Student ID/Registration Number *</label>
                        <input type="text" id="student-id" name="student-id" placeholder="SCCJ/00651/2023" value="<?php echo isset($_POST['student-id']) ? htmlspecialchars($_POST['student-id']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-email">Email Address *</label>
                        <input type="email" id="student-email" name="student-email" value="<?php echo isset($_POST['student-email']) ? htmlspecialchars($_POST['student-email']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-phone">Phone Number *</label>
                        <input type="tel" id="student-phone" name="student-phone" value="<?php echo isset($_POST['student-phone']) ? htmlspecialchars($_POST['student-phone']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-year">Year of Study *</label>
                        <select id="student-year" name="student-year" required>
                            <option value="">Select Year</option>
                            <option value="1st Year" <?php echo (isset($_POST['student-year']) && $_POST['student-year'] == '1st Year') ? 'selected' : ''; ?>>1st Year</option>
                            <option value="2nd Year" <?php echo (isset($_POST['student-year']) && $_POST['student-year'] == '2nd Year') ? 'selected' : ''; ?>>2nd Year</option>
                            <option value="3rd Year" <?php echo (isset($_POST['student-year']) && $_POST['student-year'] == '3rd Year') ? 'selected' : ''; ?>>3rd Year</option>
                            <option value="4th Year" <?php echo (isset($_POST['student-year']) && $_POST['student-year'] == '4th Year') ? 'selected' : ''; ?>>4th Year</option>
                            <option value="5th Year" <?php echo (isset($_POST['student-year']) && $_POST['student-year'] == '5th Year') ? 'selected' : ''; ?>>5th Year</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-course">Course/Program *</label>
                        <input type="text" id="student-course" name="student-course" value="<?php echo isset($_POST['student-course']) ? htmlspecialchars($_POST['student-course']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="experience-level">Previous Experience Level</label>
                        <select id="experience-level" name="experience-level">
                            <option value="Beginner" <?php echo (isset($_POST['experience-level']) && $_POST['experience-level'] == 'Beginner') ? 'selected' : ''; ?>>Beginner (No prior experience)</option>
                            <option value="Intermediate" <?php echo (isset($_POST['experience-level']) && $_POST['experience-level'] == 'Intermediate') ? 'selected' : ''; ?>>Intermediate (School/Club level)</option>
                            <option value="Advanced" <?php echo (isset($_POST['experience-level']) && $_POST['experience-level'] == 'Advanced') ? 'selected' : ''; ?>>Advanced (County/Regional level)</option>
                            <option value="Expert" <?php echo (isset($_POST['experience-level']) && $_POST['experience-level'] == 'Expert') ? 'selected' : ''; ?>>Expert (National/International level)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="preferred-event">Preferred Event/Discipline</label>
                        <input type="text" id="preferred-event" name="preferred-event" placeholder="e.g., 100m, Long Jump, Javelin, etc." value="<?php echo isset($_POST['preferred-event']) ? htmlspecialchars($_POST['preferred-event']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="personal-best">Personal Best Record (if any)</label>
                        <input type="text" id="personal-best" name="personal-best" placeholder="e.g., 100m: 11.2s, Long Jump: 6.5m" value="<?php echo isset($_POST['personal-best']) ? htmlspecialchars($_POST['personal-best']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="medical-notes">Medical Conditions/Notes</label>
                        <textarea id="medical-notes" name="medical-notes" placeholder="Please disclose any medical conditions or allergies..."><?php echo isset($_POST['medical-notes']) ? htmlspecialchars($_POST['medical-notes']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="emergency-contact">Emergency Contact Name & Number *</label>
                        <input type="text" id="emergency-contact" name="emergency-contact" value="<?php echo isset($_POST['emergency-contact']) ? htmlspecialchars($_POST['emergency-contact']) : ''; ?>" required>
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Registration</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <!-- Student Downloads -->
                <div class="footer-section">
                    <h3>Student Downloads</h3>
                    <ul class="footer-links">
                        <li><a href="#">Academic Calendar 2021</a></li>
                        <li><a href="#">Reopening of the University October 2020</a></li>
                        <li><a href="#">Position paper on Automation Processes</a></li>
                        <li><a href="#">Teaching Timetable</a></li>
                        <li><a href="#">Registration Form</a></li>
                        <li><a href="#">Download Joining Instructions</a></li>
                        <li><a href="#">SATUK 2019/2020 Office Bearers</a></li>
                        <li><a href="#">SATUK 2016/2017 Office Bearers</a></li>
                        <li><a href="#">SATUK Constitution, 2018 (Revised 2024)</a></li>
                        <li><a href="#">Recommended List of Private Hostels</a></li>
                        <li><a href="#">2016 List of Graduands</a></li>
                    </ul>
                </div>
                
                <!-- Special Websites -->
                <div class="footer-section">
                    <h3>Special Websites</h3>
                    <ul class="footer-links">
                        <li><a href="#">TU-K Main Website</a></li>
                        <li><a href="#">TU-K Library Website</a></li>
                        <li><a href="#">E-Learning Portal</a></li>
                        <li><a href="#">Students Fees Portal</a></li>
                        <li><a href="#">Online Application Portal</a></li>
                        <li><a href="#">Staff ePortal</a></li>
                        <li><a href="#">TU-K Digital Repository Website</a></li>
                        <li><a href="#">Students Official Email through Google</a></li>
                    </ul>
                    
                    <h3>Join our Social Network</h3>
                    <div class="social-icons">
                        <a href="https://share.google/NFgvH29H2Kriw429W" class="social-icon">facebook</a>
                        <a href="https://share.google/5Gx0rIvAawYy6bnZi" class="social-icon">X twitter</a>
                        <a href="https://share.google/etsFEQAEl1z4JbRqL" class="social-icon">Instagram</a>
                        <a href="https://web.whatsapp.com/" class="social-icon">Whatsapp</a>
                    </div>
                </div>
                
                <!-- Core Services -->
                <div class="footer-section">
                    <h3>Core Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Request for Amendments</a></li>
                        <li><a href="#">Examinations</a></li>
                        <li><a href="#">Pay for TU-K Services</a></li>
                        <li><a href="#">Fee Statement</a></li>
                        <li><a href="#">Download Certificate Collection Form</a></li>
                        <li><a href="#">Timetable Download</a></li>
                        <li><a href="#">Book Room</a></li>
                        <li><a href="#">Sign Nominal Roll</a></li>
                        <li><a href="#">Graduation Clearance</a></li>
                    </ul>
                </div>
                
                <!-- General Services -->
                <div class="footer-section">
                    <h3>General Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Rattansi Bursary</a></li>
                        <li><a href="#">Joe Wanjui Bursary</a></li>
                        <li><a href="#">Student ID</a></li>
                        <li><a href="#">Student Evaluation</a></li>
                        <li><a href="#">Register Club</a></li>
                        <li><a href="#">SATUK Elections</a></li>
                        <li><a href="#">Class Rep</a></li>
                        <li><a href="#">SATUK Bursary</a></li>
                        <li><a href="#">Register as Alumni</a></li>
                        <li><a href="#">Apply for Deferment</a></li>
                        <li><a href="#">Special Exams</a></li>
                        <li><a href="#">Reinstatement</a></li>
                        <li><a href="#">Supplimentary/Repeat of Failed Units</a></li>
                        <li><a href="#">Mid-Stream Clearance</a></li>
                        <li><a href="#">Fees Refunds</a></li>
                        <li><a href="#">Attachment letter</a></li>
                    </ul>
                </div>
                
                <!-- Contact Information -->
                <div class="footer-section contact-info">
                    <h3>Contact Information</h3>
                    <p>TUK Logo Image</p>
                    <p>P.O. Box 52428 - 00200</p>
                    <p>Nairobi- Kenya.</p>
                    <p>Located along Haile Selassie Avenue</p>
                    <p>Tel: +254(020) 2219929, 3341639, 3343672</p>
                    <p>Email:</p>
                    <p>General inquiries: info@tukenya.ac.ke</p>
                    <p>Feedback/Complaints/Suggestions: customercare@tukenya.ac.ke</p>
                    <p>Official Communication: vc@tukenya.ac.ke</p>
                    <p>TUK ISO Image</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>Powered by Directorate of ICT Services. Copyright © 2012 - 2025 The Technical University of Kenya. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registrationModal = document.getElementById('registration-modal');
            const registrationClose = document.getElementById('registration-close');
            const registrationForm = document.getElementById('registration-form');
            const sportNameElement = document.getElementById('sport-name');
            const selectedSportInput = document.getElementById('selected-sport');
            const modalTitle = document.getElementById('modal-title');
            
            // Get all register buttons
            const registerButtons = document.querySelectorAll('.register-btn');
            
            // Add event listeners to register buttons
            registerButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const sport = this.getAttribute('data-sport');
                    openRegistrationModal(sport);
                });
            });
            
            // Function to open registration modal
            function openRegistrationModal(sport) {
                sportNameElement.textContent = sport;
                selectedSportInput.value = sport;
                modalTitle.textContent = `Register for ${sport}`;
                registrationModal.style.display = 'flex';
                registrationForm.reset();
                registrationForm.style.display = 'block';
            }
            
            // Close modal when clicking close button
            registrationClose.addEventListener('click', function() {
                registrationModal.style.display = 'none';
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === registrationModal) {
                    registrationModal.style.display = 'none';
                }
            });
            
            // Auto-open modal if there was a form submission error
            <?php if (isset($registration_error) && !empty($_POST)): ?>
                const sport = "<?php echo $_POST['selected-sport'] ?? ''; ?>";
                if (sport) {
                    openRegistrationModal(sport);
                }
            <?php endif; ?>
        });
    </script>
</body>
</html>