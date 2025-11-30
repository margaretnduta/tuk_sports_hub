<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Games - Technical University of Kenya</title>
    <style>
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
            background: linear-gradient(rgba(0, 51, 102, 0.8), rgba(0, 51, 102, 0.8)), url('https://images.unsplash.com/photo-1611195974226-a6a9be9dd763?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=725');
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
        
        /* Board Games Section */
        .board-games-section {
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
        
        .games-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .game-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .game-card:hover {
            transform: translateY(-5px);
        }
        
        .game-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .game-content {
            padding: 25px;
        }
        
        .game-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #003366;
            border-bottom: 2px solid #f0f8ff;
            padding-bottom: 10px;
        }
        
        .game-info {
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
        
        .wins {
            background-color: #d4edda;
            color: #155724;
        }
        
        .losses {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .draws {
            background-color: #fff3cd;
            color: #856404;
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
            
            .games-container {
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
                        <li><a href="board-games.php" class="active">Board Games</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>BOARD GAMES AT TU-K</h1>
            <p>Challenge your mind and develop strategic thinking through our competitive board games programs at the Technical University of Kenya.</p>
        </div>
    </section>

    <!-- Board Games Section -->
    <section class="board-games-section">
        <div class="container">
            <h2 class="section-title">Our Board Games Programs</h2>
            
            <div class="games-container">
                <!-- Chess -->
                <div class="game-card">
                    <img src="https://images.unsplash.com/photo-1586165368502-1bad197a6461?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Chess" class="game-image">
                    <div class="game-content">
                        <h3 class="game-title">Chess</h3>
                        <div class="game-info">
                            <div class="info-item">
                                <span class="info-label">Registered Players:</span>
                                <span class="info-value">22</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Coach:</span>
                                <span class="info-value">Coach Mwangi</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Coaches:</span>
                                <span class="info-value">Coach Kamau</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2012</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Tournament Record</div>
                            <div class="stats-grid">
                                <div class="stat-item wins">
                                    <div>Wins</div>
                                    <div>45</div>
                                </div>
                                <div class="stat-item losses">
                                    <div>Losses</div>
                                    <div>12</div>
                                </div>
                                <div class="stat-item draws">
                                    <div>Draws</div>
                                    <div>8</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Chess">Register for Chess</button>
                    </div>
                </div>
                
                <!-- Checkers -->
                <div class="game-card">
                    <img src="https://images.unsplash.com/photo-1590479773265-7464e5d48118?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Checkers" class="game-image">
                    <div class="game-content">
                        <h3 class="game-title">Checkers</h3>
                        <div class="game-info">
                            <div class="info-item">
                                <span class="info-label">Registered Players:</span>
                                <span class="info-value">18</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Coach:</span>
                                <span class="info-value">Coach Ochieng</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Coaches:</span>
                                <span class="info-value">Coach Adhiambo</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2013</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Tournament Record</div>
                            <div class="stats-grid">
                                <div class="stat-item wins">
                                    <div>Wins</div>
                                    <div>38</div>
                                </div>
                                <div class="stat-item losses">
                                    <div>Losses</div>
                                    <div>15</div>
                                </div>
                                <div class="stat-item draws">
                                    <div>Draws</div>
                                    <div>7</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Checkers">Register for Checkers</button>
                    </div>
                </div>
                
                <!-- Scrabble -->
                <div class="game-card">
                    <img src="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Scrabble" class="game-image">
                    <div class="game-content">
                        <h3 class="game-title">Scrabble</h3>
                        <div class="game-info">
                            <div class="info-item">
                                <span class="info-label">Registered Players:</span>
                                <span class="info-value">20</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Coach:</span>
                                <span class="info-value">Coach Wanjiku</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Coaches:</span>
                                <span class="info-value">Coach Mumbi</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2014</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Tournament Record</div>
                            <div class="stats-grid">
                                <div class="stat-item wins">
                                    <div>Wins</div>
                                    <div>42</div>
                                </div>
                                <div class="stat-item losses">
                                    <div>Losses</div>
                                    <div>18</div>
                                </div>
                                <div class="stat-item draws">
                                    <div>Draws</div>
                                    <div>5</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Scrabble">Register for Scrabble</button>
                    </div>
                </div>
                
                <!-- Monopoly -->
                <div class="game-card">
                    <img src="https://images.unsplash.com/photo-1632501641765-e568d28b0019?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Monopoly" class="game-image">
                    <div class="game-content">
                        <h3 class="game-title">Monopoly</h3>
                        <div class="game-info">
                            <div class="info-item">
                                <span class="info-label">Registered Players:</span>
                                <span class="info-value">16</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Coach:</span>
                                <span class="info-value">Coach Kipchoge</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Coaches:</span>
                                <span class="info-value">Coach Chebet</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2015</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Tournament Record</div>
                            <div class="stats-grid">
                                <div class="stat-item wins">
                                    <div>Wins</div>
                                    <div>35</div>
                                </div>
                                <div class="stat-item losses">
                                    <div>Losses</div>
                                    <div>20</div>
                                </div>
                                <div class="stat-item draws">
                                    <div>Draws</div>
                                    <div>3</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Monopoly">Register for Monopoly</button>
                    </div>
                </div>
                
                <!-- Backgammon -->
                <div class="game-card">
                    <img src="https://images.unsplash.com/photo-1611575330085-91a027b5d46e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Backgammon" class="game-image">
                    <div class="game-content">
                        <h3 class="game-title">Backgammon</h3>
                        <div class="game-info">
                            <div class="info-item">
                                <span class="info-label">Registered Players:</span>
                                <span class="info-value">12</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Coach:</span>
                                <span class="info-value">Coach Nyongesa</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Coaches:</span>
                                <span class="info-value">Coach Achieng</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2016</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Tournament Record</div>
                            <div class="stats-grid">
                                <div class="stat-item wins">
                                    <div>Wins</div>
                                    <div>28</div>
                                </div>
                                <div class="stat-item losses">
                                    <div>Losses</div>
                                    <div>15</div>
                                </div>
                                <div class="stat-item draws">
                                    <div>Draws</div>
                                    <div>4</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Backgammon">Register for Backgammon</button>
                    </div>
                </div>
                
                <!-- Strategic Games -->
                <div class="game-card">
                    <img src="https://images.unsplash.com/photo-1617129724621-84c156e131d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Strategic Games" class="game-image">
                    <div class="game-content">
                        <h3 class="game-title">Strategic Games</h3>
                        <div class="game-info">
                            <div class="info-item">
                                <span class="info-label">Registered Players:</span>
                                <span class="info-value">14</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Head Coach:</span>
                                <span class="info-value">Coach Wairimu</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assistant Coaches:</span>
                                <span class="info-value">Coach Otieno</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Year Integrated:</span>
                                <span class="info-value">2017</span>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-title">Tournament Record</div>
                            <div class="stats-grid">
                                <div class="stat-item wins">
                                    <div>Wins</div>
                                    <div>32</div>
                                </div>
                                <div class="stat-item losses">
                                    <div>Losses</div>
                                    <div>18</div>
                                </div>
                                <div class="stat-item draws">
                                    <div>Draws</div>
                                    <div>6</div>
                                </div>
                            </div>
                        </div>
                        <button class="register-btn" data-sport="Strategic Games">Register for Strategic Games</button>
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
                <form id="registration-form">
                    <input type="hidden" id="selected-sport" name="selected-sport">
                    
                    <div class="form-group">
                        <label for="student-name">Full Name *</label>
                        <input type="text" id="student-name" name="student-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-id">Student ID/Registration Number *</label>
                        <input type="text" id="student-id" name="student-id" placeholder="SCCJ/00651/2023" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-email">Email Address *</label>
                        <input type="email" id="student-email" name="student-email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-phone">Phone Number *</label>
                        <input type="tel" id="student-phone" name="student-phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-year">Year of Study *</label>
                        <select id="student-year" name="student-year" required>
                            <option value="">Select Year</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                            <option value="5th Year">5th Year</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="student-course">Course/Program *</label>
                        <input type="text" id="student-course" name="student-course" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="experience-level">Previous Experience Level</label>
                        <select id="experience-level" name="experience-level">
                            <option value="Beginner">Beginner (No prior experience)</option>
                            <option value="Intermediate">Intermediate (Casual player)</option>
                            <option value="Advanced">Advanced (Club/Tournament experience)</option>
                            <option value="Expert">Expert (Competitive player)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="preferred-style">Preferred Playing Style/Strategy</label>
                        <input type="text" id="preferred-style" name="preferred-style" placeholder="e.g., Aggressive, Defensive, Balanced">
                    </div>
                    
                    <div class="form-group">
                        <label for="tournament-experience">Previous Tournament Experience</label>
                        <textarea id="tournament-experience" name="tournament-experience" placeholder="List any previous tournaments or competitions you've participated in..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="availability">Preferred Practice Days/Times</label>
                        <input type="text" id="availability" name="availability" placeholder="e.g., Weekdays after 4pm, Saturday mornings">
                    </div>
                    
                    <div class="form-group">
                        <label for="emergency-contact">Emergency Contact Name & Number *</label>
                        <input type="text" id="emergency-contact" name="emergency-contact" required>
                    </div>
                    
                    <button type="submit" class="submit-btn">Submit Registration</button>
                </form>
                
                <div class="success-message" id="success-message">
                    <h4>Registration Successful!</h4>
                    <p>Thank you for registering for <span id="success-sport"></span>. Our coach will contact you shortly with practice schedule details.</p>
                </div>
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
            const successMessage = document.getElementById('success-message');
            const successSportElement = document.getElementById('success-sport');
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
                successMessage.style.display = 'none';
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
            
            // Handle form submission
            registrationForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(this);
                const registrationData = {
                    sport: formData.get('selected-sport'),
                    name: formData.get('student-name'),
                    studentId: formData.get('student-id'),
                    email: formData.get('student-email'),
                    phone: formData.get('student-phone'),
                    year: formData.get('student-year'),
                    course: formData.get('student-course'),
                    experience: formData.get('experience-level'),
                    preferredStyle: formData.get('preferred-style'),
                    tournamentExperience: formData.get('tournament-experience'),
                    availability: formData.get('availability'),
                    emergency: formData.get('emergency-contact'),
                    timestamp: new Date().toISOString()
                };
                
                // Save to localStorage
                saveRegistration(registrationData);
                
                // Show success message
                successSportElement.textContent = registrationData.sport;
                registrationForm.style.display = 'none';
                successMessage.style.display = 'block';
                
                // Update player count for the specific sport
                updatePlayerCount(registrationData.sport);
                
                // Close modal after 3 seconds
                setTimeout(() => {
                    registrationModal.style.display = 'none';
                }, 3000);
            });
            
            // Function to save registration to localStorage
            function saveRegistration(registrationData) {
                let registrations = JSON.parse(localStorage.getItem('tuk_board_games_registrations')) || [];
                registrations.push(registrationData);
                localStorage.setItem('tuk_board_games_registrations', JSON.stringify(registrations));
            }
            
            // Function to update player count for a specific sport
            function updatePlayerCount(sport) {
                // Get current registrations
                const registrations = JSON.parse(localStorage.getItem('tuk_board_games_registrations')) || [];
                
                // Count registrations for this sport
                const sportRegistrations = registrations.filter(reg => reg.sport === sport);
                const playerCount = sportRegistrations.length;
                
                // Update the displayed player count for this sport
                const gameCards = document.querySelectorAll('.game-card');
                gameCards.forEach(card => {
                    const title = card.querySelector('.game-title').textContent;
                    if (title === sport) {
                        const playerCountElement = card.querySelector('.info-item:first-child .info-value');
                        // Add 1 to account for the new registration
                        playerCountElement.textContent = parseInt(playerCountElement.textContent) + 1;
                    }
                });
            }
            
            // Initialize player counts from localStorage on page load
            function initializePlayerCounts() {
                const registrations = JSON.parse(localStorage.getItem('tuk_board_games_registrations')) || [];
                const sports = ['Chess', 'Checkers', 'Scrabble', 'Monopoly', 'Backgammon', 'Strategic Games'];
                
                sports.forEach(sport => {
                    const sportRegistrations = registrations.filter(reg => reg.sport === sport);
                    const playerCount = sportRegistrations.length;
                    
                    if (playerCount > 0) {
                        const gameCards = document.querySelectorAll('.game-card');
                        gameCards.forEach(card => {
                            const title = card.querySelector('.game-title').textContent;
                            if (title === sport) {
                                const playerCountElement = card.querySelector('.info-item:first-child .info-value');
                                // Add base count + registrations
                                const baseCount = parseInt(playerCountElement.textContent);
                                playerCountElement.textContent = baseCount + playerCount;
                            }
                        });
                    }
                });
            }
            
            // Initialize player counts when page loads
            initializePlayerCounts();
        });
    </script>
</body>
</html>
