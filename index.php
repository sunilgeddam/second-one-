

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>






<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkHorse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3cEf5zq+ndoq7zN7kYDLzGTmxu2Ra8G7VG/kQPXs5xd6glQkG0F/2hRK116IQv2S6sb" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C89scichPD0TNL3GYe70qVM2DjhG5KLCk/2cPn2iUqm+rBQMhflW8Q2rFSaKTpW6wRDJM" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #037782;">
        <div class="container-fluid">
            <a href="index.php">
                <img style="height: 80px; width: 230px;" src="images/Work-Horse.png" alt="Logo">
            </a>
            <!-- Keep navbar always expanded -->
            <div style="position: relative;top: 7px;" class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item me-3">
                        <a class="nav-link text-white" href="index.php">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-white" href="services.html">Services</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-white" href="industries.html">Industries</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-white" href="contactus.html">Contact Us</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link text-white" href="aboutus.html">About Us</a>
                    </li>
                    <!-- Profile Section with Dropdown -->
                    <li style="position: relative;bottom:6px;" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img  src="https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                            <!-- <span>Profile</span> -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="viewprofile.php">View Profile</a></li>
                            <!-- <li><a class="dropdown-item" href="settings.php">Settings</a></li> -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>



    <section class="hero" id="home">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Unlock Your Business Potential with Expert Staffing & Consulting</h1>
            <p>We connect top-tier talent with organizations and provide strategic insights to streamline operations,
                boost productivity, and drive growth.</p>
            <a href="contactus.html" class="cta-button">Get Started</a>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Us</h2>
                    <p>At WorkHorse, we specialize in providing expert staffing, recruitment, and consulting solutions
                        to businesses of all sizes. Our mission is to connect top-tier talent with organizations,
                        enabling both to thrive. Whether you need to fill immediate vacancies, recruit high-level
                        executives, or require expert consulting to streamline operations, we are your trusted partner
                        in driving success.</p>
                    <a href="aboutus.html" class="about-btn">Learn More</a>
                </div>
                <div class="about-image">
                    <img src="https://st.depositphotos.com/1038076/4908/i/450/depositphotos_49080337-stock-photo-about-us.jpg"
                        alt="About Us Image">
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <h2>Our Services</h2>
            <p>We offer a wide range of services to meet the needs of our clients. Whether you're looking for staffing
                solutions, consulting services, or professional recruiting, we have the expertise to help your business
                grow and succeed.</p>
            <div class="service-cards">
                <div class="service-card">
                    <img src="https://5.imimg.com/data5/SELLER/Default/2021/1/ES/LM/ND/57566329/staffing-solutions.jpg"
                        alt="Staffing Solutions">
                    <h3>Staffing Solutions</h3>
                    <p>Find the right talent for your business, whether it's short-term, part-time, or full-time
                        staffing.</p>
                </div>





                <div class="service-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNN6W-kNRabE6uTKm4AIy4FlXXbP6y6WHYFQ&s"
                        alt="Consulting Services">
                    <h3>Consulting Services</h3>
                    <p>Our consultants provide strategic guidance to help streamline operations and boost productivity.
                    </p>
                </div>
                <div class="service-card">
                    <img src="https://catalog.wlimg.com/5/575711/full-images/recruitment-agency-in-bangalore-43895.jpg"
                        alt="Recruiting Services">
                    <h3>Recruiting Services</h3>
                    <p>We specialize in recruiting top-tier professionals who fit your company's culture and needs.</p>
                </div>
            </div>

            <div class="cta-container">
                <a href="contactus.html" class="cta-button">Get in Touch</a>
            </div>
        </div>
    </section>

    <section class="industries">
        <div class="container">
            <h2>Industries We Serve</h2>
            <p>We specialize in providing tailored staffing solutions to various industries. Here’s a look at some of
                the key sectors where we make a significant impact.</p>
            <div class="industry-cards">
                <div class="industry-card"
                    style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTK6ZEpUCas4QqhK9DiLhlJXxayezqqxKuYTrLG0UacRyN84IY4EJ4nR9ZFp1PRWplhKNU&usqp=CAU');">
                    <div class="industry-card-content">
                        <h3>Healthcare</h3>
                        <p style="position: relative;top: 5px;">Connecting healthcare professionals with organizations
                            to improve patient care and operations.</p>
                    </div>
                </div>

                <div class="industry-card"
                    style="background-image: url('https://bsmedia.business-standard.com/_media/bs/img/article/2024-07/07/full/1720369883-1424.jpg?im=FeatureCrop,size=(826,465)');">
                    <div class="industry-card-content">
                        <h3>IT & Tech</h3>
                        <p style="position: relative;top: 5px;">Specialized tech staffing for software development, IT
                            infrastructure, and cybersecurity.</p>
                    </div>
                </div>

                <div class="industry-card"
                    style="background-image: url('https://media.istockphoto.com/id/543558426/photo/financial-data-on-a-monitor-stock-market-data.jpg?s=1024x1024&w=is&k=20&c=ZTlJuVdQO36GLvP4tFWcuRXP8RjBQjey3dM2WPpWHWg=');">
                    <div class="industry-card-content">
                        <h3>Finance</h3>
                        <p style="position: relative;top: 5px;">Providing financial experts for accounting, investment,
                            and analysis roles in the finance sector.</p>
                    </div>
                </div>


            </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2>Ready to Transform Your Workforce?</h2>
            <p>Partner with WorkHorse today for expert staffing, consulting, and recruitment services that will drive
                your business forward. Let’s build a better future together.</p>
            <div class="cta-button-container">
                <a href="contactus.html" class="cta-button">Get in Touch</a>
            </div>
        </div>
    </section>

    <section class="blog" id="blog">
        <div class="container">
            <h2 class="section-title">Our Latest Blog Posts</h2>
            <div class="blog-grid">
                <div class="blog-card">
                    <div class="blog-img">
                        <img src="https://globtierinfotech.com/wp-content/uploads/2024/04/staffing-solutions.jpg"
                            alt="Blog Post 1">
                    </div>
                    <div class="blog-info">
                        <h3>Staffing Solutions for 2024</h3>
                        <p>Discover how businesses can stay ahead of the curve with cutting-edge staffing strategies in
                            2024.</p>
                        <div class="extra-content" style="display:none;">
                            <p>Additional content about staffing solutions for 2024, strategies for future workforce
                                management, and how companies can adapt to emerging trends.</p>
                        </div>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>

                <div class="blog-card">
                    <div class="blog-img">
                        <img src="https://kantata.marketing/wp-content/uploads/2021/08/consultant-project-managment-tips.jpg"
                            alt="Blog Post 2">
                    </div>
                    <div class="blog-info">
                        <h3>Consulting Tips</h3>
                        <p>Learn the best practices for leveraging consulting to streamline your operations and grow
                            effectively.</p>
                        <div class="extra-content" style="display:none;">
                            <p>Explore strategies for optimizing your consulting practice, understanding client needs,
                                and increasing operational efficiency.</p>
                        </div>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>

                <div class="blog-card">
                    <div class="blog-img">
                        <img src="https://xperti.io/wp-content/uploads/2023/12/Top-10-Biggest-Hiring-Challenges-Recruiters-Face-in-2024.jpg"
                            alt="Blog Post 3">
                    </div>
                    <div class="blog-info">
                        <h3>Recruiting Top Talent in 2024</h3>
                        <p>Top talent recruitment strategies that are transforming the hiring process in 2024.</p>
                        <div class="extra-content" style="display:none;">
                            <p>Learn about emerging recruitment trends, leveraging AI in hiring, and how to attract the
                                best candidates for your business.</p>
                        </div>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>

                <div class="blog-card">
                    <div class="blog-img">
                        <img src="https://miro.medium.com/v2/resize:fit:2000/0*A3RM6GlBKFS_SioS" alt="Blog Post 4">
                    </div>
                    <div class="blog-info">
                        <h3>The Future of Remote Work</h3>
                        <p>How remote work is reshaping the workforce and what businesses need to do to thrive in the
                            new era of work.</p>
                        <div class="extra-content" style="display:none;">
                            <p>Deep dive into remote work trends, how to maintain productivity, and the impact of
                                flexible work environments on businesses.</p>
                        </div>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Get Started?</h2>
                <p>Take the first step towards building a stronger, more efficient workforce. Whether you need staffing
                    solutions, expert consulting, or professional recruiting, we're here to help.</p>
                <a href="contactus.html" class="cta-button">Contact Us</a>
            </div>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-logo">
                    <a href="index.php"><img src="images/Work-Horse.png" alt="WorkHorse Logo"
                            class="footer-logo-img"></a>
                </div>

                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="aboutus.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="industries.html">Industries</a></li>
                        <li><a href="contactus.html">Contact</a></li>

                        <!-- <li><a href="#privacy-policy">Privacy Policy</a></li> -->
                        <!-- <li><a href="#terms-of-service">Terms of Service</a></li> -->
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4>Contact Us</h4>
                    <p>1234 Street Name, City, State, 56789</p>
                    <p>Phone: +1 234 567 8901</p>
                    <p>Email: <a href="mailto:info@workhorse.com">info@workhorse.com</a></p>
                </div>

                <div class="footer-social">
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="#" target="_blank"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAgVBMVEUAAAAQcP8IZf8IZ/8JZv8HZf8IZv8IZv8IaP8JZ/8HZv8IZv8FZf8YcP9FjP+TvP/g7P/////R4/9Vlf8QYP+Es/9kn/8IZv8nef8JZf8AYP/v9f/Q4v/B2P9GjP8HZv+yz//Q4/83g/8HZv/g6/+Dsv8HZf/n7//////////e6//ZLyHjAAAAK3RSTlMAEGCfz+//XyCQj98w/////////xD//6D/kBD/////7////8///5Cgz+/vONkvXQAAAPJJREFUeAF9kkUCwzAMBGVSGMrM3P//rxBaB+e6s0YREFJpw2y0cgS1cT3DQLmNWPjcwK/XA24RWIuEdg4j7OtHUX0NYedxko5+jCeZMc0En8FsVDDHSd1WDoFdIlogX46awopozWA+ythsd7s9ZxymJBkcs3wcMZC0YHDKhDNbKLowuGYC21zINIWUbQ7EwwJT7YogqgTTKaTY4tIp7HDIRadwwzVlKVyv11HG9cekFBxam8FbTInuQ4LCd3cL2Uzd+4UV/VkHfUIgMLRdQuBi7JsCxh5rQEAfrO9NYSWojruwBOOhDoR8PF+j0fuipNX+AmbCIviMIiwCAAAAAElFTkSuQmCC"
                                    alt="Facebook" class="social-icon"></a></li>
                        <li><a href="#" target="_blank"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAABDUlEQVR4AWP4////gOLB44D6nTcsGIo33QHi/zTGd0B2YTiAPpYjHIHNAf/piQk6wGPW8f/rLz8HYRCbXg5AWI4GQGJ0cwDY12gAJDbcHUA4CkZAIqQUK7Ts/m/SfxBMs5RupswBaACr+P47b/5zlG/5DyzZ/r/+8hNF7vuvP//nn3r0X6JhJ+0ccPrR+/+H7735jw9cf/n5v0D1Nuo5gBxQve06zR0AjoL7b7/+//zjN4bc+ScfaOeA33///k9Yfg4mDw7u/Xdeo6uhnQP6D93FMNxlxjF0ZbRzgMXEQ9iyI90cALIMJoccDXRzAK6CZog6YNQBow6gIx54Bwx4x2RAu2bAysoEZu9o7xgAQrvkxt3WZi0AAAAASUVORK5CYII="
                                    alt="LinkedIn" class="social-icon"></a></li>
                        <li><a href="#" target="_blank"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAAAAABXZoBIAAAA/0lEQVR4AbXPIazCMACE4d+L2qoZFEGSIGcRc/gJJB5XMzGJmK9EN0HMi+qaibkKVF1txdQe4g0YzPK5yyWXHL9TaPNQ89LojH87N1rbJcXkMF4Fk31UMrf34hm14KUeoQxGArALHTMuQD2cAWQfJXOpgTbksGr9ng8qluShJTPhyCdx63POg7rEim95ZyR68I1ggQpnCEGwyPicw6hZtPEGmnhkycqOio1zm6XuFtyw5XDXfGvuau0dXHzJp8pfBPuhIXO9ZK5ILUCdSvLYMpc6ASBtl3EaC97I4KaFaOCaBE9Zn5jUsVqR2vcTJZO1DdbGoZryVp94Ka/mQfE7f2T3df0WBhLDAAAAAElFTkSuQmCC"
                                    alt="Twitter" class="social-icon"></a></li>
                        <li><a href="#" target="_blank"><img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAMAAABF0y+mAAABWVBMVEVyHVFHcEx0Fvp8Fv1yFP1/FfyLCOyfBOmtAeS7AuDHAd3UANjZAs7rD6xyFvzjANTqAMHoA7l2F/yPFfx8GPmfD/zFF/XVWujoZuLyZt3pRt/yGdHyA8j1AKTViPj/9Pr////8g9f9A7r3DZz5vO794Pf+ruj9B6uzFPv7JLv+AJr+BI/+YMP/1vD+AIThG+n9GZn/vd3/YZz+AXP+GoT/r8r+AmT/b5z+HHH+I3f+G2P/ur7+FFD+Klb+fYv/wcr+LUf+LWX+AFn+Nzr+Ohz+RT7+inP+Si7/ztD+TxL/zbv+Wy//9fH+WgL+c1X+ZyX+PUv+Bzv+VXD+cxr/6eL+aQT+eAX+nDj+gwD+gxH+fSL+rYn+jwD+iwL+XhX/3rn/1bH9ZR/+lwP+nwH+xHH8ZC3+qAH+sAD+wAP+x1P+zGb+pl79mQn+uAD9J3T+ygD9O1n8pRL9twuaEkMNAAAAc3RSTlMBAF3G///////////GW9j//9nY/1r///////////7//////8b/////////////////////////////////////////////////////////////////////////////////xf///1v////////Y/9j/2VzGSus+GgAAAeNJREFUeAFFjEWiU0EQRc/tqu74V9wZ4TBiB6wG3wpzVoQ7zHCXeELypHH+KVchJAESaEs0IUv0Zv+7fwLgSAOk9ZFghcnfDw4AAg18cyhWCKNVob9NCZjQLWVrEGhJbJGDoCBpMwCrJTETAKBWgdeRGb4dmJW56PdI/KU1K4X15N+AFsW0+3/WVm7Pa0Pmu4Fh7HcbRIjMIhr3FItUGAH4SNZKjK32YjKpK3Iv0yUY0b8g0Vs0oK+8wbeyMBAQwVeo44R1z7XWq6rqpn5jiTmAeQO3iceg9zkYzKvc71iEmMFbqCJJ4tDcKFrLjX5D/MEdq8GpIUUgd/tgGboTgiUDPDZ44SXNpr0gWRcAgqEmEPJRNVPOxYaOth0oAHdCxWoOzslH+RCvlafYMgFUHvAIHoCjz16io80BrH/j0AAcJ9KWKkhn5sRyGjsDtr/sqyrsWNO1cW9/cDNLZgHLSzVvn+wMq9qbKKwy7TiIaKTW56pzW6Oa+N1OKEQdvvl2RyOE4DEOZurd1cHNeab27tyjOPfhFlucXP04ovF97B6jTOzdJwFLaNAff7N6c8incH1VpiSR67q2VgjzUU7JgbMTiQtFKmgAsCAuczlflmVZn7iGBFc1awB/p4tqUS3LDb8OPwBrSrZIO/KHZwAAAABJRU5ErkJggg=="
                                    alt="Instagram" class="social-icon"></a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 WorkHorse. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Add this JavaScript at the end of the body tag -->
    <script>
        // Select all "Read More" buttons
        const readMoreButtons = document.querySelectorAll('.read-more');

        // Add event listener for each button
        readMoreButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default link behavior

                // Find the extra content and toggle its visibility
                const extraContent = button.previousElementSibling;
                if (extraContent.style.display === 'none') {
                    extraContent.style.display = 'block';
                    button.textContent = 'Read Less'; // Change button text to 'Read Less'
                } else {
                    extraContent.style.display = 'none';
                    button.textContent = 'Read More'; // Change button text to 'Read More'
                }
            });
        });


    </script>
    <script>
        // Get references to the hamburger button and the navigation links
const hamburger = document.getElementById('hamburger');
const navLinks = document.querySelector('.nav-links');

// Add an event listener to the hamburger to toggle the 'active' class
hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

    </script>



</body>





</html>