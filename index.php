<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technical University of Kenya - Sports</title>
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
            background-color: white; /* Gray color for navigation */
        }
        
        .nav-container {
            display: flex;
            justify-content: flex-end; /* Align navigation to the right */
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
            background: linear-gradient(rgba(0, 51, 102, 0.8), rgba(0, 51, 102, 0.8)), url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKTcC3F2P7d2oibVhvYnTtX04b5asMXcIW6ekDY0Fn8wkAYsJBNO4dfowkHECjoMOQjQE&usqp=CAU');
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
        
        .cta-button {
            display: inline-block;
            background-color: #cc0000;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .cta-button:hover {
            background-color: #a30000;
        }
        
        /* Login Section */
        .login-section {
            padding: 60px 0;
            background-color: #f9f9f9;
        }
        
        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .login-form-container {
            padding: 40px;
        }
        
        .login-info-container {
            padding: 40px;
            background-color: #f0f8ff;
        }
        
        .login-title {
            color: #003366;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .login-description {
            margin-bottom: 25px;
            color: #000000;
            font-size: 0.95rem;
        }
        
        .login-form {
            margin-top: 20px;
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
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            color: #000000;
        }
        
        .login-button {
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
        
        .login-button:hover {
            background-color: #26734d;
        }
        
        .login-links {
            margin-top: 20px;
            text-align: center;
        }
        
        .login-links a {
            color: #003366;
            text-decoration: none;
            margin: 0 10px;
            font-size: 0.9rem;
        }
        
        .login-links a:hover {
            text-decoration: underline;
        }
        
        .info-title {
            color: #003366;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .info-content {
            color: #000000;
            font-size: 0.95rem;
        }
        
        .info-content p {
            margin-bottom: 15px;
        }
        
        /* Dual Login Styles */
        .dual-login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .login-option {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .login-option:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
        
        .login-option.active {
            border-color: #2E8B57;
            background-color: #f0f8ff;
        }
        
        .login-option h3 {
            color: #003366;
            margin-bottom: 15px;
            font-weight: bold;
        }
        
        .login-option-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #2E8B57;
        }
        
        .login-option-button {
            background-color: #2E8B57;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px;
        }
        
        .login-option-button:hover {
            background-color: #26734d;
        }
        
        /* Sports Categories */
        .sports-categories {
            padding: 80px 0;
            background-color: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: #003366;
            font-size: 2.2rem;
            font-weight: bold;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .category-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .category-image {
            height: 180px;
            background-size: cover;
            background-position: center;
        }
        
        .category-content {
            padding: 20px;
        }
        
        .category-content h3 {
            color: #003366;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .category-content p {
            color: #000000;
            font-weight: normal;
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
            
            .login-container {
                grid-template-columns: 1fr;
            }
            
            .dual-login-container {
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
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>TU-K SPORTS DEPARTMENT</h1>
            <p>Promoting excellence in sports and nurturing talent through competitive and recreational activities for all students.</p>
            <a href="registration.php" class="cta-button">Register Now</a>
        </div>
    </section>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <!-- Login Form -->
                <div class="login-form-container">
                    <h2 class="login-title">Student & Coach Login</h2>
                    <p class="login-description">
                        This is a login page for registered students and coaches only (prospective students have to be admitted first before they can access the portal). 
                        Applicants should log in at the Online Application Portal. 2020 prospective students to complete their pre-admission process and obtain admission letters using this link.
                    </p>
                    
                    <!-- Dual Login Options -->
                    <div class="dual-login-container">
                        <!-- Student Login -->
                        <div class="login-option active" id="student-login">
                            <div class="login-option-icon">ðŸŽ“</div>
                            <h3>Login as Student</h3>
                            <form class="login-form">
                                <div class="form-group">
                                    <label for="student-username">Student ID/Registration Number *</label>
                                    <input type="text" id="student-username" name="student-username" placeholder="SCCJ/00651/2023">
                                </div>
                                
                                <div class="form-group">
                                    <label for="student-password">Password *</label>
                                    <input type="password" id="student-password" name="student-password" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢">
                                </div>
                                
                                <a button type="submit" class="login-option-button" href="index.php">Login</button></a>
                            </form>
                        </div>
                        
                        <!-- Coach Login -->
                        <div class="login-option" id="coach-login">
                            <div class="login-option-icon">ðŸ‘¨â€ðŸ«</div>
                            <h3>Login as Coach</h3>
                            <form class="login-form">
                                <div class="form-group">
                                    <label for="coach-username">Coach ID/Email *</label>
                                    <input type="text" id="coach-username" name="coach-username" placeholder="coach.email@tukenya.ac.ke">
                                </div>
                                
                                <div class="form-group">
                                    <label for="coach-password">Password *</label>
                                    <input type="password" id="coach-password" name="coach-password" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢">
                                </div>
                                
                                <a button type="submit" class="login-option-button" href="admin.php">Login</button></a>
                            </form>
                        </div>
                    </div>
                    
                    <div class="login-links">
                        <a href="https://portal.tukenya.ac.ke/?r=site/login" target="_blank">Unable to log in? Recover password</a>
                        <a href="https://portal.tukenya.ac.ke/?r=site/help" target="_blank">Help</a>
                        <a href="https://portal.tukenya.ac.ke/?r=site/login" target="_blank">Login page</a>
                        <a href="https://portal.tukenya.ac.ke/?r=site" target="_blank">Home</a>
                    </div>
                </div>
                
                <!-- Login Instructions -->
                <div class="login-info-container">
                    <h2 class="info-title">LOGIN INSTRUCTIONS</h2>
                    <div class="info-content">
                        <p><strong>FOR STUDENTS:</strong></p>
                        <p><strong>USERNAME:</strong> Your login username is your full registration number, for example ABBQ/00001/2017 or 113/00001.</p>
                        
                        <p><strong>PASSWORD:</strong> Login password is as follows:</p>
                        
                        <p>- Initial/default password for KUCCPS/Module I students is KCSE full index number like 01234567891/2016. However, this changes to your birth certificate/passport/national ID number immediately you update your profile.</p>
                        
                        <p>- Initial/default password for Module II/Self-sponsored students is what was entered as national ID number when applying online.</p>
                        
                        <p>- Once you update your profile, your password becomes your ID/Passport/Birth certificate number and it will change ONLY when you reset it to a new password.</p>
                        
                        <p><strong>FOR COACHES:</strong></p>
                        <p><strong>USERNAME:</strong> Your login username is your official TU-K email address.</p>
                        
                        <p><strong>PASSWORD:</strong> Use the password provided by the Sports Department or reset it using the "Recover password" link.</p>
                        
                        <p><strong>YOU ARE STRONGLY ADVISED TO CHANGE YOUR DEFAULT PASSWORD AFTER LOGGING IN TO YOUR PORTAL</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sports Categories Section -->
    <section class="sports-categories">
        <div class="container">
            <h2 class="section-title">Sports Categories</h2>
            <div class="categories-grid">
                <!-- Ball Games -->
                <a href="ball-games.php" class="category-card">
                    <div class="category-image" style="background-image: url('https://images.unsplash.com/photo-1575361204480-aadea25e6e68?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                    <div class="category-content">
                        <h3>Ball Games</h3>
                        <p>Football, Basketball, Volleyball, Handball, Rugby, and more.</p>
                    </div>
                </a>
                
                <!-- Board Games -->
                <a href="board-games.php" class="category-card">
                    <div class="category-image" style="background-image: url('https://images.unsplash.com/photo-1611195974226-a6a9be9dd763?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=725');"></div>
                    <div class="category-content">
                        <h3>Board Games</h3>
                        <p>Chess, Checkers, Scrabble, and other strategic board games.</p>
                    </div>
                </a>
                
                <!-- Throwing Games -->
                <a href="throwing-games.php" class="category-card">
                    <div class="category-image" style="background-image: url('https://media.istockphoto.com/id/663208674/photo/athlete-about-to-throw-a-javelin.jpg?s=612x612&w=0&k=20&c=Vc_Nx70TYMEsuEaonzfVykFArWVLln3pCt4Rq7_RHwk=');"></div>
                    <div class="category-content">
                        <h3>Throwing Games</h3>
                        <p>Javelin, Discus, Shot Put, and other throwing disciplines.</p>
                    </div>
                </a>
                
                <!-- Athletics -->
                <a href="athletics.php" class="category-card">
                    <div class="category-image" style="background-image: url('https://media.istockphoto.com/id/1400048768/photo/fit-african-american-couple-running-outdoors-while-exercising-young-athletic-man-and-woman.jpg?s=612x612&w=0&k=20&c=ao3uUBotwmuyHp4VJKXE3PhIW_h0Ah_cebmZi6zRgbo=');"></div>
                    <div class="category-content">
                        <h3>Athletics</h3>
                        <p>Track and field events including sprints, hurdles, and long-distance running.</p>
                    </div>
                </a>
                
                <!-- Martial Arts -->
                <a href="martial-arts.php" class="category-card">
                    <div class="category-image" style="background-image: url('https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                    <div class="category-content">
                        <h3>Martial Arts</h3>
                        <p>Karate, Taekwondo, Judo, and other self-defense disciplines.</p>
                    </div>
                </a>
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
        // Simple script to handle login option selection
        document.addEventListener('DOMContentLoaded', function() {
            const studentLogin = document.getElementById('student-login');
            const coachLogin = document.getElementById('coach-login');
            
            studentLogin.addEventListener('click', function() {
                studentLogin.classList.add('active');
                coachLogin.classList.remove('active');
            });
            
            coachLogin.addEventListener('click', function() {
                coachLogin.classList.add('active');
                studentLogin.classList.remove('active');
            });
        });
    </script>
</body>
</html>
