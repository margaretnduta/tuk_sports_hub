<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Schedule - Technical University of Kenya Sports</title>
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
        
        /* Schedule Section */
        .schedule-section {
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
        
        .schedule-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .filter-options {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 8px 16px;
            background-color: #f0f8ff;
            border: 1px solid #003366;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
            color: #003366;
        }
        
        .filter-btn.active {
            background-color: #003366;
            color: white;
        }
        
        .filter-btn:hover {
            background-color: #003366;
            color: white;
        }
        
        .search-box {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 250px;
        }
        
        /* Calendar View */
        .calendar-view {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 40px;
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #003366;
            color: white;
        }
        
        .calendar-nav {
            display: flex;
            gap: 15px;
        }
        
        .calendar-nav button {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #ddd;
        }
        
        .calendar-day-header {
            background-color: #f0f8ff;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            color: #003366;
        }
        
        .calendar-day {
            background-color: white;
            padding: 10px;
            min-height: 120px;
            position: relative;
        }
        
        .calendar-day.other-month {
            background-color: #f9f9f9;
            color: #aaa;
        }
        
        .calendar-day.has-events {
            background-color: #f0f8ff;
        }
        
        .day-number {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .event-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #2E8B57;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        .event-item {
            font-size: 0.8rem;
            margin-bottom: 3px;
            padding: 2px 5px;
            background-color: #e8f4fd;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .event-item:hover {
            background-color: #d4edf9;
        }
        
        /* Events List View */
        .events-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }
        
        .event-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
        }
        
        .event-header {
            padding: 20px;
            background-color: #003366;
            color: white;
        }
        
        .event-date {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .event-sport {
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .event-details {
            padding: 20px;
        }
        
        .event-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .event-icon {
            margin-right: 10px;
            color: #003366;
            font-size: 1.2rem;
        }
        
        .event-result {
            margin-top: 15px;
            padding: 15px;
            background-color: #f0f8ff;
            border-radius: 5px;
        }
        
        .result-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #003366;
        }
        
        .team-result {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .team-name {
            font-weight: bold;
        }
        
        .team-score {
            font-weight: bold;
            color: #2E8B57;
        }
        
        .winner {
            color: #2E8B57;
        }
        
        .loser {
            color: #cc0000;
        }
        
        .upcoming-event {
            border-left: 5px solid #2E8B57;
        }
        
        .past-event {
            border-left: 5px solid #cc0000;
        }
        
        /* Modal for Event Details */
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
            max-height: 80vh;
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
            
            .schedule-controls {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-box {
                width: 100%;
            }
            
            .calendar-grid {
                grid-template-columns: repeat(7, 1fr);
                font-size: 0.8rem;
            }
            
            .calendar-day {
                min-height: 80px;
                padding: 5px;
            }
            
            .events-list {
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
                        <li><a href="schedule.php" class="active">Events</a></li>                        
                        <li><a href="Blog.php">Blogs</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Schedule Section -->
    <section class="schedule-section">
        <div class="container">
            <h2 class="section-title">Sports Events Schedule</h2>
            
            <div class="schedule-controls">
                <div class="filter-options">
                    <button class="filter-btn active" data-filter="all">All Events</button>
                    <button class="filter-btn" data-filter="upcoming">Upcoming</button>
                    <button class="filter-btn" data-filter="past">Past Events</button>
                    <button class="filter-btn" data-filter="football">Football</button>
                    <button class="filter-btn" data-filter="basketball">Basketball</button>
                    <button class="filter-btn" data-filter="athletics">Athletics</button>
                </div>
                <input type="text" class="search-box" placeholder="Search events...">
            </div>
            
            <!-- Calendar View -->
            <div class="calendar-view">
                <div class="calendar-header">
                    <h3 id="current-month">March 2025</h3>
                    <div class="calendar-nav">
                        <button id="prev-month">â€¹</button>
                        <button id="next-month">â€º</button>
                    </div>
                </div>
                <div class="calendar-grid" id="calendar-grid">
                    <!-- Calendar will be generated by JavaScript -->
                </div>
            </div>
            
            <!-- Events List View -->
            <div class="events-list" id="events-list">
                <!-- Events will be populated by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Event Details Modal -->
    <div class="modal" id="event-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Event Details</h3>
                <button class="modal-close" id="modal-close">&times;</button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- Modal content will be populated by JavaScript -->
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
        // Sample events data
        const eventsData = [
            {
                id: 1,
                title: "Football: TU-K vs UoN",
                sport: "football",
                date: new Date(2025, 2, 15, 14, 0), // March 15, 2025, 2:00 PM
                location: "Main Football Field",
                description: "Inter-university football match between Technical University of Kenya and University of Nairobi.",
                teams: [
                    { name: "TU-K Lions", score: 2, winner: true },
                    { name: "UoN Tigers", score: 1, winner: false }
                ],
                status: "completed"
            },
            {
                id: 2,
                title: "Basketball Tournament Finals",
                sport: "basketball",
                date: new Date(2025, 2, 20, 16, 30), // March 20, 2025, 4:30 PM
                location: "Indoor Sports Complex",
                description: "Annual basketball tournament finals featuring the top teams from different faculties.",
                teams: [
                    { name: "Engineering Eagles", score: 75, winner: true },
                    { name: "Business Sharks", score: 68, winner: false }
                ],
                status: "completed"
            },
            {
                id: 3,
                title: "Athletics: Track & Field Championship",
                sport: "athletics",
                date: new Date(2025, 2, 25, 9, 0), // March 25, 2025, 9:00 AM
                location: "University Stadium",
                description: "Annual track and field championship with various running and field events.",
                teams: [],
                status: "upcoming"
            },
            {
                id: 4,
                title: "Volleyball: Faculty Competition",
                sport: "volleyball",
                date: new Date(2025, 3, 5, 15, 0), // April 5, 2025, 3:00 PM
                location: "Volleyball Court",
                description: "Inter-faculty volleyball competition with teams from all departments.",
                teams: [],
                status: "upcoming"
            },
            {
                id: 5,
                title: "Handball: TU-K vs JKUAT",
                sport: "handball",
                date: new Date(2025, 2, 10, 11, 0), // March 10, 2025, 11:00 AM
                location: "Handball Court",
                description: "Friendly handball match between TU-K and JKUAT.",
                teams: [
                    { name: "TU-K Warriors", score: 21, winner: false },
                    { name: "JKUAT Jaguars", score: 25, winner: true }
                ],
                status: "completed"
            },
            {
                id: 6,
                title: "Martial Arts Demonstration",
                sport: "martial-arts",
                date: new Date(2025, 3, 12, 17, 0), // April 12, 2025, 5:00 PM
                location: "Martial Arts Dojo",
                description: "Martial arts demonstration featuring karate, taekwondo, and judo performances.",
                teams: [],
                status: "upcoming"
            },
            {
                id: 7,
                title: "Chess Championship",
                sport: "chess",
                date: new Date(2025, 2, 18, 10, 0), // March 18, 2025, 10:00 AM
                location: "Library Conference Room",
                description: "University chess championship with participants from all years.",
                teams: [],
                status: "completed"
            },
            {
                id: 8,
                title: "Rugby: TU-K vs Strathmore",
                sport: "rugby",
                date: new Date(2025, 3, 8, 14, 30), // April 8, 2025, 2:30 PM
                location: "Rugby Field",
                description: "Rugby match between TU-K and Strathmore University.",
                teams: [],
                status: "upcoming"
            }
        ];

        // Calendar and Events functionality
        document.addEventListener('DOMContentLoaded', function() {
            const calendarGrid = document.getElementById('calendar-grid');
            const eventsList = document.getElementById('events-list');
            const currentMonthElement = document.getElementById('current-month');
            const prevMonthBtn = document.getElementById('prev-month');
            const nextMonthBtn = document.getElementById('next-month');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const searchBox = document.querySelector('.search-box');
            const eventModal = document.getElementById('event-modal');
            const modalClose = document.getElementById('modal-close');
            const modalTitle = document.getElementById('modal-title');
            const modalBody = document.getElementById('modal-body');

            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();
            let activeFilter = 'all';
            let searchTerm = '';

            // Initialize the page
            generateCalendar(currentMonth, currentYear);
            displayEvents();

            // Event listeners for calendar navigation
            prevMonthBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                generateCalendar(currentMonth, currentYear);
            });

            nextMonthBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                generateCalendar(currentMonth, currentYear);
            });

            // Event listeners for filter buttons
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    activeFilter = this.getAttribute('data-filter');
                    displayEvents();
                });
            });

            // Event listener for search
            searchBox.addEventListener('input', function() {
                searchTerm = this.value.toLowerCase();
                displayEvents();
            });

            // Event listener for modal close
            modalClose.addEventListener('click', function() {
                eventModal.style.display = 'none';
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === eventModal) {
                    eventModal.style.display = 'none';
                }
            });

            // Generate calendar
            function generateCalendar(month, year) {
                calendarGrid.innerHTML = '';
                
                // Set current month display
                const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"];
                currentMonthElement.textContent = `${monthNames[month]} ${year}`;
                
                // Add day headers
                const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                dayNames.forEach(day => {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day-header';
                    dayElement.textContent = day;
                    calendarGrid.appendChild(dayElement);
                });
                
                // Get first day of month and number of days
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                
                // Add empty cells for days before the first day of the month
                for (let i = 0; i < firstDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'calendar-day other-month';
                    calendarGrid.appendChild(emptyDay);
                }
                
                // Add days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day';
                    dayElement.innerHTML = `<div class="day-number">${day}</div>`;
                    
                    // Check if this day has events
                    const dayEvents = getEventsForDay(day, month, year);
                    if (dayEvents.length > 0) {
                        dayElement.classList.add('has-events');
                        dayEvents.forEach(event => {
                            const eventElement = document.createElement('div');
                            eventElement.className = 'event-item';
                            eventElement.textContent = event.title;
                            eventElement.addEventListener('click', function() {
                                showEventDetails(event);
                            });
                            dayElement.appendChild(eventElement);
                        });
                    }
                    
                    calendarGrid.appendChild(dayElement);
                }
            }

            // Get events for a specific day
            function getEventsForDay(day, month, year) {
                return eventsData.filter(event => {
                    const eventDate = event.date;
                    return eventDate.getDate() === day && 
                           eventDate.getMonth() === month && 
                           eventDate.getFullYear() === year;
                });
            }

            // Display events based on filters
            function displayEvents() {
                eventsList.innerHTML = '';
                
                let filteredEvents = eventsData;
                
                // Apply filter
                if (activeFilter === 'upcoming') {
                    filteredEvents = eventsData.filter(event => event.status === 'upcoming');
                } else if (activeFilter === 'past') {
                    filteredEvents = eventsData.filter(event => event.status === 'completed');
                } else if (activeFilter !== 'all') {
                    filteredEvents = eventsData.filter(event => event.sport === activeFilter);
                }
                
                // Apply search
                if (searchTerm) {
                    filteredEvents = filteredEvents.filter(event => 
                        event.title.toLowerCase().includes(searchTerm) ||
                        event.description.toLowerCase().includes(searchTerm) ||
                        event.location.toLowerCase().includes(searchTerm)
                    );
                }
                
                // Sort events by date
                filteredEvents.sort((a, b) => a.date - b.date);
                
                // Display events
                filteredEvents.forEach(event => {
                    const eventCard = document.createElement('div');
                    eventCard.className = `event-card ${event.status === 'upcoming' ? 'upcoming-event' : 'past-event'}`;
                    
                    const eventDate = event.date;
                    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                    
                    eventCard.innerHTML = `
                        <div class="event-header">
                            <div class="event-date">${eventDate.getDate()} ${monthNames[eventDate.getMonth()]} ${eventDate.getFullYear()}</div>
                            <div class="event-sport">${event.title}</div>
                        </div>
                        <div class="event-details">
                            <div class="event-info">
                                <span class="event-icon">ðŸ•’</span>
                                <span>${dayNames[eventDate.getDay()]}, ${eventDate.getHours()}:${eventDate.getMinutes().toString().padStart(2, '0')}</span>
                            </div>
                            <div class="event-info">
                                <span class="event-icon">ðŸ“</span>
                                <span>${event.location}</span>
                            </div>
                            <div class="event-info">
                                <span class="event-icon">âš½</span>
                                <span>${event.sport.charAt(0).toUpperCase() + event.sport.slice(1)}</span>
                            </div>
                            ${event.status === 'completed' && event.teams.length > 0 ? `
                            <div class="event-result">
                                <div class="result-title">Match Result</div>
                                ${event.teams.map(team => `
                                    <div class="team-result">
                                        <span class="team-name ${team.winner ? 'winner' : 'loser'}">${team.name}</span>
                                        <span class="team-score">${team.score}</span>
                                    </div>
                                `).join('')}
                            </div>
                            ` : ''}
                            <button class="view-details-btn" style="margin-top: 15px; padding: 8px 15px; background-color: #003366; color: white; border: none; border-radius: 4px; cursor: pointer;">View Details</button>
                        </div>
                    `;
                    
                    const viewDetailsBtn = eventCard.querySelector('.view-details-btn');
                    viewDetailsBtn.addEventListener('click', function() {
                        showEventDetails(event);
                    });
                    
                    eventsList.appendChild(eventCard);
                });
            }

            // Show event details in modal
            function showEventDetails(event) {
                modalTitle.textContent = event.title;
                
                const eventDate = event.date;
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                
                let modalContent = `
                    <div class="event-info">
                        <span class="event-icon">ðŸ“…</span>
                        <span>${dayNames[eventDate.getDay()]}, ${eventDate.getDate()} ${monthNames[eventDate.getMonth()]} ${eventDate.getFullYear()}</span>
                    </div>
                    <div class="event-info">
                        <span class="event-icon">ðŸ•’</span>
                        <span>${eventDate.getHours()}:${eventDate.getMinutes().toString().padStart(2, '0')}</span>
                    </div>
                    <div class="event-info">
                        <span class="event-icon">ðŸ“</span>
                        <span>${event.location}</span>
                    </div>
                    <div class="event-info">
                        <span class="event-icon">âš½</span>
                        <span>${event.sport.charAt(0).toUpperCase() + event.sport.slice(1)}</span>
                    </div>
                    <div class="event-info">
                        <span class="event-icon">ðŸ“</span>
                        <span>${event.description}</span>
                    </div>
                `;
                
                if (event.status === 'completed' && event.teams.length > 0) {
                    modalContent += `
                        <div class="event-result" style="margin-top: 20px;">
                            <div class="result-title">Match Result</div>
                            ${event.teams.map(team => `
                                <div class="team-result">
                                    <span class="team-name ${team.winner ? 'winner' : 'loser'}">${team.name}</span>
                                    <span class="team-score">${team.score}</span>
                                </div>
                            `).join('')}
                        </div>
                    `;
                } else if (event.status === 'upcoming') {
                    modalContent += `
                        <div class="event-result" style="margin-top: 20px; background-color: #e8f5e8;">
                            <div class="result-title" style="color: #2E8B57;">Upcoming Event</div>
                            <p>This event is scheduled to happen in the future. Check back later for results!</p>
                        </div>
                    `;
                }
                
                modalBody.innerHTML = modalContent;
                eventModal.style.display = 'flex';
            }
        });
    </script>
</body>
</html>
