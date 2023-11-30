<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="dash_style.css">
    <style>
        /* Additional Styles for Modern Service Cards */
        .services-container {
            overflow-x: auto;
        }

        .services-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding-bottom: 20px;
        }

        .service-card {
            width: 200px;
            margin: 20px;
            padding: 15px;
            border-radius: 10px;
            background-color: #008543;
            color: #ffffff;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
        }

        .service-card:hover {
            transform: scale(1.05);
        }

        .service-card img {
            width: 100%;
            height: 120px;
            /* Set the desired height for the image container */
            object-fit: cover;
            /* Maintain aspect ratio and cover the container */
            border-radius: 8px;
        }

        .service-card h3 {
            font-size: 18px;
            margin-top: 10px;
        }

        .service-card p {
            font-size: 16px;
            margin-top: 10px;
        }

        .card-icons {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .card-icons span {
            font-size: 20px;
            color: #fff;
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .card-icons span:hover {
            color: #ffcc00;
            /* Change the color on hover as per your preference */
        }
    </style>

</head>

<body>
    <?php
    include("config.php");
    include("firebaseRDB.php");
    include("secretary_sidebar.php");
    $db = new firebaseRDB($databaseURL);
    ?>
    <div class="main-content">
        <header>
            <div class="user-welcome">
                <span>Welcome, Handler!
                </span>
            </div>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
                <div class="search-overlay" id="search-overlay"></div>
            </div>
            <div class="social-icons">
                <span class="ti-bell"></span>
                <div></div>
            </div>
        </header>
        <main>
            <div class="user-profile">
                <span class="profile"></span>
                <span class="name"></span>
                <div></div>
            </div>
            <h2 class="dash-title">Overview</h2>
            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>Appointments</h5>
                            <h4>10+ patients</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="appointment.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-reload"></span>
                        <div>
                            <h5>Pending</h5>
                            <h4>3 patients</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="appointment.php">View all</a>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-check-box"></span>
                        <div>
                            <h5>Processed</h5>
                            <h4>2 patients</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="appointment.php">View all</a>
                    </div>
                </div>
            </div>
            <section id="services" class="section">
                <div class="container">
                    <div class="services-cards">
                        <!-- 8 Service Cards -->
                        <div class="service-card">
                            <img src="int.jpeg" alt="Internal Medicine">
                            <h3>Internal Medicine</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                        <div class="service-card">
                            <img src="hema.jpg" alt="Service 1">
                            <h3>Internal Medicine (Adult Hematology)</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                        <div class="service-card">
                            <img src="in.jpg" alt="Service 1">
                            <h3>Internal Medicine (Infectious Diseases)</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                        <div class="service-card">
                            <img src="pul.jpg" alt="Service 1">
                            <h3>Internal Medicine (Pulmonology)</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                        <div class="service-card">
                            <img src="obg.jpg" alt="Service 1">
                            <h3>Obstetrics and Gynecology</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                        <div class="service-card">
                            <img src="ortho.jpg" alt="Service 1">
                            <h3>General Orthopaedic Surgery</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                        <div class="service-card">
                            <img src="rehab.png" alt="Service 1">
                            <h3>Physical Medicine and Rehabilitation</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                        <div class="service-card">
                            <img src="p.png" alt="Service 1">
                            <h3>Pediatrics, Vaccines, and Immunizations</h3>
                            <div class="card-icons">
                                <span class="ti-bell"></span>
                                <span class="ti-calendar"></span>
                                <span class="ti-time"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="summary">
                    <div class="summary-card">
                        <div class="summary-single">
                            <span class="ti-id-badge"></span>
                            <div>
                                <h5>196</h5>
                                <small>Number of Patients</small>
                            </div>
                        </div>
                        <div class="summary-single">
                            <span class="ti-calendar"></span>
                            <div>
                                <h5>16</h5>
                                <small>Schedule ni doc</small>
                            </div>
                        </div>
                        <div class="summary-single">
                            <span class="ti-face-smile"></span>
                            <div>
                                <h5>12</h5>
                                <small>Profile update request</small>
                            </div>
                        </div>
                    </div>

                    <div class="bday-card">
                        <div class="bday-flex">
                            <div class="bday-img"></div>
                            <div class="bday-info">
                                <h5>Dwayne F. Sanders</h5>
                                <small>Upcoming Surgery</small>
                            </div>
                        </div>

                        <div class="text-center">
                            <button>
                                <span class="ti-gift"></span>
                                Prioritize patient
                            </button>
                        </div>
                    </div>
                </div>
    </div>
    </section>


    </div>
    </main>
    </div>
</body>

</html>