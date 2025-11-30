<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Technical University of Kenya Sports</title>
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
        
        /* Slideshow Section */
        .slideshow-section {
            padding: 60px 0;
            background-color: #f9f9f9;
        }
        
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .mySlides {
            display: none;
        }
        
        .mySlides img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        
        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        
        .dot-container {
            text-align: center;
            padding: 20px;
            background: white;
        }
        
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }
        
        .active, .dot:hover {
            background-color: #003366;
        }
        
        /* About Content Section */
        .about-content {
            padding: 60px 0;
            background-color: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: #003366;
            font-size: 2.2rem;
            font-weight: bold;
        }
        
        .scrollable-content {
            max-height: 400px;
            overflow-y: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            line-height: 1.8;
        }
        
        .scrollable-content h3 {
            color: #003366;
            margin: 20px 0 10px;
        }
        
        .scrollable-content p {
            margin-bottom: 15px;
        }
        
        /* FAQ Section */
        .faq-section {
            padding: 60px 0;
            background-color: #f9f9f9;
        }
        
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .faq-item {
            margin-bottom: 15px;
            border: 1px solid gold;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .faq-question {
            padding: 15px 20px;
            background-color: #003366;
            color: green;
            cursor: pointer;
            font-weight: bold;
            position: relative;
        }
        
        .faq-question:after {
            content: '+';
            position: absolute;
            right: 20px;
            font-size: 1.2rem;
        }
        
        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            background-color: white;
        }
        
        .faq-item.active .faq-question:after {
            content: '-';
        }
        
        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 20px;
        }
        
        /* Team Section */
        .team-section {
            padding: 60px 0;
            background-color: white;
        }
        
        .team-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .team-member {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .team-member:hover {
            transform: translateY(-10px);
        }
        
        .member-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 3px solid #003366;
        }
        
        .member-name {
            font-weight: bold;
            color: #003366;
            margin-bottom: 5px;
        }
        
        .member-role {
            color: #666;
            font-size: 0.9rem;
        }
        
        .team-description {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background-color: #f0f8ff;
            border-radius: 8px;
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
            
            .mySlides img {
                height: 300px;
            }
            
            .team-container {
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
                        <li><a href="about.php" class="active">About Us</a></li>
                        <li><a href="registration.php">Registration</a></li>
                        <li><a href="schedule.php">Events</a></li>                        
                        <li><a href="blog.php">Blogs</a></li>
                        <li><a href="https://portal.tukenya.ac.ke/?r=site/help">Help</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Slideshow Section -->
    <section class="slideshow-section">
        <div class="container">
            <h2 class="section-title">Sports at Technical University of Kenya</h2>
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiRSSJSURnKD-vL_iakv0SOwRMlEHwkr7rdMzUPadK5G-3d4amqZ4LzbFT5R8Hgg8ySIU&usqp=CAU" alt="Football">
                </div>
                
                <div class="mySlides fade">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLr8RnwV1Z8vysKPaKVGNTA37UTiiH_X8m1g&s" alt="Chess">
                </div>
                
                <div class="mySlides fade">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcPRYK0Wac28uw3yRs24gkekdovEfLjJI5p8LfovnKMR102EgFLRHQvuPQOEj73qlXYnc&usqp=CAU" alt="Basketball">
                </div>
                
                <div class="mySlides fade">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTYvC-lutQQGwFQ-fuW4U2pbLgYWK0frzYc3-gLf3UMQT9kkgTjXXhB5GxdavCQ1rWkLlU&usqp=CAU" alt="Hockey">
                </div>
                
                <div class="mySlides fade">
                    <img src="data:image/jpeg;base64,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" alt="Netball">
                </div>
                
                <div class="mySlides fade">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMIL_r2vHy6OJoTxzk-oOz2CQgdj3ZKlpkmw&s" alt="Discus">
                </div>
                
                <div class="mySlides fade">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzEH7ZXM2sWV_PJnbHxZKGlz5J2ac8rMym6P5wkH88oyEkNErJWujoqRpSBmmHN7dFSEA&usqp=CAU" alt="Martial Arts">
                </div>
                
                <a class="prev" onclick="plusSlides(-1)">â®</a>
                <a class="next" onclick="plusSlides(1)">â¯</a>
            </div>
            <br>
            
            <div class="dot-container">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
                <span class="dot" onclick="currentSlide(4)"></span> 
                <span class="dot" onclick="currentSlide(5)"></span> 
                <span class="dot" onclick="currentSlide(6)"></span> 
                <span class="dot" onclick="currentSlide(7)"></span> 
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="about-content">
        <div class="container">
            <h2 class="section-title">The Importance of Sports at TU-K</h2>
            <div class="scrollable-content">
                <h3>Why Sports Matter in Higher Education</h3>
                <p>At the Technical University of Kenya, we believe that sports play a crucial role in the holistic development of our students. Beyond physical fitness, participation in sports activities fosters essential life skills that complement academic learning and prepare students for success in their professional careers.</p>
                
                <h3>Physical and Mental Well-being</h3>
                <p>Regular participation in sports helps maintain physical health, reduces stress, and improves mental well-being. The demanding academic environment at TU-K requires students to have outlets for stress relief, and sports provide the perfect balance between mental exertion and physical activity.</p>
                
                <h3>Developing Leadership and Teamwork</h3>
                <p>Team sports like football, basketball, and netball teach students how to work collaboratively, communicate effectively, and develop leadership qualities. These skills are directly transferable to the workplace, where teamwork and leadership are highly valued.</p>
                
                <h3>Discipline and Time Management</h3>
                <p>Balancing academic responsibilities with sports training requires excellent time management and discipline. Student-athletes at TU-K learn to prioritize tasks, manage their schedules efficiently, and develop a strong work ethic that serves them well in all aspects of life.</p>
                
                <h3>Building Community and School Spirit</h3>
                <p>Sports events bring together students, faculty, and staff, creating a sense of community and school pride. The camaraderie developed through sports strengthens the university's social fabric and creates lasting bonds among participants.</p>
                
                <h3>Why TU-K Invested in Sports</h3>
                <p>The Technical University of Kenya recognized that producing well-rounded graduates requires more than just academic excellence. Our investment in sports facilities and programs stems from our commitment to:</p>
                <ul>
                    <li>Developing complete individuals with balanced physical and mental capabilities</li>
                    <li>Providing alternative pathways for student success and recognition</li>
                    <li>Enhancing the university's reputation through competitive sports performance</li>
                    <li>Creating opportunities for talent identification and development</li>
                    <li>Fostering national and international collaborations through sports exchanges</li>
                </ul>
                
                <h3>Our Sports Philosophy</h3>
                <p>At TU-K, we believe that every student should have the opportunity to participate in sports regardless of their skill level. Our programs cater to both recreational participants and competitive athletes, ensuring that everyone can benefit from the transformative power of sports.</p>
                
                <p>Through our diverse sports offerings - from traditional ball games to martial arts and board games - we aim to cater to varied interests and abilities, making sports accessible and enjoyable for all members of our university community.</p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">How can I join a sports team at TU-K?</div>
                    <div class="faq-answer">
                        <p>You can join a sports team by visiting the Sports Department office or attending tryouts at the beginning of each semester. Most teams hold open trials where students can showcase their skills.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Are there sports scholarships available?</div>
                    <div class="faq-answer">
                        <p>Yes, TU-K offers sports scholarships for exceptionally talented athletes. These are awarded based on performance in trials and maintaining good academic standing.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">Do I need prior experience to participate in sports?</div>
                    <div class="faq-answer">
                        <p>No prior experience is needed for most recreational sports. However, competitive teams may require some level of skill. We encourage all students to try different sports regardless of experience.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">What facilities are available for sports?</div>
                    <div class="faq-answer">
                        <p>TU-K has a sports complex with football fields, basketball and netball courts, a gymnasium, and spaces for indoor games. We also have equipment that students can borrow for practice.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">How do sports activities affect academic performance?</div>
                    <div class="faq-answer">
                        <p>Research shows that moderate participation in sports can actually improve academic performance by reducing stress, improving concentration, and teaching time management skills.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Website Development Team</h2>
            <div class="team-container">
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Janet Chepkurui" class="member-image">
                    <div class="member-name">Janet Chepkurui</div>
                    <div class="member-role">BTECHIT Student</div>
                </div>
                
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Emmanuel Igathe" class="member-image">
                    <div class="member-name">Emmanuel Igathe</div>
                    <div class="member-role">BTECHIT Student</div>
                </div>
                
                <div class="team-member">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Margaret Nduta" class="member-image">
                    <div class="member-name">Margaret Nduta</div>
                    <div class="member-role">BTECHIT Student</div>
                </div>
            </div>
            
            <div class="team-description">
                <p>The Technical University of Kenya Sports Website was created in 2025 by the above BTECHIT students when they recognized the need for a comprehensive sports platform at the university. Their vision was to create a centralized hub for all sports-related information, registration, and events to enhance student participation in athletic activities.</p>
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
        // Slideshow functionality
        let slideIndex = 1;
        showSlides(slideIndex);
        
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
        
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }
        
        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
        }
        
        // Auto advance slides
        setInterval(function() {
            plusSlides(1);
        }, 5000);
        
        // FAQ functionality
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                
                question.addEventListener('click', () => {
                    // Close all other items
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                        }
                    });
                    
                    // Toggle current item
                    item.classList.toggle('active');
                });
            });
        });
    </script>
</body>
</html>
