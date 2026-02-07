@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

 <!-- Curved Background -->
<div class="curved-background">
    <div class="curve-layer-1"></div>
    <div class="curve-layer-2"></div>
    <div class="curve-layer-3"></div>
    <div class="floating-elements">
        <div class="floating-dot dot-1"></div>
        <div class="floating-dot dot-2"></div>
        <div class="floating-dot dot-3"></div>
        <div class="floating-dot dot-4"></div>
    </div>
</div>


<!-- navbar -->
<nav>
    <div class="nav__header">
      <div class="nav__logo">
        <a href="#" class="logo__link">
            <!-- Inline SVG Logo -->
            <svg class="logo" viewBox="0 0 200 60" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <!-- Gradient for the nest/hexagon -->
                <linearGradient id="primaryGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#8635FD;stop-opacity:1" />
                  <stop offset="100%" style="stop-color:#a274e6;stop-opacity:1" />
                </linearGradient>
                
                <!-- Gradient for accent elements -->
                <linearGradient id="accentGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#a274e6;stop-opacity:0.8" />
                  <stop offset="100%" style="stop-color:#8635FD;stop-opacity:0.6" />
                </linearGradient>
              </defs>

              <!-- Main hexagonal nest structure -->
              <g transform="translate(8, 8)">
                <!-- Outer hexagon -->
                <polygon points="22,8 32,14 32,26 22,32 12,26 12,14" 
                         fill="url(#primaryGradient)" 
                         stroke="#8635FD" 
                         stroke-width="1.5"
                         opacity="0.9"/>
                
                <!-- Inner hexagonal cells -->
                <polygon points="18,12 24,15 24,21 18,24 12,21 12,15" 
                         fill="none" 
                         stroke="#FFFFFF" 
                         stroke-width="1.2"
                         opacity="0.8"/>
                
                <polygon points="30,12 36,15 36,21 30,24 24,21 24,15" 
                         fill="none" 
                         stroke="#FFFFFF" 
                         stroke-width="1.2"
                         opacity="0.8"/>
                
                <polygon points="24,20 30,23 30,29 24,32 18,29 18,23" 
                         fill="none" 
                         stroke="#FFFFFF" 
                         stroke-width="1.2"
                         opacity="0.6"/>
                
                <!-- Central connecting dot -->
                <circle cx="22" cy="20" r="2" fill="#FFFFFF" opacity="0.9"/>
                
                <!-- Small accent dots -->
                <circle cx="16" cy="16" r="1" fill="#FFFFFF" opacity="0.7"/>
                <circle cx="28" cy="16" r="1" fill="#FFFFFF" opacity="0.7"/>
                <circle cx="22" cy="28" r="1" fill="#FFFFFF" opacity="0.7"/>
              </g>

              <!-- Typography -->
              <g transform="translate(52, 0)">
                <!-- "Work" text -->
                <text x="0" y="25" 
                      font-family="Inter, Arial, sans-serif" 
                      font-size="22" 
                      font-weight="700" 
                      fill="#0e0d16"
                      letter-spacing="-0.5px">Work</text>
                
                <!-- "Nest" text with accent color -->
                <text x="58" y="25" 
                      font-family="Inter, Arial, sans-serif" 
                      font-size="22" 
                      font-weight="700" 
                      fill="#8635FD"
                      letter-spacing="-0.5px">Nest</text>
                
                <!-- Tagline -->
                <text x="0" y="40" 
                      font-family="Inter, Arial, sans-serif" 
                      font-size="9" 
                      font-weight="400" 
                      fill="#767268"
                      letter-spacing="0.5px"
                      opacity="0.8">HR MANAGEMENT SIMPLIFIED</text>
              </g>

              <!-- Subtle connecting element -->
              <line x1="48" y1="20" x2="52" y2="20" 
                    stroke="#a274e6" 
                    stroke-width="2" 
                    opacity="0.4"/>
            </svg>
        </a>   
      </div>
      <div class="nav__menu__btn" id="menu-btn">
        <i class="ri-menu-line"></i>
      </div>
    </div>
    <ul class="nav__links" id="nav-links">
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About Us</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <div class="nav__btns">
      <a href="{{ route('auth') }}" class="btn">Sign In</a>
    </div>
</nav>


<header class="section__container header__container" id="home" data-aos="fade-right">
  
    <div class="header__image" data-aos="fade-up" data-aos-delay="320">
      <img src="images/index.png" alt="header" />
    </div>
    <div class="header__content">
      <h1 data-aos="fade-up" data-aos-delay="100">Worknest : Where Work <span>Meets</span> Harmony</h1>  

      <p class="section__description" data-aos="fade-up" data-aos-delay="400">
      Worknest is a simple tool to track attendance and manage leave requests. 
      Employees can check in and out, request time off, and see their leave balance. 
      Managers can review and approve requests, view team attendance, 
      and keep everything organized in one place.
       Worknest makes it easy for teams to stay on top of their schedules.
      </p>
      <div class="header__btns">
        <button class="btn_header" data-aos="fade-up" data-aos-delay="400" ><span>Get Started</span></button>
        
      </div>
    </div>
    
</header>

<div class="line-with-dot">
  <div class="dot"></div>
</div>


<!-- Services Section -->
    <section class="services__container" id="services">
        <div class="services__header">
            <h2 class="section__header_services"  data-aos="fade-up" data-aos-delay="300">Our <span>Services</span></h2>
            <p class="section__description_services"  data-aos="fade-up" data-aos-delay="600">Comprehensive HR management solutions designed to streamline your workforce operations and enhance productivity</p>
        </div>
        
        <div class="services__grid" data-aos="fade-up">
            <!-- Service 1: Leave Management -->
            <div class="service__card" data-aos="fade-up" data-aos-delay="100">
                <div class="service__icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                    </svg>
                </div>
                <div class="service__content">
                    <h3 class="service__title">Leave Management</h3>
                    <p class="service__description">Submit and track leave requests with ease. Employees can apply for time off, while managers can approve or reject requests with detailed comments and workflow tracking.</p>
                    
                </div>
            </div>

            <!-- Service 2: Attendance Tracking -->
            <div class="service__card" data-aos="fade-up" data-aos-delay="100">
                <div class="service__icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="service__content">
                    <h3 class="service__title">Attendance Tracking</h3>
                    <p class="service__description">A comprehensive daily check-in and check-out system to record work hours, improve accountability, and generate detailed attendance reports.</p>
                    
                   
                </div>
            </div>

            <!-- Service 3: Role-Based Dashboards -->
            <div class="service__card" data-aos="fade-up" data-aos-delay="100">
                <div class="service__icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                    </svg>
                </div>
                <div class="service__content">
                    <h3 class="service__title">Role-Based Dashboards</h3>
                    <p class="service__description">Personalized dashboards tailored for employees and managers to access relevant data, analytics, and insights at a glance with customizable widgets.</p>
                    
                </div>
            </div>

            <!-- Service 4: Notifications & Alerts -->
            <div class="service__card" data-aos="fade-up" data-aos-delay="100">
                <div class="service__icon">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                    </svg>
                </div>
                <div class="service__content">
                    <h3 class="service__title">Notifications & Alerts</h3>
                    <p class="service__description">Stay informed with intelligent real-time notifications, status updates, and customizable alerts for requests, schedules, and important HR events.</p>
                    
                </div>
            </div>
        </div>
    </section>

    <div class="line-with-dot">
  <div class="dot"></div>
</div>

    <!-- About Us Section -->
<section class="about__container" id="about" data-aos="fade-up">
        <div class="form_deco-services2"></div>

    <div class="section__container">
        <div class="about__content">
            <div class="about__text" data-aos="fade-right" data-aos-delay="100">
                <h2 class="section__header">About <span>Us</span></h2>
                <div class="about__description">
                    <p>Welcome to <strong>WorkNest</strong> your all in one solution for managing employee attendance and leave requests with ease and efficiency.</p>
                    <p>WorkNest is designed to help teams stay organized and productive by streamlining daily check-ins, leave management, and real-time oversight. Employees can easily log their work hours, submit leave requests, and track their attendance history, while managers can review and respond to requests, monitor team activity, and gain clear insights through dashboards.</p>
                    <p>Our mission is to simplify workforce management by providing a platform that supports transparency, accountability, and a better work-life balance. Whether you're part of a small team or a growing organization, WorkNest helps you stay on top of your attendance and leave processes — all in one place.</p>
                </div>
            </div>
            <div class="about__image" data-aos="zoom-in" data-aos-delay="200">
                <img src="images/About-us-page-amico.png" />
            </div>
        </div>
    </div>
</section>


   <div class="line-with-dot">
  <div class="dot"></div>
</div>
  
<section class="features__container" id="features">
    <div class="section__container_features">
        <h2 class="section__header_features">OUR <span>FEATURES</span></h2>
        <div class="features__grid">
            <!-- Feature 1 -->
            <div class="feature__item" data-aos="flip-left" data-aos-delay="100">
                <div class="feature__icon">
                    <i class="ri-time-line"></i>
                </div>
                <div class="feature__content">
                    <h4>Simple Check-In/Out</h4>
                    <p>Record work hours with a click.</p>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="feature__item" data-aos="flip-left" data-aos-delay="200">
                <div class="feature__icon">
                    <i class="ri-calendar-event-line"></i>
                </div>
                <div class="feature__content">
                    <h4>Easy Leave Requests</h4>
                    <p>Submit and track requests easily.</p>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="feature__item" data-aos="flip-left" data-aos-delay="300">
                <div class="feature__icon">
                    <i class="ri-dashboard-line"></i>
                </div>
                <div class="feature__content">
                    <h4>Real-Time Insights</h4>
                    <p>Manager dashboards keep things on track.</p>
                </div>
            </div>
            
            <!-- Feature 4 - Additional to match reference -->
            <div class="feature__item" data-aos="flip-left" data-aos-delay="400">
                <div class="feature__icon">
                    <i class="ri-notification-line"></i>
                </div>
                <div class="feature__content">
                    <h4>Smart Notifications</h4>
                    <p>Get alerts for approvals and reminders.</p>
                </div>
            </div>
            
            <!-- Feature 5 - Additional to match reference -->
            <div class="feature__item" data-aos="flip-left" data-aos-delay="500">
                <div class="feature__icon">
                    <i class="ri-shield-check-line"></i>
                </div>
                <div class="feature__content">
                    <h4>Data Security</h4>
                    <p>Enterprise-grade protection for your data.</p>
                </div>
            </div>
            
            <!-- Feature 6 - Additional to match reference -->
            <div class="feature__item" data-aos="flip-left" data-aos-delay="600">
                <div class="feature__icon">
                    <i class="ri-plug-line"></i>
                </div>
                <div class="feature__content">
                    <h4>Integrations</h4>
                    <p>Connect with your favorite HR tools.</p>
                </div>
            </div>
        </div>
    </div>
</section>  

<div class="line-with-dot">
  <div class="dot"></div>
</div>

<section class="cta__container" data-aos="fade-up">
    <div class="cta__content-wrapper">
        <div class="cta__text" data-aos="fade-right" data-aos-delay="100">
            <h2>Ready to Streamline Your Team's Workflow?</h2>
            <p>Join WorkNest today and experience stress-free HR management.</p>
            <a href="{{ route('auth') }}" class="btn btn-primary">Get Started</a>
        </div>
        <div class="cta__image" data-aos="zoom-in" data-aos-delay="200">
            <img src="images/Pitch-meeting-bro.png" alt="Workflow illustration">
        </div>
    </div>
</section>


<footer class="footer" data-aos="fade-up">
  <div class="footer__container">
    <!-- Main Footer Content -->
    <div class="footer__main">
      <div class="footer__brand" data-aos="fade-right" data-aos-delay="100">
        <a href="#" class="footer__logo">WorkNest</a>
        <p class="footer__tagline">Streamlining your HR workflow with care</p>
        <div class="footer__social">
  <a href="#" aria-label="Twitter"><i class="ri-twitter-fill"></i></a>
  <a href="#" aria-label="LinkedIn"><i class="ri-linkedin-box-fill"></i></a>
  <a href="#" aria-label="Facebook"><i class="ri-facebook-box-fill"></i></a>
</div>

      </div>

      <div class="footer__links" data-aos="fade-left" data-aos-delay="200">
        <div class="footer__column">
          <h3 class="footer__heading">Product</h3>
          <ul>
            <li><a href="#">Features</a></li>
            <li><a href="#">Pricing</a></li>
            <li><a href="#">Integrations</a></li>
            <li><a href="#">Updates</a></li>
          </ul>
        </div>

        <div class="footer__column">
          <h3 class="footer__heading">Company</h3>
          <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>

        <div class="footer__column">
          <h3 class="footer__heading">Resources</h3>
          <ul>
            <li><a href="#">Help Center</a></li>
            <li><a href="#">Tutorials</a></li>
            <li><a href="#">Community</a></li>
            <li><a href="#">Webinars</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer__bottom">
      <div class="footer__legal">
        <span>&copy; 2025 WorkNest. All rights reserved.</span>
        <div class="footer__legal-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="#">Cookies</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- AOS JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // Animation duration in milliseconds
    once: true, // Ensures the animation runs only once
  });
</script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection