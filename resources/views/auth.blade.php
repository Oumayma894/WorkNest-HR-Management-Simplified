@extends('layouts.app')

@section('content')

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");

    :root {
      /* Brand Color Palette with Purple Shades */
      --primary-color: #8635FD;
      --secondry-color: #a274e6;
      --blue-light: #E9F0FF;
      --blue-dark: #070127;
      --blue-slate: #414753;
      --blue-muted: #C5C2DA;
      --blue-white: #FFFFFF;
      --text-dark: #0e0d16;
      --text-light: #767268;
      --extra-light: #f7f8fd;
      --white: #ffffff;
      --max-width: 1200px;
      
      /* Additional purple shades */
      --purple-light: #F3E8FF;
      --purple-soft: #DDD6FE;
      --purple-medium: #C4B5FD;
      --purple-deep: #6D28D9;
      
      /* Shadow colors */
      --shadow-light: rgba(134, 53, 253, 0.08);
      --shadow-medium: rgba(134, 53, 253, 0.15);
      --shadow-hover: rgba(134, 53, 253, 0.25);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background: linear-gradient(135deg, var(--white) 0%, var(--purple-light) 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: var(--text-dark);
      position: relative;
      overflow: hidden;
    }

    /* Background blobs */
    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(60px);
      opacity: 0.2;
      z-index: 0;
      animation: float 15s ease-in-out infinite;
    }

    .blob-1 {
      width: 400px;
      height: 400px;
      background: var(--primary-color);
      top: -100px;
      left: -100px;
      animation-delay: 0s;
    }

    .blob-2 {
      width: 300px;
      height: 300px;
      background: var(--secondry-color);
      bottom: -100px;
      right: -50px;
      animation-delay: 5s;
    }

    .blob-3 {
      width: 250px;
      height: 250px;
      background: var(--purple-medium);
      top: 50%;
      right: 10%;
      animation-delay: 10s;
    }

    @keyframes float {
      0%, 100% {
        transform: translate(0, 0);
      }
      50% {
        transform: translate(50px, 50px);
      }
    }

    .role-selection {
      text-align: center;
      max-width: 900px;
      padding: 2rem;
      position: relative;
      z-index: 1;
      margin-top: 60px
    }

    .role-selection h2 {
      font-size: clamp(2rem, 4vw, 3.5rem);
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary-color), var(--purple-deep));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
    }

    .subtitle {
      font-size: 1.1rem;
      color: var(--text-light);
      margin-bottom: 3rem;
    }

    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 2rem;
      justify-content: center;
      margin: 0 auto;
    }

    .card {
      background: var(--white);
      padding: 0;
      border-radius: 24px;
      box-shadow: 0 8px 32px var(--shadow-light),
                  0 2px 8px var(--shadow-medium);
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      text-decoration: none;
      color: var(--text-dark);
      border: 1px solid rgba(255, 255, 255, 0.2);
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-12px) scale(1.02);
      box-shadow: 0 20px 60px var(--shadow-hover),
                  0 8px 30px var(--shadow-medium);
      border-color: var(--primary-color);
    }

    .card-image {
      width: 100%;
      height: 220px;
      margin: 0;
      border-radius: 24px 24px 0 0;
      overflow: hidden;
      position: relative;
      transition: all 0.4s ease;
      background-color: var(--purple-light);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card-image img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
      transition: transform 0.4s ease;
    }

    .card:hover .card-image img {
      transform: scale(1.05);
    }

    .card-content {
      padding: 2rem;
      text-align: center;
    }

    .card h3 {
      font-size: 1.8rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--text-dark);
      transition: color 0.3s ease;
    }

    .card:hover h3 {
      color: var(--primary-color);
    }

    .card p {
      font-size: 1.1rem;
      color: var(--text-light);
      line-height: 1.6;
      transition: color 0.3s ease;
    }

    .card:hover p {
      color: var(--blue-slate);
    }

    /* Responsive design */
    @media (max-width: 768px) {
      .role-selection {
        padding: 1rem;
      }
      
      .card-container {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      
      .card-image {
        height: 180px;
      }
      
      .card-image img {
        max-width: 60%;
        max-height: 60%;
      }
    }

    @media (max-width: 480px) {
      .card-content {
        padding: 1.5rem;
      }
      
      .card h3 {
        font-size: 1.5rem;
      }
      
      .card p {
        font-size: 1rem;
      }
      
      .card-image img {
        max-width: 55%;
        max-height: 55%;
      }
    }
  </style>

  
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
    </div>
</nav>
  <!-- Background blobs -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>

  <div class="role-selection">
    <h2>Select Your Role</h2>
    <p class="subtitle">Choose how you'd like to access the platform</p>
    
    <div class="card-container">
      <a href="{{ route('admin.login') }}" class="card">
        <div class="card-image">
          <img src="images/Pitch-meeting-bro.png" alt="Manager Illustration" />
        </div>
        <div class="card-content">
          <h3>Manager</h3>
          <p>Access the admin dashboard and manage your team with comprehensive oversight tools and analytics.</p>
        </div>
      </a>
      
      <a href="{{ route('login') }}" class="card">
        <div class="card-image">
          <img src="images/Working-amico.png" />
        </div>
        <div class="card-content">
          <h3>Employee</h3>
          <p>Check tasks, schedules, and submit reports through your personalized workspace with team collaboration.</p>
        </div>
      </a>
    </div>
  </div>
 
  
@endsection