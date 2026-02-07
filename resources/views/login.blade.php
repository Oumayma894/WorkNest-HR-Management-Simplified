<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agent Login</title>
  <style>
    :root {
      /* Your Brand Color Palette with Purple Shades */
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
      
      /* Additional purple shades for enhanced design */
      --purple-light: #F3E8FF;
      --purple-soft: #DDD6FE;
      --purple-medium: #C4B5FD;
      --purple-deep: #6D28D9;
      
      /* Shadow colors using purple tones */
      --shadow-light: rgba(134, 53, 253, 0.08);
      --shadow-medium: rgba(134, 53, 253, 0.15);
      --shadow-hover: rgba(134, 53, 253, 0.25);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, var(--extra-light) 0%, var(--purple-light) 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow-x: hidden;
    }

    
    /* Decorative Background Elements */
    .bg-decoration {
      position: absolute;
      pointer-events: none;
      z-index: 0;
    }

    .decoration-1 {
      top: 10%;
      left: 8%;
      width: 120px;
      height: 80px;
      background: var(--purple-soft);
      border-radius: 16px;
      opacity: 0.6;
      transform: rotate(-15deg);
    }

    .decoration-2 {
      top: 20%;
      right: 12%;
      width: 80px;
      height: 80px;
      background: var(--primary-color);
      border-radius: 50%;
      opacity: 0.3;
    }

    .decoration-3 {
      bottom: 15%;
      left: 15%;
      width: 100px;
      height: 100px;
      background: var(--purple-medium);
      border-radius: 20px;
      opacity: 0.4;
      transform: rotate(25deg);
    }

    .decoration-4 {
      bottom: 25%;
      right: 8%;
      width: 60px;
      height: 120px;
      background: var(--secondry-color);
      border-radius: 12px;
      opacity: 0.5;
      transform: rotate(-10deg);
    }

    /* Floating dots pattern */
    .dots-pattern {
      position: absolute;
      width: 150px;
      height: 150px;
      background-image: radial-gradient(circle, var(--primary-color) 2px, transparent 2px);
      background-size: 20px 20px;
      opacity: 0.3;
    }

    .dots-1 {
      top: 5%;
      right: 25%;
    }

    .dots-2 {
      bottom: 10%;
      left: 5%;
    }

    /* Wavy lines */
    .wave-line {
      position: absolute;
      width: 200px;
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
      border-radius: 3px;
      opacity: 0.4;
    }

    .wave-1 {
      top: 30%;
      left: 5%;
      transform: rotate(45deg);
    }

    .wave-2 {
      bottom: 35%;
      right: 10%;
      transform: rotate(-30deg);
    }

    /* Main Login Container */
    .login-container {
      background: var(--white);
      border-radius: 24px;
      box-shadow: 0 20px 60px var(--shadow-medium);
      width: 100%;
      max-width: 1000px;
      display: flex;
      overflow: hidden;
      position: relative;
      z-index: 5;
      backdrop-filter: blur(10px);
      min-height: 600px;
    }

    .login-content {
      flex: 1;
      padding: 3rem 2.5rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .image-section {
      flex: 1;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .image-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .image-placeholder img {
      width: 100%;
      height: auto;
      object-fit: contain;
      z-index: 1;
    }

    .image-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, rgba(134, 53, 253, 0.3), rgba(109, 40, 217, 0.3));
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 0.5rem;
    }

    .login-subtitle {
      color: var(--text-light);
      font-size: 1rem;
      line-height: 1.5;
    }

    /* Form Styles */
    .login-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .input-group {
      position: relative;
    }

    .input-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--text-dark);
      font-size: 0.9rem;
    }

    .input-group input {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 2px solid var(--blue-muted);
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: var(--white);
    }

    .input-group input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px var(--shadow-light);
    }

    .input-group input::placeholder {
      color: var(--blue-muted);
    }

    .forgot-password {
      text-align: right;
      margin-top: -0.5rem;
      margin-bottom: 0.5rem;
    }

    .forgot-password a {
      color: var(--text-light);
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease;
    }

    .forgot-password a:hover {
      color: var(--primary-color);
    }

    .signin-btn {
      width: 100%;
      padding: 1rem;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: var(--shadow-medium);
    }

    .signin-btn:hover {
      background: var(--purple-deep);
      box-shadow: var(--shadow-hover);
      transform: translateY(-2px);
    }

    .signin-btn:active {
      transform: translateY(0);
    }

    .signup-link {
      text-align: center;
      margin-top: 1.5rem;
      color: var(--text-light);
      font-size: 0.9rem;
    }

    .signup-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }

    /* Error Styles */
    .errors {
      margin-bottom: 1rem;
    }

    .err .alert {
      background: #fee2e2;
      color: #dc2626;
      padding: 0.75rem;
      border-radius: 8px;
      margin-bottom: 0.5rem;
      font-size: 0.9rem;
      border: 1px solid #fecaca;
    }

    .alert-success {
      background: #d1fae5;
      color: #059669;
      padding: 0.75rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      font-size: 0.9rem;
      border: 1px solid #a7f3d0;
    }

    .error-message {
      color: #dc2626;
      font-size: 0.85rem;
      margin-top: 0.25rem;
      display: block;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        max-width: 440px;
        margin: 1rem;
      }

      .login-content {
        padding: 2rem 1.5rem;
      }

      .image-section {
        min-height: 200px;
        order: -1;
      }
      
      .image-placeholder img {
        width: 60%;
      }
    }
  </style>
</head>
<body>
   <!-- Background Decorations -->
  <div class="bg-decoration decoration-1"></div>
  <div class="bg-decoration decoration-2"></div>
  <div class="bg-decoration decoration-3"></div>
  <div class="bg-decoration decoration-4"></div>
  <div class="bg-decoration dots-pattern dots-1"></div>
  <div class="bg-decoration dots-pattern dots-2"></div>
  <div class="bg-decoration wave-line wave-1"></div>
  <div class="bg-decoration wave-line wave-2"></div>
  <div class="bg-decoration character-illustration"></div>
  <!-- Main Login Container -->
  <div class="login-container">
    <!-- Login Form Section -->
    <div class="login-content">
      <div class="errors">
        @if($errors->any())
         <div class="err">
            @foreach ($errors->all() as $error)
                <div class="alert">
                    {{ $error }}
                </div>
            @endforeach
         </div>
        @endif

        @if(session()->has('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif
      </div>

      <div class="login-header">
        <h1 class="login-title">Login</h1>
        <p class="login-subtitle">Hey, Enter your details to get sign in<br>to your account</p>
      </div>

      <form action="{{ route('authenticate') }}" method="POST" class="login-form">
        @csrf
        <div class="input-group">
          <label for="email">Enter Email</label>
          <input type="text" id="email" name="email" placeholder="name@example.com" required />
          @error('email')
          <p class="error-message">{{ $message }}</p>
          @enderror
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required />
          @error('password')
          <p class="error-message">{{ $message }}</p>
          @enderror
        </div>

        <div class="forgot-password">
          <a href="{{ route('password.request') }}">Having trouble in sign in?</a>
        </div>

        <button type="submit" class="signin-btn">Sign in</button>

        <div class="signup-link">
          Don't have a password? <a href="{{ route('password.request') }}">Reset Now</a>
        </div>
      </form>
    </div>

    <!-- Image Section -->
    <div class="image-section">
      <div class="image-placeholder">
        <img src="images/Login-pana.png" alt="Login Illustration">
        <div class="image-overlay"></div>
      </div>
    </div>
  </div>
</body>
</html>