<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Blog - Technical University of Kenya</title>
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
        
        /* Blog Section */
        .blog-section {
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
        
        .blog-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }
        
        /* Blog Posts */
        .blog-posts {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        .blog-post {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .blog-post:hover {
            transform: translateY(-5px);
        }
        
        .post-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .post-content {
            padding: 25px;
        }
        
        .post-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #666;
        }
        
        .post-author {
            font-weight: bold;
            color: #003366;
        }
        
        .post-date {
            color: #888;
        }
        
        .post-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #003366;
        }
        
        .post-excerpt {
            margin-bottom: 20px;
            color: #444;
        }
        
        .read-more {
            display: inline-block;
            background-color: #2E8B57;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .read-more:hover {
            background-color: #26734d;
        }
        
        /* Blog Sidebar */
        .blog-sidebar {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        .sidebar-widget {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }
        
        .widget-title {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: #003366;
            border-bottom: 2px solid #f0f8ff;
            padding-bottom: 10px;
        }
        
        .categories-list {
            list-style: none;
        }
        
        .categories-list li {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .categories-list a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s;
            display: flex;
            justify-content: space-between;
        }
        
        .categories-list a:hover {
            color: #003366;
        }
        
        .category-count {
            background-color: #f0f8ff;
            color: #003366;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
        }
        
        .recent-posts-list {
            list-style: none;
        }
        
        .recent-post {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .recent-post:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .recent-post-image {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }
        
        .recent-post-content h4 {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .recent-post-content .post-date {
            font-size: 0.8rem;
        }
        
        /* Admin Controls */
        .admin-controls {
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #003366;
        }
        
        .admin-controls h3 {
            color: #003366;
            margin-bottom: 15px;
        }
        
        .create-post-btn {
            background-color: #2E8B57;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .create-post-btn:hover {
            background-color: #26734d;
        }
        
        /* Create Post Modal */
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
            max-width: 800px;
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
            min-height: 150px;
            resize: vertical;
        }
        
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #003366;
        }
        
        .submit-post-btn {
            background-color: #2E8B57;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .submit-post-btn:hover {
            background-color: #26734d;
        }
        
        /* Full Post View */
        .full-post {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 40px;
        }
        
        .full-post-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        .full-post-content {
            padding: 30px;
        }
        
        .full-post-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #003366;
        }
        
        .full-post-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .full-post-body {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #333;
        }
        
        .full-post-body p {
            margin-bottom: 20px;
        }
        
        .back-to-blog {
            display: inline-block;
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 30px;
            transition: background-color 0.3s;
        }
        
        .back-to-blog:hover {
            background-color: #002244;
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
            
            .blog-container {
                grid-template-columns: 1fr;
            }
            
            .blog-sidebar {
                order: -1;
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
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="registration.php">Registration</a></li>
                        <li><a href="schedule.php">Events</a></li>
                        <li><a href="blog.php" class="active">Blog</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <h2 class="section-title">TU-K Sports Blog</h2>
            
            <!-- Admin Controls (Visible only to coaches/admins) -->
            <div class="admin-controls" id="admin-controls">
                <h3>Admin Controls</h3>
                <p>As a coach/admin, you can create new blog posts to share updates, insights, and news with the TU-K sports community.</p>
                <button class="create-post-btn" id="create-post-btn">Create New Post</button>
            </div>
            
            <!-- Back to Blog Link (Visible when viewing full post) -->
            <a href="blog.php" class="back-to-blog" id="back-to-blog" style="display: none;">â† Back to All Posts</a>
            
            <!-- Blog Content Area -->
            <div class="blog-container">
                <!-- Main Blog Posts -->
                <div class="blog-posts" id="blog-posts">
                    <!-- Blog posts will be loaded here by JavaScript -->
                </div>
                
                <!-- Blog Sidebar -->
                <div class="blog-sidebar">
                    <!-- About Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">About Our Blog</h3>
                        <p>The TU-K Sports Blog is your source for the latest news, insights, and updates from our sports department. Our coaches and staff share their expertise and experiences to keep you informed and inspired.</p>
                    </div>
                    
                    <!-- Categories Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="categories-list" id="categories-list">
                            <!-- Categories will be loaded by JavaScript -->
                        </ul>
                    </div>
                    
                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Recent Posts</h3>
                        <ul class="recent-posts-list" id="recent-posts-list">
                            <!-- Recent posts will be loaded by JavaScript -->
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Full Post View (Hidden by default) -->
            <div class="full-post" id="full-post" style="display: none;">
                <!-- Full post content will be loaded here by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Create Post Modal -->
    <div class="modal" id="create-post-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create New Blog Post</h3>
                <button class="modal-close" id="create-post-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="create-post-form">
                    <div class="form-group">
                        <label for="post-title">Post Title *</label>
                        <input type="text" id="post-title" name="post-title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="post-category">Category *</label>
                        <select id="post-category" name="post-category" required>
                            <option value="">Select a category</option>
                            <option value="football">Football</option>
                            <option value="basketball">Basketball</option>
                            <option value="athletics">Athletics</option>
                            <option value="volleyball">Volleyball</option>
                            <option value="martial-arts">Martial Arts</option>
                            <option value="general">General Sports</option>
                            <option value="training">Training Tips</option>
                            <option value="events">Event Updates</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="post-image">Featured Image URL</label>
                        <input type="url" id="post-image" name="post-image" placeholder="https://example.com/image.jpg">
                    </div>
                    
                    <div class="form-group">
                        <label for="post-excerpt">Excerpt *</label>
                        <textarea id="post-excerpt" name="post-excerpt" required placeholder="Brief description of your post..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="post-content">Post Content *</label>
                        <textarea id="post-content" name="post-content" required placeholder="Write your blog post content here..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-post-btn">Publish Post</button>
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
        // Sample blog posts data
        let blogPosts = [
            {
                id: 1,
                title: "Football Team Prepares for Inter-University Championship",
                excerpt: "Our football team is undergoing intensive training as we prepare for the upcoming inter-university championship next month.",
                content: "<p>Our football team has been putting in extra hours on the training ground as we prepare for the upcoming Inter-University Championship scheduled for next month. Coach Mwangi has implemented a new training regimen focusing on both physical fitness and tactical awareness.</p><p>The team has shown remarkable improvement in recent practice matches, with our strikers demonstrating excellent finishing skills and our defense becoming more organized. We're particularly excited about the performance of our new recruits who have adapted quickly to the team's playing style.</p><p>We encourage all students to come out and support the team during our final preparation matches next week. Your support means everything to our players!</p>",
                author: "Coach Mwangi",
                date: new Date(2025, 2, 10),
                category: "football",
                image: "https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
            },
            {
                id: 2,
                title: "Basketball Team Secures Spot in Regional Finals",
                excerpt: "The TU-K basketball team has qualified for the regional finals after an impressive winning streak in the preliminary rounds.",
                content: "<p>We are thrilled to announce that our basketball team has secured a spot in the regional finals after an impressive performance in the preliminary rounds. The team won all their group stage matches, displaying exceptional skill and teamwork.</p><p>Point guard Sarah Omondi has been particularly outstanding, averaging 18 points and 7 assists per game. Her leadership on the court has been instrumental to our success.</p><p>The regional finals will be held at the Kasarani Sports Complex next month. We're calling on all TU-K students to come out in large numbers to support our team as they compete for the regional title.</p>",
                author: "Coach Kamau",
                date: new Date(2025, 2, 5),
                category: "basketball",
                image: "https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
            },
            {
                id: 3,
                title: "Athletics Department Announces New Training Facilities",
                excerpt: "The university has invested in state-of-the-art training facilities for our athletics program, including a new synthetic track and field equipment.",
                content: "<p>We are excited to announce that the university has completed the installation of new state-of-the-art training facilities for our athletics program. The upgrades include a brand new synthetic track, modern field event equipment, and improved lighting for evening training sessions.</p><p>These facilities will significantly enhance our training capabilities and provide our athletes with the resources they need to compete at the highest level. The new track meets international competition standards, which means we can now host major athletics events at our campus.</p><p>Training schedules have been adjusted to accommodate all student athletes. Please check with your coaches for the new training timetables.</p>",
                author: "Director of Sports",
                date: new Date(2025, 1, 28),
                category: "athletics",
                image: "https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
            },
            {
                id: 4,
                title: "Martial Arts Club Achieves National Recognition",
                excerpt: "Our martial arts club has been recognized as one of the top university martial arts programs in the country.",
                content: "<p>We are proud to announce that our martial arts club has received national recognition as one of the top university martial arts programs in the country. This recognition comes after our students' outstanding performances in recent national competitions.</p><p>Five of our students have been selected to represent the country in the upcoming African Martial Arts Championships. This is a tremendous achievement and a testament to the quality of our training program and the dedication of our students.</p><p>We invite all interested students to join our martial arts club. Training sessions are held every Monday, Wednesday, and Friday at the sports complex.</p>",
                author: "Sensei Wanjiku",
                date: new Date(2025, 1, 15),
                category: "martial-arts",
                image: "https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
            }
        ];

        // Check if user is admin (coach)
        // In a real application, this would be determined by authentication
        // For this demo, we'll check if the user is coming from admin.php or has a URL parameter
        const isAdmin = window.location.search.includes('admin=true') || 
                       document.referrer.includes('admin.php') || 
                       localStorage.getItem('tuk_admin') === 'true';

        document.addEventListener('DOMContentLoaded', function() {
            const blogPostsContainer = document.getElementById('blog-posts');
            const categoriesList = document.getElementById('categories-list');
            const recentPostsList = document.getElementById('recent-posts-list');
            const adminControls = document.getElementById('admin-controls');
            const createPostBtn = document.getElementById('create-post-btn');
            const createPostModal = document.getElementById('create-post-modal');
            const createPostClose = document.getElementById('create-post-close');
            const createPostForm = document.getElementById('create-post-form');
            const fullPostContainer = document.getElementById('full-post');
            const backToBlogLink = document.getElementById('back-to-blog');
            const blogContainer = document.querySelector('.blog-container');

            // Show/hide admin controls based on user role
            if (isAdmin) {
                adminControls.style.display = 'block';
                // Store admin status for future page visits
                localStorage.setItem('tuk_admin', 'true');
            } else {
                adminControls.style.display = 'none';
            }

            // Display blog posts
            function displayBlogPosts(posts = blogPosts) {
                blogPostsContainer.innerHTML = '';
                
                // Sort posts by date (newest first)
                const sortedPosts = [...posts].sort((a, b) => b.date - a.date);
                
                sortedPosts.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.className = 'blog-post';
                    
                    const postDate = post.date;
                    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    
                    postElement.innerHTML = `
                        <img src="${post.image}" alt="${post.title}" class="post-image">
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-author">By ${post.author}</span>
                                <span class="post-date">${postDate.getDate()} ${monthNames[postDate.getMonth()]} ${postDate.getFullYear()}</span>
                            </div>
                            <h3 class="post-title">${post.title}</h3>
                            <p class="post-excerpt">${post.excerpt}</p>
                            <a href="#" class="read-more" data-post-id="${post.id}">Read More</a>
                        </div>
                    `;
                    
                    blogPostsContainer.appendChild(postElement);
                });
                
                // Add event listeners to "Read More" buttons
                document.querySelectorAll('.read-more').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const postId = parseInt(this.getAttribute('data-post-id'));
                        showFullPost(postId);
                    });
                });
            }

            // Display categories in sidebar
            function displayCategories() {
                const categories = {};
                
                // Count posts per category
                blogPosts.forEach(post => {
                    if (categories[post.category]) {
                        categories[post.category]++;
                    } else {
                        categories[post.category] = 1;
                    }
                });
                
                // Create category list items
                categoriesList.innerHTML = '';
                Object.keys(categories).forEach(category => {
                    const categoryItem = document.createElement('li');
                    const categoryName = category.charAt(0).toUpperCase() + category.slice(1).replace('-', ' ');
                    
                    categoryItem.innerHTML = `
                        <a href="#" data-category="${category}">
                            ${categoryName}
                            <span class="category-count">${categories[category]}</span>
                        </a>
                    `;
                    
                    categoriesList.appendChild(categoryItem);
                });
                
                // Add event listeners to category links
                document.querySelectorAll('.categories-list a').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const category = this.getAttribute('data-category');
                        filterPostsByCategory(category);
                    });
                });
            }

            // Display recent posts in sidebar
            function displayRecentPosts() {
                // Get the 3 most recent posts
                const recentPosts = [...blogPosts]
                    .sort((a, b) => b.date - a.date)
                    .slice(0, 3);
                
                recentPostsList.innerHTML = '';
                
                recentPosts.forEach(post => {
                    const postItem = document.createElement('li');
                    postItem.className = 'recent-post';
                    
                    const postDate = post.date;
                    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    
                    postItem.innerHTML = `
                        <img src="${post.image}" alt="${post.title}" class="recent-post-image">
                        <div class="recent-post-content">
                            <h4>${post.title}</h4>
                            <span class="post-date">${postDate.getDate()} ${monthNames[postDate.getMonth()]} ${postDate.getFullYear()}</span>
                        </div>
                    `;
                    
                    recentPostsList.appendChild(postItem);
                    
                    // Add click event to show full post
                    postItem.addEventListener('click', function() {
                        showFullPost(post.id);
                    });
                });
            }

            // Show full post
            function showFullPost(postId) {
                const post = blogPosts.find(p => p.id === postId);
                
                if (post) {
                    const postDate = post.date;
                    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    
                    fullPostContainer.innerHTML = `
                        <img src="${post.image}" alt="${post.title}" class="full-post-image">
                        <div class="full-post-content">
                            <h2 class="full-post-title">${post.title}</h2>
                            <div class="full-post-meta">
                                <span class="post-author">By ${post.author}</span>
                                <span class="post-date">${postDate.getDate()} ${monthNames[postDate.getMonth()]} ${postDate.getFullYear()}</span>
                            </div>
                            <div class="full-post-body">
                                ${post.content}
                            </div>
                        </div>
                    `;
                    
                    // Show full post and hide blog list
                    fullPostContainer.style.display = 'block';
                    blogContainer.style.display = 'none';
                    backToBlogLink.style.display = 'inline-block';
                }
            }

            // Filter posts by category
            function filterPostsByCategory(category) {
                const filteredPosts = blogPosts.filter(post => post.category === category);
                displayBlogPosts(filteredPosts);
            }

            // Event listeners for create post modal
            createPostBtn.addEventListener('click', function() {
                createPostModal.style.display = 'flex';
            });

            createPostClose.addEventListener('click', function() {
                createPostModal.style.display = 'none';
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === createPostModal) {
                    createPostModal.style.display = 'none';
                }
            });

            // Handle form submission
            createPostForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const title = document.getElementById('post-title').value;
                const category = document.getElementById('post-category').value;
                const image = document.getElementById('post-image').value || 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80';
                const excerpt = document.getElementById('post-excerpt').value;
                const content = document.getElementById('post-content').value;
                
                // Create new post
                const newPost = {
                    id: blogPosts.length + 1,
                    title: title,
                    excerpt: excerpt,
                    content: `<p>${content.replace(/\n/g, '</p><p>')}</p>`,
                    author: "Coach Admin",
                    date: new Date(),
                    category: category,
                    image: image
                };
                
                // Add to blog posts
                blogPosts.unshift(newPost);
                
                // Update display
                displayBlogPosts();
                displayCategories();
                displayRecentPosts();
                
                // Close modal and reset form
                createPostModal.style.display = 'none';
                createPostForm.reset();
                
                alert('Blog post published successfully!');
            });

            // Back to blog link
            backToBlogLink.addEventListener('click', function(e) {
                e.preventDefault();
                fullPostContainer.style.display = 'none';
                blogContainer.style.display = 'grid';
                backToBlogLink.style.display = 'none';
            });

            // Initialize the blog
            displayBlogPosts();
            displayCategories();
            displayRecentPosts();
        });
    </script>
</body>
</html>
