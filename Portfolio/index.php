<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjali Rathod - Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #4cc9f0;
            --dark-color: #0a0a0b;
            --light-color: #f8f9fa;
            --text-color: #333333;
            --gradient-bg: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.7;
            overflow-x: hidden;
        }
        
        /* Navbar styling */
        .navbar {
            background-color: rgba(10, 10, 11, 0.9) !important;
            backdrop-filter: blur(10px);
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-shrink {
            padding: 10px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            letter-spacing: 1px;
            color: var(--accent-color) !important;
        }
        
        .nav-link {
            font-weight: 500;
            margin-left: 15px;
            position: relative;
            padding: 8px 0 !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Hero section */
        .hero {
            height: 100vh;
            background: var(--gradient-bg);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://api.placeholder.com/300/300') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }
        
        .hero .container {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }
        
        .hero img {
            border: 5px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.5s ease;
        }
        
        .hero img:hover {
            transform: scale(1.05);
        }
        
        .btn {
            padding: 12px 28px;
            font-weight: 500;
            border-radius: 30px;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .btn-primary:hover {
            background-color: transparent;
            border-color: var(--accent-color);
            color: var(--accent-color);
        }
        
        .btn-outline-light:hover {
            color: var(--dark-color);
        }
        
        /* Section styling */
        section {
            padding: 100px 0;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 50px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        /* About section */
        #about p {
            max-width: 800px;
            margin: 0 auto 20px;
            font-size: 1.1rem;
        }
        
        /* Skills section */
        #skills {
            background-color: #f9f9f9;
        }
        
        /* Education section */
        #education {
            background-color: white;
        }
        
        .education-item {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }
        
        .education-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .education-year {
            display: inline-block;
            padding: 5px 15px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .education-degree {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark-color);
        }
        
        .education-school {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }
        
        .education-score {
            font-weight: 500;
            color: var(--primary-color);
        }
        
        .skill-item {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .skill-item:hover {
            transform: translateY(-5px);
        }
        
        .skill-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .skill-title {
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .progress {
            height: 8px;
            border-radius: 10px;
            background-color: #e9ecef;
        }
        
        .progress-bar {
            background: var(--gradient-bg);
        }
        
        /* Contact section */
        #contact {
            background-color: #f9f9f9;
            position: relative;
        }
        
        .contact-info {
            margin-bottom: 50px;
        }
        
        .contact-info i {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .contact-form {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .form-control {
            height: 55px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            padding: 20px;
            margin-bottom: 20px;
            font-size: 15px;
            box-shadow: none !important;
        }
        
        textarea.form-control {
            height: auto;
            min-height: 150px;
        }
        
        /* Projects section */
        #projects {
            background-color: #f9f9f9;
        }
        
        .project-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        
        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .project-img {
            height: 200px;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .project-img i {
            font-size: 4rem;
            color: white;
        }
        
        .project-content {
            padding: 25px;
            background-color: white;
        }
        
        .project-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark-color);
            padding: 30px 0;
        }
        
        .social-links {
            margin-bottom: 20px;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            margin: 0 5px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        /* Animation classes */
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .fade-up.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            section {
                padding: 80px 0;
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            section {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Anjali<span style="color: white;"> Rathod</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Animation -->
    <header class="hero text-center text-white d-flex align-items-center justify-content-center">
        <div class="container">
            <img src="Anjali_raisoni.jpg" class="rounded-circle shadow-lg mb-4" width="180" alt="Anjali Rathod" data-aos="zoom-in">
            <h1 class="hero-title" data-aos="fade-up">Anjali Rathod</h1>
            <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">BCA Student | Software Tester | Developer | Marketing Head</p>
            <div data-aos="fade-up" data-aos-delay="400">
                <a href="#contact" class="btn btn-primary me-3">Hire Me</a>
                <a href="#projects" class="btn btn-outline-light">View Portfolio</a>
            </div>
            <div class="scroll-down mt-5" data-aos="fade-up" data-aos-delay="600">
                <a href="#about">
                    <i class="fas fa-chevron-down fa-2x text-white animate__animated animate__bounce animate__infinite"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2 class="section-title" data-aos="fade-up">About Me</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <p>Motivated BCA student specializing in Software Testing, Web Development, and Digital Marketing. Currently, I am the Placement Head at the Training and Placement Forum and Marketing Head at Encarta IT Cell.</p>
                    <p>I have strong problem-solving skills and a passion for learning new technologies. With a solid foundation in computer applications and programming, I am eager to apply my technical skills and leadership experience in a dynamic work environment.</p>
                    <!-- Find this line in the About section -->
                     

                    <!-- Replace it with this (assuming your resume is named "anjali_rathod_resume.pdf") -->
                      <a href="Anjali_Rathod_SS.pdf" class="btn btn-primary mt-4" download>Download CV <i class="fas fa-download ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="py-5">
        <div class="container text-center">
            <h2 class="section-title" data-aos="fade-up">Education</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="education-item" data-aos="fade-up" data-aos-delay="100">
                        <span class="education-year">2022 - 2025 (Expected)</span>
                        <h3 class="education-degree">Bachelor of Computer Application (BCA)</h3>
                        <p class="education-school">G H Raisoni College Of Arts, Commerce and Science, RTMN University, Nagpur</p>
                        <p class="education-score">Current CGPA: 7.5</p>
                    </div>
                    
                    <div class="education-item" data-aos="fade-up" data-aos-delay="200">
                        <span class="education-year">2022</span>
                        <h3 class="education-degree">12th Science Stream</h3>
                        <p class="education-school">Sai Baba Junior College Of Science And Arts</p>
                        <p class="education-score">Percentage: 85.17%</p>
                    </div>
                    
                    <div class="education-item" data-aos="fade-up" data-aos-delay="300">
                        <span class="education-year">2020</span>
                        <h3 class="education-degree">10th Board</h3>
                        <p class="education-school">Central India Public School</p>
                        <p class="education-score">Percentage: 72%</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-5">
        <div class="container text-center">
            <h2 class="section-title" data-aos="fade-up">My Skills</h2>
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="skill-item">
                        <i class="fas fa-code skill-icon"></i>
                        <h5 class="skill-title">Web Development</h5>
                        <p>HTML, CSS, JavaScript, Bootstrap</p>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="skill-item">
                        <i class="fas fa-laptop-code skill-icon"></i>
                        <h5 class="skill-title">Programming</h5>
                        <p>C, C++, PHP</p>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="skill-item">
                        <i class="fas fa-database skill-icon"></i>
                        <h5 class="skill-title">Database Management</h5>
                        <p>MySQL, SQL</p>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="skill-item">
                        <i class="fas fa-bullhorn skill-icon"></i>
                        <h5 class="skill-title">Digital Marketing</h5>
                        <p>Social Media, Content, Campaigns</p>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="skill-item">
                        <i class="fas fa-desktop skill-icon"></i>
                        <h5 class="skill-title">Operating Systems</h5>
                        <p>Windows, Linux</p>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="skill-item">
                        <i class="fas fa-users skill-icon"></i>
                        <h5 class="skill-title">Leadership</h5>
                        <p>Team Management, Communication</p>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-5">
        <div class="container text-center">
            <h2 class="section-title" data-aos="fade-up">Projects</h2>
            <div class="row">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Student Information System</h3>
                            <p>Developed using Visual Basic to efficiently manage student records with functionalities for adding, updating, and deleting information, demonstrating problem-solving and analytical skills in database management.</p>
                            <a href="#" class="btn btn-primary btn-sm mt-3">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-card">
                        <div class="project-img">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">Personal Portfolio Website</h3>
                            <p>Designed using HTML, CSS, and Bootstrap, implementing features for writing, editing, and deleting blog posts, showcasing front-end development proficiency and creativity.</p>
                            <a href="#" class="btn btn-primary btn-sm mt-3">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section with Form -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="section-title text-center" data-aos="fade-up">Get In Touch</h2>
            <div class="row justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info text-center">
                        <i class="fas fa-envelope"></i>
                        <h5>Email</h5>
                        <a href="mailto:anjalirathod030104@gmail.com" class="text-decoration-none">anjalirathod030104@gmail.com</a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info text-center">
                        <i class="fas fa-phone"></i>
                        <h5>Phone</h5>
                        <p>+91 9075451056</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info text-center">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Location</h5>
                        <p>Nagpur, Maharashtra, India</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="400">
                    <div class="contact-form">
                        <form action="contact.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            <textarea class="form-control" rows="5" name="message" placeholder="Your Message" required></textarea>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-white">
        <div class="container">
            <div class="social-links">
                <a href="https://linkedin.com/in/anjali-rathod-78929a276" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/anjali_rthod/"><i class="fab fa-instagram"></i></a>
            </div>
            <p>&copy; 2025 Anjali Rathod. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap & AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-shrink');
            } else {
                navbar.classList.remove('navbar-shrink');
            }
        });
        
        // Animation for elements with fade-up class
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.fade-up').forEach(element => {
            observer.observe(element);
        });
    </script>
</body>
</html>