<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Technical University of Kenya</title>
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
        
        /* Admin Dashboard Section */
        .admin-section {
            padding: 40px 0;
            background-color: #f9f9f9;
            min-height: 80vh;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: #003366;
            font-size: 2.2rem;
            font-weight: bold;
        }
        
        .admin-welcome {
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #003366;
        }
        
        .admin-welcome h3 {
            color: #003366;
            margin-bottom: 10px;
        }
        
        /* Admin Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .dashboard-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            transition: transform 0.3s;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        
        .card-title {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: #003366;
            border-bottom: 2px solid #f0f8ff;
            padding-bottom: 10px;
        }
        
        .card-stats {
            font-size: 2rem;
            font-weight: bold;
            color: #2E8B57;
            margin-bottom: 15px;
        }
        
        .card-description {
            color: #666;
            margin-bottom: 20px;
        }
        
        .card-btn {
            display: inline-block;
            background-color: #2E8B57;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .card-btn:hover {
            background-color: #26734d;
        }
        
        /* Admin Tabs */
        .admin-tabs {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .tab-headers {
            display: flex;
            background-color: #f0f8ff;
            border-bottom: 1px solid #ddd;
        }
        
        .tab-header {
            padding: 15px 25px;
            cursor: pointer;
            background-color: transparent;
            border: none;
            font-size: 1rem;
            transition: background-color 0.3s;
            color: #003366;
        }
        
        .tab-header.active {
            background-color: white;
            border-bottom: 3px solid #003366;
            font-weight: bold;
        }
        
        .tab-content {
            padding: 30px;
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .data-table th {
            background-color: #f0f8ff;
            color: #003366;
            font-weight: bold;
        }
        
        .data-table tr:hover {
            background-color: #f9f9f9;
        }
        
        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            margin-right: 5px;
            transition: background-color 0.3s;
        }
        
        .edit-btn {
            background-color: #ffc107;
            color: #000;
        }
        
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #e0a800;
        }
        
        .delete-btn:hover {
            background-color: #c82333;
        }
        
        /* Form Styles */
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
        }
        
        .submit-btn:hover {
            background-color: #26734d;
        }
        
        /* Modal Styles */
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
            max-width: 600px;
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
            
            .tab-headers {
                flex-wrap: wrap;
            }
            
            .tab-header {
                flex: 1 0 50%;
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
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="admin.php" class="active">Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Admin Dashboard Section -->
    <section class="admin-section">
        <div class="container">
            <h2 class="section-title">Admin Dashboard</h2>
            
            <!-- Admin Welcome Message -->
            <div class="admin-welcome">
                <h3>Welcome, Coach!</h3>
                <p>As an administrator, you have full control over the TU-K Sports Blog, player management, and event scheduling. Use the dashboard below to manage all aspects of the sports program.</p>
            </div>
            
            <!-- Dashboard Stats -->
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3 class="card-title">Blog Posts</h3>
                    <div class="card-stats" id="blog-count">12</div>
                    <p class="card-description">Total published blog posts</p>
                    <button class="card-btn" data-tab="blog-management">Manage Posts</button>
                </div>
                
                <div class="dashboard-card">
                    <h3 class="card-title">Players</h3>
                    <div class="card-stats" id="player-count">45</div>
                    <p class="card-description">Registered student athletes</p>
                    <button class="card-btn" data-tab="player-management">Manage Players</button>
                </div>
                
                <div class="dashboard-card">
                    <h3 class="card-title">Events</h3>
                    <div class="card-stats" id="event-count">8</div>
                    <p class="card-description">Upcoming sports events</p>
                    <button class="card-btn" data-tab="event-management">Manage Events</button>
                </div>
                
                <div class="dashboard-card">
                    <h3 class="card-title">Sports</h3>
                    <div class="card-stats" id="sport-count">6</div>
                    <p class="card-description">Active sports programs</p>
                    <button class="card-btn" data-tab="sport-management">Manage Sports</button>
                </div>
            </div>
            
            <!-- Admin Tabs -->
            <div class="admin-tabs">
                <div class="tab-headers">
                    <button class="tab-header active" data-tab="blog-management">Blog Management</button>
                    <button class="tab-header" data-tab="player-management">Player Management</button>
                    <button class="tab-header" data-tab="event-management">Event Management</button>
                    <button class="tab-header" data-tab="sport-management">Sport Management</button>
                </div>
                
                <!-- Blog Management Tab -->
                <div class="tab-content active" id="blog-management">
                    <h3>Manage Blog Posts</h3>
                    <p>Create, edit, or delete blog posts to share updates with the TU-K sports community.</p>
                    
                    <button class="card-btn" id="create-blog-post">Create New Post</button>
                    
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="blog-posts-table">
                            <!-- Blog posts will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Player Management Tab -->
                <div class="tab-content" id="player-management">
                    <h3>Manage Players</h3>
                    <p>View, edit, or remove student athletes from the sports program.</p>
                    
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Sport</th>
                                <th>Year</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="players-table">
                            <!-- Players will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Event Management Tab -->
                <div class="tab-content" id="event-management">
                    <h3>Manage Events</h3>
                    <p>Create, edit, or delete upcoming sports events and update the calendar.</p>
                    
                    <button class="card-btn" id="create-event">Create New Event</button>
                    
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Sport</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="events-table">
                            <!-- Events will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Sport Management Tab -->
                <div class="tab-content" id="sport-management">
                    <h3>Manage Sports</h3>
                    <p>Add new sports programs or remove existing ones from the TU-K sports offerings.</p>
                    
                    <button class="card-btn" id="create-sport">Add New Sport</button>
                    
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Sport Name</th>
                                <th>Coach</th>
                                <th>Players</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sports-table">
                            <!-- Sports will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Blog Post Modal -->
    <div class="modal" id="create-blog-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create New Blog Post</h3>
                <button class="modal-close" id="create-blog-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="create-blog-form">
                    <div class="form-group">
                        <label for="blog-title">Post Title *</label>
                        <input type="text" id="blog-title" name="blog-title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="blog-category">Category *</label>
                        <select id="blog-category" name="blog-category" required>
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
                        <label for="blog-image">Featured Image URL</label>
                        <input type="url" id="blog-image" name="blog-image" placeholder="https://example.com/image.jpg">
                    </div>
                    
                    <div class="form-group">
                        <label for="blog-excerpt">Excerpt *</label>
                        <textarea id="blog-excerpt" name="blog-excerpt" required placeholder="Brief description of your post..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="blog-content">Post Content *</label>
                        <textarea id="blog-content" name="blog-content" required placeholder="Write your blog post content here..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Publish Post</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Event Modal -->
    <div class="modal" id="create-event-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create New Event</h3>
                <button class="modal-close" id="create-event-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="create-event-form">
                    <div class="form-group">
                        <label for="event-name">Event Name *</label>
                        <input type="text" id="event-name" name="event-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-sport">Sport *</label>
                        <select id="event-sport" name="event-sport" required>
                            <option value="">Select a sport</option>
                            <option value="football">Football</option>
                            <option value="basketball">Basketball</option>
                            <option value="athletics">Athletics</option>
                            <option value="volleyball">Volleyball</option>
                            <option value="martial-arts">Martial Arts</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-date">Date *</label>
                        <input type="date" id="event-date" name="event-date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-time">Time *</label>
                        <input type="time" id="event-time" name="event-time" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-location">Location *</label>
                        <input type="text" id="event-location" name="event-location" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-description">Description</label>
                        <textarea id="event-description" name="event-description" placeholder="Event details..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Create Event</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Sport Modal -->
    <div class="modal" id="create-sport-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Sport</h3>
                <button class="modal-close" id="create-sport-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="create-sport-form">
                    <div class="form-group">
                        <label for="sport-name">Sport Name *</label>
                        <input type="text" id="sport-name" name="sport-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="sport-coach">Coach *</label>
                        <input type="text" id="sport-coach" name="sport-coach" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="sport-description">Description</label>
                        <textarea id="sport-description" name="sport-description" placeholder="Sport description..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="sport-status">Status</label>
                        <select id="sport-status" name="sport-status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="submit-btn">Add Sport</button>
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
        // Sample data for the admin dashboard
        let blogPosts = [
            {
                id: 1,
                title: "Football Team Prepares for Inter-University Championship",
                author: "Coach Mwangi",
                date: new Date(2025, 2, 10),
                category: "football"
            },
            {
                id: 2,
                title: "Basketball Team Secures Spot in Regional Finals",
                author: "Coach Kamau",
                date: new Date(2025, 2, 5),
                category: "basketball"
            },
            {
                id: 3,
                title: "Athletics Department Announces New Training Facilities",
                author: "Director of Sports",
                date: new Date(2025, 1, 28),
                category: "athletics"
            },
            {
                id: 4,
                title: "Martial Arts Club Achieves National Recognition",
                author: "Sensei Wanjiku",
                date: new Date(2025, 1, 15),
                category: "martial-arts"
            }
        ];

        let players = [
            { id: 1, name: "John Kamau", studentId: "TU001", sport: "Football", year: "3rd" },
            { id: 2, name: "Sarah Omondi", studentId: "TU002", sport: "Basketball", year: "2nd" },
            { id: 3, name: "David Mwangi", studentId: "TU003", sport: "Athletics", year: "4th" },
            { id: 4, name: "Grace Wanjiru", studentId: "TU004", sport: "Volleyball", year: "1st" },
            { id: 5, name: "Michael Otieno", studentId: "TU005", sport: "Martial Arts", year: "3rd" }
        ];

        let events = [
            { id: 1, name: "Inter-University Football Championship", date: "2025-04-15", time: "14:00", location: "Main Field", sport: "Football" },
            { id: 2, name: "Regional Basketball Finals", date: "2025-04-20", time: "16:00", location: "Sports Complex", sport: "Basketball" },
            { id: 3, name: "Athletics Training Camp", date: "2025-04-25", time: "08:00", location: "Track Field", sport: "Athletics" },
            { id: 4, name: "Volleyball Friendly Match", date: "2025-05-05", time: "15:00", location: "Indoor Court", sport: "Volleyball" }
        ];

        let sports = [
            { id: 1, name: "Football", coach: "Coach Mwangi", players: 15, status: "Active" },
            { id: 2, name: "Basketball", coach: "Coach Kamau", players: 12, status: "Active" },
            { id: 3, name: "Athletics", coach: "Coach Wanjala", players: 8, status: "Active" },
            { id: 4, name: "Volleyball", coach: "Coach Nyongesa", players: 10, status: "Active" },
            { id: 5, name: "Martial Arts", coach: "Sensei Wanjiku", players: 6, status: "Active" }
        ];

        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const tabHeaders = document.querySelectorAll('.tab-header');
            const tabContents = document.querySelectorAll('.tab-content');
            const dashboardButtons = document.querySelectorAll('.card-btn[data-tab]');
            const createBlogBtn = document.getElementById('create-blog-post');
            const createBlogModal = document.getElementById('create-blog-modal');
            const createBlogClose = document.getElementById('create-blog-close');
            const createBlogForm = document.getElementById('create-blog-form');
            const createEventBtn = document.getElementById('create-event');
            const createEventModal = document.getElementById('create-event-modal');
            const createEventClose = document.getElementById('create-event-close');
            const createEventForm = document.getElementById('create-event-form');
            const createSportBtn = document.getElementById('create-sport');
            const createSportModal = document.getElementById('create-sport-modal');
            const createSportClose = document.getElementById('create-sport-close');
            const createSportForm = document.getElementById('create-sport-form');
            
            // Update dashboard stats
            document.getElementById('blog-count').textContent = blogPosts.length;
            document.getElementById('player-count').textContent = players.length;
            document.getElementById('event-count').textContent = events.length;
            document.getElementById('sport-count').textContent = sports.length;
            
            // Initialize tables
            populateBlogTable();
            populatePlayersTable();
            populateEventsTable();
            populateSportsTable();
            
            // Tab functionality
            tabHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Remove active class from all headers and contents
                    tabHeaders.forEach(h => h.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked header and corresponding content
                    this.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // Dashboard buttons to switch tabs
            dashboardButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Remove active class from all headers and contents
                    tabHeaders.forEach(h => h.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to target header and content
                    document.querySelector(`.tab-header[data-tab="${tabId}"]`).classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // Blog post modal functionality
            createBlogBtn.addEventListener('click', function() {
                createBlogModal.style.display = 'flex';
            });
            
            createBlogClose.addEventListener('click', function() {
                createBlogModal.style.display = 'none';
            });
            
            // Event modal functionality
            createEventBtn.addEventListener('click', function() {
                createEventModal.style.display = 'flex';
            });
            
            createEventClose.addEventListener('click', function() {
                createEventModal.style.display = 'none';
            });
            
            // Sport modal functionality
            createSportBtn.addEventListener('click', function() {
                createSportModal.style.display = 'flex';
            });
            
            createSportClose.addEventListener('click', function() {
                createSportModal.style.display = 'none';
            });
            
            // Close modals when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === createBlogModal) {
                    createBlogModal.style.display = 'none';
                }
                if (event.target === createEventModal) {
                    createEventModal.style.display = 'none';
                }
                if (event.target === createSportModal) {
                    createSportModal.style.display = 'none';
                }
            });
            
            // Form submissions
            createBlogForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const title = document.getElementById('blog-title').value;
                const category = document.getElementById('blog-category').value;
                const excerpt = document.getElementById('blog-excerpt').value;
                const content = document.getElementById('blog-content').value;
                
                // Create new blog post
                const newPost = {
                    id: blogPosts.length + 1,
                    title: title,
                    author: "Coach Admin",
                    date: new Date(),
                    category: category
                };
                
                // Add to blog posts
                blogPosts.unshift(newPost);
                
                // Update display
                populateBlogTable();
                document.getElementById('blog-count').textContent = blogPosts.length;
                
                // Close modal and reset form
                createBlogModal.style.display = 'none';
                createBlogForm.reset();
                
                alert('Blog post created successfully!');
            });
            
            createEventForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = document.getElementById('event-name').value;
                const sport = document.getElementById('event-sport').value;
                const date = document.getElementById('event-date').value;
                const time = document.getElementById('event-time').value;
                const location = document.getElementById('event-location').value;
                const description = document.getElementById('event-description').value;
                
                // Create new event
                const newEvent = {
                    id: events.length + 1,
                    name: name,
                    date: date,
                    time: time,
                    location: location,
                    sport: sport
                };
                
                // Add to events
                events.unshift(newEvent);
                
                // Update display
                populateEventsTable();
                document.getElementById('event-count').textContent = events.length;
                
                // Close modal and reset form
                createEventModal.style.display = 'none';
                createEventForm.reset();
                
                alert('Event created successfully!');
            });
            
            createSportForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = document.getElementById('sport-name').value;
                const coach = document.getElementById('sport-coach').value;
                const description = document.getElementById('sport-description').value;
                const status = document.getElementById('sport-status').value;
                
                // Create new sport
                const newSport = {
                    id: sports.length + 1,
                    name: name,
                    coach: coach,
                    players: 0,
                    status: status
                };
                
                // Add to sports
                sports.unshift(newSport);
                
                // Update display
                populateSportsTable();
                document.getElementById('sport-count').textContent = sports.length;
                
                // Close modal and reset form
                createSportModal.style.display = 'none';
                createSportForm.reset();
                
                alert('Sport added successfully!');
            });
            
            // Populate tables with data
            function populateBlogTable() {
                const tableBody = document.getElementById('blog-posts-table');
                tableBody.innerHTML = '';
                
                blogPosts.forEach(post => {
                    const row = document.createElement('tr');
                    const postDate = post.date;
                    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    
                    row.innerHTML = `
                        <td>${post.title}</td>
                        <td>${post.author}</td>
                        <td>${postDate.getDate()} ${monthNames[postDate.getMonth()]} ${postDate.getFullYear()}</td>
                        <td>${post.category}</td>
                        <td>
                            <button class="action-btn edit-btn" data-id="${post.id}">Edit</button>
                            <button class="action-btn delete-btn" data-id="${post.id}">Delete</button>
                        </td>
                    `;
                    
                    tableBody.appendChild(row);
                });
                
                // Add event listeners to action buttons
                document.querySelectorAll('#blog-posts-table .edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const postId = parseInt(this.getAttribute('data-id'));
                        editBlogPost(postId);
                    });
                });
                
                document.querySelectorAll('#blog-posts-table .delete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const postId = parseInt(this.getAttribute('data-id'));
                        deleteBlogPost(postId);
                    });
                });
            }
            
            function populatePlayersTable() {
                const tableBody = document.getElementById('players-table');
                tableBody.innerHTML = '';
                
                players.forEach(player => {
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        <td>${player.name}</td>
                        <td>${player.studentId}</td>
                        <td>${player.sport}</td>
                        <td>${player.year}</td>
                        <td>
                            <button class="action-btn edit-btn" data-id="${player.id}">Edit</button>
                            <button class="action-btn delete-btn" data-id="${player.id}">Delete</button>
                        </td>
                    `;
                    
                    tableBody.appendChild(row);
                });
                
                // Add event listeners to action buttons
                document.querySelectorAll('#players-table .edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const playerId = parseInt(this.getAttribute('data-id'));
                        editPlayer(playerId);
                    });
                });
                
                document.querySelectorAll('#players-table .delete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const playerId = parseInt(this.getAttribute('data-id'));
                        deletePlayer(playerId);
                    });
                });
            }
            
            function populateEventsTable() {
                const tableBody = document.getElementById('events-table');
                tableBody.innerHTML = '';
                
                events.forEach(event => {
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        <td>${event.name}</td>
                        <td>${event.date} at ${event.time}</td>
                        <td>${event.location}</td>
                        <td>${event.sport}</td>
                        <td>
                            <button class="action-btn edit-btn" data-id="${event.id}">Edit</button>
                            <button class="action-btn delete-btn" data-id="${event.id}">Delete</button>
                        </td>
                    `;
                    
                    tableBody.appendChild(row);
                });
                
                // Add event listeners to action buttons
                document.querySelectorAll('#events-table .edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const eventId = parseInt(this.getAttribute('data-id'));
                        editEvent(eventId);
                    });
                });
                
                document.querySelectorAll('#events-table .delete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const eventId = parseInt(this.getAttribute('data-id'));
                        deleteEvent(eventId);
                    });
                });
            }
            
            function populateSportsTable() {
                const tableBody = document.getElementById('sports-table');
                tableBody.innerHTML = '';
                
                sports.forEach(sport => {
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        <td>${sport.name}</td>
                        <td>${sport.coach}</td>
                        <td>${sport.players}</td>
                        <td>${sport.status}</td>
                        <td>
                            <button class="action-btn edit-btn" data-id="${sport.id}">Edit</button>
                            <button class="action-btn delete-btn" data-id="${sport.id}">Delete</button>
                        </td>
                    `;
                    
                    tableBody.appendChild(row);
                });
                
                // Add event listeners to action buttons
                document.querySelectorAll('#sports-table .edit-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const sportId = parseInt(this.getAttribute('data-id'));
                        editSport(sportId);
                    });
                });
                
                document.querySelectorAll('#sports-table .delete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const sportId = parseInt(this.getAttribute('data-id'));
                        deleteSport(sportId);
                    });
                });
            }
            
            // Edit and Delete functions (simplified for demo)
            function editBlogPost(id) {
                alert(`Edit blog post with ID: ${id}`);
                // In a real application, this would open an edit form with the post data
            }
            
            function deleteBlogPost(id) {
                if (confirm('Are you sure you want to delete this blog post?')) {
                    blogPosts = blogPosts.filter(post => post.id !== id);
                    populateBlogTable();
                    document.getElementById('blog-count').textContent = blogPosts.length;
                    alert('Blog post deleted successfully!');
                }
            }
            
            function editPlayer(id) {
                alert(`Edit player with ID: ${id}`);
                // In a real application, this would open an edit form with the player data
            }
            
            function deletePlayer(id) {
                if (confirm('Are you sure you want to delete this player?')) {
                    players = players.filter(player => player.id !== id);
                    populatePlayersTable();
                    document.getElementById('player-count').textContent = players.length;
                    alert('Player deleted successfully!');
                }
            }
            
            function editEvent(id) {
                alert(`Edit event with ID: ${id}`);
                // In a real application, this would open an edit form with the event data
            }
            
            function deleteEvent(id) {
                if (confirm('Are you sure you want to delete this event?')) {
                    events = events.filter(event => event.id !== id);
                    populateEventsTable();
                    document.getElementById('event-count').textContent = events.length;
                    alert('Event deleted successfully!');
                }
            }
            
            function editSport(id) {
                alert(`Edit sport with ID: ${id}`);
                // In a real application, this would open an edit form with the sport data
            }
            
            function deleteSport(id) {
                if (confirm('Are you sure you want to delete this sport?')) {
                    sports = sports.filter(sport => sport.id !== id);
                    populateSportsTable();
                    document.getElementById('sport-count').textContent = sports.length;
                    alert('Sport deleted successfully!');
                }
            }
        });
    </script>
</body>
</html>
