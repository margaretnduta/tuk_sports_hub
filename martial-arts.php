<?php
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
        'experience' => $_POST['experience-level'] ?? '',
        'belt_rank' => $_POST['belt-rank'] ?? '',
        'training_goals' => $_POST['training-goals'] ?? '',
        'medical_conditions' => $_POST['medical-conditions'] ?? '',
        'emergency_contact' => $_POST['emergency-contact'] ?? '',
        'waiver' => isset($_POST['waiver']) ? 'Accepted' : 'Not Accepted',
        'timestamp' => date('Y-m-d H:i:s')
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
    
    if ($valid && $registration_data['waiver'] === 'Accepted') {
        // Save to file (you can modify this to save to database)
        $result = saveRegistration($registration_data);
        
        if ($result) {
            $registration_success = true;
            $success_sport = $registration_data['sport'];
        } else {
            $registration_error = "Failed to save registration. Please try again.";
        }
    } else {
        $registration_error = "Please fill all required fields and accept the waiver.";
    }
}

// Function to save registration to file
function saveRegistration($data) {
    $filename = 'martial_arts_registrations.csv';
    
    // Create file if it doesn't exist and add headers
    if (!file_exists($filename)) {
        $headers = array_keys($data);
        $file = fopen($filename, 'w');
        fputcsv($file, $headers);
        fclose($file);
    }
    
    // Append data
    $file = fopen($filename, 'a');
    $result = fputcsv($file, $data);
    fclose($file);
    
    return $result !== false;
}

// Function to get registration count for a specific martial art
function getRegistrationCount($sport) {
    $filename = 'martial_arts_registrations.csv';
    
    if (!file_exists($filename)) {
        return 0;
    }
    
    $count = 0;
    $file = fopen($filename, 'r');
    
    // Skip header
    fgetcsv($file);
    
    while (($data = fgetcsv($file)) !== FALSE) {
        if (isset($data[0]) && $data[0] === $sport) {
            $count++;
        }
    }
    
    fclose($file);
    return $count;
}

// Get current registration counts
$karate_count = 25 + getRegistrationCount('Karate');
$taekwondo_count = 28 + getRegistrationCount('Taekwondo');
$judo_count = 20 + getRegistrationCount('Judo');
$kungfu_count = 18 + getRegistrationCount('Kung Fu');
$aikido_count = 15 + getRegistrationCount('Aikido');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Martial Arts - Technical University of Kenya</title>
    <style>
        /* Your existing CSS styles here */
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
            background: linear-gradient(rgba(0, 51, 102, 0.8), rgba(0, 51, 102, 0.8)), url('https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
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
        
        /* Martial Arts Section */
        .martial-arts-section {
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
        
        .arts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .art-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .art-card:hover {
            transform: translateY(-5px);
        }
        
        .art-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .art-content {
            padding: 25px;
        }
        
        .art-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #003366;
            border-bottom: 2px solid #f0f8ff;
            padding-bottom: 10px;
        }
        
        .art-info {
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
        
        /* Success Message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            text-align: center;
            display: none;
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
            
            .arts-container {
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
                        <li><a href="ball-games.php">Ball Games</a></li>
                        <li><a href="athletics.php">Athletics</a></li>
                        <li><a href="board-games.php">Board Games</a></li>
                        <li><a href="martial-arts.php" class="active">Martial Arts</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>MARTIAL ARTS AT TU-K</h1>
            <p>Develop discipline, strength, and self-defense skills through our comprehensive martial arts programs at the Technical University of Kenya.</p>
        </div>
    </section>

    <!-- Martial Arts Section -->
    <section class="martial-arts-section">
        <div class="container">
            <h2 class="section-title">Our Martial Arts Programs</h2>
            
            <div class="arts-container">
                <!-- Karate -->
                <div class="art-card">
                    <img src="https://www.shutterstock.com/image-photo/africanamerican-caucasian-men-kimono-belts-600nw-2095092028.jpg" alt="Karate" class="art-image">
                    <div class="art-content">
                        <h3 class="art-title">Karate</h3>
                        <div class="art-info">
                            <div class="info-item">
                                <span class="info-label">Registered Students:</span>
                                <span class="info-value"><?php echo $karate_count; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Instructor:</span>
                                <span class="info-value">Sensei Wanjiku</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Instructors:</span>
                                <span class="info-value">Sensei Otieno, Sensei Mumbi</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2010</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Competition Medals</div>
                            <div class="stats-grid">
                                <div class="stat-item gold">
                                    <div>Gold</div>
                                    <div>38</div>
                                </div>
                                <div class="stat-item silver">
                                    <div>Silver</div>
                                    <div>22</div>
                                </div>
                                <div class="stat-item bronze">
                                    <div>Bronze</div>
                                    <div>15</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Karate">Register for Karate</button>
                    </div>
                </div>
                
                <!-- Taekwondo -->
                <div class="art-card">
                    <img src="https://www.shutterstock.com/image-photo/young-african-american-man-training-600nw-2167501369.jpg" alt="Taekwondo" class="art-image">
                    <div class="art-content">
                        <h3 class="art-title">Taekwondo</h3>
                        <div class="art-info">
                            <div class="info-item">
                                <span class="info-label">Registered Students:</span>
                                <span class="info-value"><?php echo $taekwondo_count; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Instructor:</span>
                                <span class="info-value">Master Kimani</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Instructors:</span>
                                <span class="info-value">Master Chebet</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2011</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Competition Medals</div>
                            <div class="stats-grid">
                                <div class="stat-item gold">
                                    <div>Gold</div>
                                    <div>42</div>
                                </div>
                                <div class="stat-item silver">
                                    <div>Silver</div>
                                    <div>18</div>
                                </div>
                                <div class="stat-item bronze">
                                    <div>Bronze</div>
                                    <div>12</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Taekwondo">Register for Taekwondo</button>
                    </div>
                </div>
                
                <!-- Judo -->
                <div class="art-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQg3d_dzDFNKFdx5ZOO3peBBnl7FYDugGNE-A&s" alt="Judo" class="art-image">
                    <div class="art-content">
                        <h3 class="art-title">Judo</h3>
                        <div class="art-info">
                            <div class="info-item">
                                <span class="info-label">Registered Students:</span>
                                <span class="info-value"><?php echo $judo_count; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Instructor:</span>
                                <span class="info-value">Sensei Mwangi</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Instructors:</span>
                                <span class="info-value">Sensei Adhiambo</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2012</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Competition Medals</div>
                            <div class="stats-grid">
                                <div class="stat-item gold">
                                    <div>Gold</div>
                                    <div>35</div>
                                </div>
                                <div class="stat-item silver">
                                    <div>Silver</div>
                                    <div>20</div>
                                </div>
                                <div class="stat-item bronze">
                                    <div>Bronze</div>
                                    <div>10</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Judo">Register for Judo</button>
                    </div>
                </div>
                
                <!-- Kung Fu -->
                <div class="art-card">
                    <img src="https://www.shutterstock.com/shutterstock/photos/20821537/display_1500/stock-photo-african-american-man-in-a-kung-fu-black-suit-20821537.jpg" alt="Kung Fu" class="art-image">
                    <div class="art-content">
                        <h3 class="art-title">Kung Fu</h3>
                        <div class="art-info">
                            <div class="info-item">
                                <span class="info-label">Registered Students:</span>
                                <span class="info-value"><?php echo $kungfu_count; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Instructor:</span>
                                <span class="info-value">Sifu Ochieng</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Instructors:</span>
                                <span class="info-value">Sifu Wanjiru</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2013</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Competition Medals</div>
                            <div class="stats-grid">
                                <div class="stat-item gold">
                                    <div>Gold</div>
                                    <div>28</div>
                                </div>
                                <div class="stat-item silver">
                                    <div>Silver</div>
                                    <div>15</div>
                                </div>
                                <div class="stat-item bronze">
                                    <div>Bronze</div>
                                    <div>8</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Kung Fu">Register for Kung Fu</button>
                    </div>
                </div>
                
                <!-- Aikido -->
                <div class="art-card">
                    <img src="https://media.istockphoto.com/id/1393100211/vector/aikido-fighters-martial-arts-inscription-on-illustration-is-a-hieroglyphs-of-aikido-japanese.jpg?s=612x612&w=0&k=20&c=QRvibQSGhazNO2c-PPO-TaAU1FxzDsK4-AlgPYSwvh8=" alt="Aikido" class="art-image">
                    <div class="art-content">
                        <h3 class="art-title">Aikido</h3>
                        <div class="art-info">
                            <div class="info-item">
                                <span class="info-label">Registered Students:</span>
                                <span class="info-value"><?php echo $aikido_count; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Instructor:</span>
                                <span class="info-value">Sensei Kiprop</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Instructors:</span>
                                <span class="info-value">Sensei Njeri</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2014</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Competition Medals</div>
                            <div class="stats-grid">
                                <div class="stat-item gold">
                                    <div>Gold</div>
                                    <div>22</div>
                                </div>
                                <div class="stat-item silver">
                                    <div>Silver</div>
                                    <div>12</div>
                                </div>
                                <div class="stat-item bronze">
                                    <div>Bronze</div>
                                    <div>6</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Aikido">Register for Aikido</button>
                    </div>
                </div>
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
                        <p>Thank you for registering for <?php echo $success_sport; ?>. Our instructor will contact you shortly with training schedule details.</p>
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
                            <option value="Intermediate" <?php echo (isset($_POST['experience-level']) && $_POST['experience-level'] == 'Intermediate') ? 'selected' : ''; ?>>Intermediate (Some training)</option>
                            <option value="Advanced" <?php echo (isset($_POST['experience-level']) && $_POST['experience-level'] == 'Advanced') ? 'selected' : ''; ?>>Advanced (Regular practice)</option>
                            <option value="Expert" <?php echo (isset($_POST['experience-level']) && $_POST['experience-level'] == 'Expert') ? 'selected' : ''; ?>>Expert (Belt rank/Competition experience)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="belt-rank">Current Belt Rank (if any)</label>
                        <input type="text" id="belt-rank" name="belt-rank" placeholder="e.g., White Belt, Yellow Belt, Green Belt, etc." value="<?php echo isset($_POST['belt-rank']) ? htmlspecialchars($_POST['belt-rank']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="training-goals">Training Goals & Objectives</label>
                        <textarea id="training-goals" name="training-goals" placeholder="What do you hope to achieve through martial arts training?"><?php echo isset($_POST['training-goals']) ? htmlspecialchars($_POST['training-goals']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="medical-conditions">Medical Conditions/Injuries</label>
                        <textarea id="medical-conditions" name="medical-conditions" placeholder="Please disclose any medical conditions, injuries, or physical limitations..."><?php echo isset($_POST['medical-conditions']) ? htmlspecialchars($_POST['medical-conditions']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="emergency-contact">Emergency Contact Name & Number *</label>
                        <input type="text" id="emergency-contact" name="emergency-contact" value="<?php echo isset($_POST['emergency-contact']) ? htmlspecialchars($_POST['emergency-contact']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="waiver" <?php echo isset($_POST['waiver']) ? 'checked' : ''; ?> required>
                            I understand and accept the risks involved in martial arts training *
                        </label>
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
                <p>Powered by Directorate of ICT Services. Copyright Â© 2012 - 2025 The Technical University of Kenya. All Rights Reserved.</p>
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
