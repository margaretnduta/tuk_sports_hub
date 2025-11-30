<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Technical University of Kenya Sports</title>
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
        
        /* Registration Section */
        .registration-section {
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
        
        .registration-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .role-selection {
            display: flex;
            border-bottom: 1px solid #ddd;
        }
        
        .role-option {
            flex: 1;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            background-color: #f0f8ff;
        }
        
        .role-option.active {
            background-color: #003366;
            color: white;
        }
        
        .role-option h3 {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .registration-form {
            padding: 40px;
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
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            color: #000000;
        }
        
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #003366;
        }
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
        }
        
        .password-requirements {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
        }
        
        .requirement-list {
            list-style: none;
            margin-top: 5px;
        }
        
        .requirement-item {
            display: flex;
            align-items: center;
            margin-bottom: 3px;
        }
        
        .requirement-icon {
            margin-right: 5px;
            font-size: 0.8rem;
        }
        
        .requirement-met {
            color: #2E8B57;
        }
        
        .requirement-not-met {
            color: #cc0000;
        }
        
        .error-message {
            color: #cc0000;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }
        
        .register-button {
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
            margin-top: 20px;
        }
        
        .register-button:hover {
            background-color: #26734d;
        }
        
        .form-disclaimer {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f8ff;
            border-radius: 4px;
            font-size: 0.9rem;
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
            
            .role-selection {
                flex-direction: column;
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
                        <li><a href="registration.php" class="active">Registration</a></li>
                        <li><a href="schedule.php">Events</a></li>                        
                        <li><a href="blog.php">Blogs</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Registration Section -->
    <section class="registration-section">
        <div class="container">
            <h2 class="section-title">Sports Registration</h2>
            <div class="registration-container">
                <div class="role-selection">
                    <div class="role-option active" id="player-option">
                        <h3>Register as Player</h3>
                        <p>For students who want to participate in sports</p>
                    </div>
                    <div class="role-option" id="coach-option">
                        <h3>Register as Coach</h3>
                        <p>For staff who want to coach sports teams</p>
                    </div>
                </div>
                
                <!-- Player Registration Form -->
                <form class="registration-form" id="player-form">
                    <div class="form-group">
                        <label for="player-fullname">Full Name *</label>
                        <input type="text" id="player-fullname" name="player-fullname" required>
                        <div class="error-message" id="player-name-error">Please enter your full name</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="player-regnumber">Course Registration Number *</label>
                        <input type="text" id="player-regnumber" name="player-regnumber" required>
                        <div class="error-message" id="player-reg-error">Please enter your registration number</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="player-contact">Contact Number *</label>
                        <input type="tel" id="player-contact" name="player-contact" required>
                        <div class="error-message" id="player-contact-error">Please enter a valid contact number</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="player-email">School Email Address *</label>
                        <input type="email" id="player-email" name="player-email" placeholder="example@tukenya.ac.ke" required>
                        <div class="error-message" id="player-email-error">Please enter a valid TU-K email address (@tukenya.ac.ke)</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="player-sport">Sport You Wish to Play *</label>
                        <select id="player-sport" name="player-sport" required>
                            <option value="">Select a sport</option>
                            <option value="football">Football</option>
                            <option value="basketball">Basketball</option>
                            <option value="volleyball">Volleyball</option>
                            <option value="handball">Handball</option>
                            <option value="rugby">Rugby</option>
                            <option value="hockey">Hockey</option>
                            <option value="netball">Netball</option>
                            <option value="athletics">Athletics</option>
                            <option value="martial-arts">Martial Arts</option>
                            <option value="chess">Chess</option>
                            <option value="scrabble">Scrabble</option>
                        </select>
                        <div class="error-message" id="player-sport-error">Please select a sport</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="player-year">Year of Study *</label>
                        <select id="player-year" name="player-year" required>
                            <option value="">Select year</option>
                            <option value="1">Year 1</option>
                            <option value="2">Year 2</option>
                            <option value="3">Year 3</option>
                            <option value="4">Year 4</option>
                            <option value="5">Year 5</option>
                        </select>
                        <div class="error-message" id="player-year-error">Please select your year of study</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="player-password">Password *</label>
                        <div class="password-container">
                            <input type="password" id="player-password" name="player-password" required>
                            <button type="button" class="password-toggle" id="player-password-toggle">
                                ðŸ‘ï¸
                            </button>
                        </div>
                        <div class="password-requirements">
                            <p>Password must contain:</p>
                            <ul class="requirement-list" id="player-requirements">
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="player-length">âŒ</span>
                                    At least 8 characters
                                </li>
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="player-special">âŒ</span>
                                    At least 1 special character
                                </li>
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="player-digit">âŒ</span>
                                    At least 1 digit
                                </li>
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="player-capital">âŒ</span>
                                    At least 1 capital letter
                                </li>
                            </ul>
                        </div>
                        <div class="error-message" id="player-password-error">Password does not meet requirements</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="player-confirm-password">Confirm Password *</label>
                        <div class="password-container">
                            <input type="password" id="player-confirm-password" name="player-confirm-password" required>
                            <button type="button" class="password-toggle" id="player-confirm-toggle">
                                ðŸ‘ï¸
                            </button>
                        </div>
                        <div class="error-message" id="player-confirm-error">Passwords do not match</div>
                    </div>
                    
                    <button type="submit" class="register-button">Register as Player</button>
                    
                    <div class="form-disclaimer">
                        By registering, you agree to abide by the TU-K Sports Code of Conduct and understand that your information will be used for sports administration purposes only.
                    </div>
                </form>
                
                <!-- Coach Registration Form -->
                <form class="registration-form" id="coach-form" style="display: none;">
                    <div class="form-group">
                        <label for="coach-fullname">Full Name *</label>
                        <input type="text" id="coach-fullname" name="coach-fullname" required>
                        <div class="error-message" id="coach-name-error">Please enter your full name</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="coach-regnumber">Staff Registration Number *</label>
                        <input type="text" id="coach-regnumber" name="coach-regnumber" required>
                        <div class="error-message" id="coach-reg-error">Please enter your staff registration number</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="coach-contact">Contact Number *</label>
                        <input type="tel" id="coach-contact" name="coach-contact" required>
                        <div class="error-message" id="coach-contact-error">Please enter a valid contact number</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="coach-email">School Email Address *</label>
                        <input type="email" id="coach-email" name="coach-email" placeholder="example@tukenya.ac.ke" required>
                        <div class="error-message" id="coach-email-error">Please enter a valid TU-K email address (@tukenya.ac.ke)</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="coach-sport">Sport You Wish to Coach *</label>
                        <select id="coach-sport" name="coach-sport" required>
                            <option value="">Select a sport</option>
                            <option value="football">Football</option>
                            <option value="basketball">Basketball</option>
                            <option value="volleyball">Volleyball</option>
                            <option value="handball">Handball</option>
                            <option value="rugby">Rugby</option>
                            <option value="hockey">Hockey</option>
                            <option value="netball">Netball</option>
                            <option value="athletics">Athletics</option>
                            <option value="martial-arts">Martial Arts</option>
                            <option value="chess">Chess</option>
                            <option value="scrabble">Scrabble</option>
                        </select>
                        <div class="error-message" id="coach-sport-error">Please select a sport</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="coach-password">Password *</label>
                        <div class="password-container">
                            <input type="password" id="coach-password" name="coach-password" required>
                            <button type="button" class="password-toggle" id="coach-password-toggle">
                                ðŸ‘ï¸
                            </button>
                        </div>
                        <div class="password-requirements">
                            <p>Password must contain:</p>
                            <ul class="requirement-list" id="coach-requirements">
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="coach-length">âŒ</span>
                                    At least 8 characters
                                </li>
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="coach-special">âŒ</span>
                                    At least 1 special character
                                </li>
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="coach-digit">âŒ</span>
                                    At least 1 digit
                                </li>
                                <li class="requirement-item">
                                    <span class="requirement-icon" id="coach-capital">âŒ</span>
                                    At least 1 capital letter
                                </li>
                            </ul>
                        </div>
                        <div class="error-message" id="coach-password-error">Password does not meet requirements</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="coach-confirm-password">Confirm Password *</label>
                        <div class="password-container">
                            <input type="password" id="coach-confirm-password" name="coach-confirm-password" required>
                            <button type="button" class="password-toggle" id="coach-confirm-toggle">
                                ðŸ‘ï¸
                            </button>
                        </div>
                        <div class="error-message" id="coach-confirm-error">Passwords do not match</div>
                    </div>
                    
                    <button type="submit" class="register-button">Register as Coach</button>
                    
                    <div class="form-disclaimer">
                        By registering, you agree to abide by the TU-K Sports Code of Conduct and understand that your information will be used for sports administration purposes only.
                    </div>
                </form>
            </div>
        </div>
    </section>

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
                        <a href="#" class="social-icon">f</a>
                        <a href="#" class="social-icon">t</a>
                        <a href="#" class="social-icon">in</a>
                        <a href="#" class="social-icon">ig</a>
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
        // Role selection functionality
        document.addEventListener('DOMContentLoaded', function() {
            const playerOption = document.getElementById('player-option');
            const coachOption = document.getElementById('coach-option');
            const playerForm = document.getElementById('player-form');
            const coachForm = document.getElementById('coach-form');
            
            playerOption.addEventListener('click', function() {
                playerOption.classList.add('active');
                coachOption.classList.remove('active');
                playerForm.style.display = 'block';
                coachForm.style.display = 'none';
            });
            
            coachOption.addEventListener('click', function() {
                coachOption.classList.add('active');
                playerOption.classList.remove('active');
                coachForm.style.display = 'block';
                playerForm.style.display = 'none';
            });
            
            // Password toggle functionality
            function setupPasswordToggle(passwordId, toggleId) {
                const passwordInput = document.getElementById(passwordId);
                const toggleButton = document.getElementById(toggleId);
                
                toggleButton.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleButton.textContent = 'ðŸ™ˆ';
                    } else {
                        passwordInput.type = 'password';
                        toggleButton.textContent = 'ðŸ‘ï¸';
                    }
                });
            }
            
            // Set up password toggles
            setupPasswordToggle('player-password', 'player-password-toggle');
            setupPasswordToggle('player-confirm-password', 'player-confirm-toggle');
            setupPasswordToggle('coach-password', 'coach-password-toggle');
            setupPasswordToggle('coach-confirm-password', 'coach-confirm-toggle');
            
            // Password validation function
            function validatePassword(password) {
                const requirements = {
                    length: password.length >= 8,
                    special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(password),
                    digit: /[0-9]/.test(password),
                    capital: /[A-Z]/.test(password)
                };
                
                return requirements;
            }
            
            // Update requirement indicators
            function updateRequirementIndicators(password, requirementIds) {
                const requirements = validatePassword(password);
                
                document.getElementById(requirementIds.length).textContent = requirements.length ? 'âœ…' : 'âŒ';
                document.getElementById(requirementIds.length).className = requirements.length ? 'requirement-icon requirement-met' : 'requirement-icon requirement-not-met';
                
                document.getElementById(requirementIds.special).textContent = requirements.special ? 'âœ…' : 'âŒ';
                document.getElementById(requirementIds.special).className = requirements.special ? 'requirement-icon requirement-met' : 'requirement-icon requirement-not-met';
                
                document.getElementById(requirementIds.digit).textContent = requirements.digit ? 'âœ…' : 'âŒ';
                document.getElementById(requirementIds.digit).className = requirements.digit ? 'requirement-icon requirement-met' : 'requirement-icon requirement-not-met';
                
                document.getElementById(requirementIds.capital).textContent = requirements.capital ? 'âœ…' : 'âŒ';
                document.getElementById(requirementIds.capital).className = requirements.capital ? 'requirement-icon requirement-met' : 'requirement-icon requirement-not-met';
                
                return requirements.length && requirements.special && requirements.digit && requirements.capital;
            }
            
            // Live password validation for player
            document.getElementById('player-password').addEventListener('input', function() {
                const password = this.value;
                updateRequirementIndicators(password, {
                    length: 'player-length',
                    special: 'player-special',
                    digit: 'player-digit',
                    capital: 'player-capital'
                });
            });
            
            // Live password validation for coach
            document.getElementById('coach-password').addEventListener('input', function() {
                const password = this.value;
                updateRequirementIndicators(password, {
                    length: 'coach-length',
                    special: 'coach-special',
                    digit: 'coach-digit',
                    capital: 'coach-capital'
                });
            });
            
            // Email validation function
            function validateEmail(email) {
                return email.endsWith('@tukenya.ac.ke');
            }
            
            // Player form submission
            document.getElementById('player-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;
                
                // Validate full name
                const playerName = document.getElementById('player-fullname').value;
                if (playerName.trim() === '') {
                    document.getElementById('player-name-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-name-error').style.display = 'none';
                }
                
                // Validate registration number
                const playerReg = document.getElementById('player-regnumber').value;
                if (playerReg.trim() === '') {
                    document.getElementById('player-reg-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-reg-error').style.display = 'none';
                }
                
                // Validate contact
                const playerContact = document.getElementById('player-contact').value;
                if (playerContact.trim() === '') {
                    document.getElementById('player-contact-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-contact-error').style.display = 'none';
                }
                
                // Validate email
                const playerEmail = document.getElementById('player-email').value;
                if (!validateEmail(playerEmail)) {
                    document.getElementById('player-email-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-email-error').style.display = 'none';
                }
                
                // Validate sport
                const playerSport = document.getElementById('player-sport').value;
                if (playerSport === '') {
                    document.getElementById('player-sport-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-sport-error').style.display = 'none';
                }
                
                // Validate year
                const playerYear = document.getElementById('player-year').value;
                if (playerYear === '') {
                    document.getElementById('player-year-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-year-error').style.display = 'none';
                }
                
                // Validate password
                const playerPassword = document.getElementById('player-password').value;
                const passwordValid = updateRequirementIndicators(playerPassword, {
                    length: 'player-length',
                    special: 'player-special',
                    digit: 'player-digit',
                    capital: 'player-capital'
                });
                
                if (!passwordValid) {
                    document.getElementById('player-password-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-password-error').style.display = 'none';
                }
                
                // Validate confirm password
                const playerConfirm = document.getElementById('player-confirm-password').value;
                if (playerPassword !== playerConfirm) {
                    document.getElementById('player-confirm-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('player-confirm-error').style.display = 'none';
                }
                
                if (isValid) {
                    // Get the selected sport
                    const selectedSport = document.getElementById('player-sport').value;
                    
                    // Map sports to their category pages
                    const sportToCategoryMap = {
                        'football': 'ball-games.php',
                        'basketball': 'ball-games.php',
                        'volleyball': 'ball-games.php',
                        'handball': 'ball-games.php',
                        'rugby': 'ball-games.php',
                        'hockey': 'ball-games.php',
                        'netball': 'ball-games.php',
                        'athletics': 'athletics.php',
                        'martial-arts': 'martial-arts.php',
                        'chess': 'board-games.php',
                        'scrabble': 'board-games.php'
                    };
                    
                    // Get the redirect page based on the selected sport
                    const redirectPage = sportToCategoryMap[selectedSport] || 'index.php';
                    
                    // Show success message with sport-specific information
                    const sportDisplayNames = {
                        'football': 'Football',
                        'basketball': 'Basketball',
                        'volleyball': 'Volleyball',
                        'handball': 'Handball',
                        'rugby': 'Rugby',
                        'hockey': 'Hockey',
                        'netball': 'Netball',
                        'athletics': 'Athletics',
                        'martial-arts': 'Martial Arts',
                        'chess': 'Chess',
                        'scrabble': 'Scrabble'
                    };
                    
                    alert(`Player registration successful! Welcome to ${sportDisplayNames[selectedSport]}! Redirecting to ${sportDisplayNames[selectedSport]} page.`);
                    
                    // Redirect to the specific sport category page
                    window.location.href = redirectPage;
                }
            });
            
            // Coach form submission
            document.getElementById('coach-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;
                
                // Validate full name
                const coachName = document.getElementById('coach-fullname').value;
                if (coachName.trim() === '') {
                    document.getElementById('coach-name-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('coach-name-error').style.display = 'none';
                }
                
                // Validate registration number
                const coachReg = document.getElementById('coach-regnumber').value;
                if (coachReg.trim() === '') {
                    document.getElementById('coach-reg-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('coach-reg-error').style.display = 'none';
                }
                
                // Validate contact
                const coachContact = document.getElementById('coach-contact').value;
                if (coachContact.trim() === '') {
                    document.getElementById('coach-contact-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('coach-contact-error').style.display = 'none';
                }
                
                // Validate email
                const coachEmail = document.getElementById('coach-email').value;
                if (!validateEmail(coachEmail)) {
                    document.getElementById('coach-email-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('coach-email-error').style.display = 'none';
                }
                
                // Validate sport
                const coachSport = document.getElementById('coach-sport').value;
                if (coachSport === '') {
                    document.getElementById('coach-sport-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('coach-sport-error').style.display = 'none';
                }
                
                // Validate password
                const coachPassword = document.getElementById('coach-password').value;
                const passwordValid = updateRequirementIndicators(coachPassword, {
                    length: 'coach-length',
                    special: 'coach-special',
                    digit: 'coach-digit',
                    capital: 'coach-capital'
                });
                
                if (!passwordValid) {
                    document.getElementById('coach-password-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('coach-password-error').style.display = 'none';
                }
                
                // Validate confirm password
                const coachConfirm = document.getElementById('coach-confirm-password').value;
                if (coachPassword !== coachConfirm) {
                    document.getElementById('coach-confirm-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('coach-confirm-error').style.display = 'none';
                }
                
                if (isValid) {
                    // Redirect to admin.php for coaches
                    alert('Coach registration successful! Redirecting to admin panel.');
                    window.location.href = 'admin.php';
                }
            });
        });
    </script>
</body>
</html>
