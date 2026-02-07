<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Admin Login</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

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
            --purple-light: #F3E8FF;           /* Very light purple */
            --purple-soft: #DDD6FE;            /* Soft purple */
            --purple-medium: #C4B5FD;          /* Medium purple */
            --purple-deep: #6D28D9;            /* Deep purple */
            
            /* Shadow colors using purple tones */
            --shadow-light: rgba(134, 53, 253, 0.08);
            --shadow-medium: rgba(134, 53, 253, 0.15);
            --shadow-hover: rgba(134, 53, 253, 0.25);

            /* Status colors */
            --error-color: #ef4444;
            --success-color: #10b981;
      }

      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Poppins", sans-serif;
        background-color: var(--extra-light);
      }

      .container {
        height: 100vh;
        position: relative;
        background-color: var(--white);
        overflow: hidden;
        box-shadow: 0 15px 30px var(--shadow-light);
      }

      .form__container {
        position: absolute;
        width: 60%;
        height: 100%;
        padding: 2rem;
        transition: 0.6s ease-in-out;
        background-color: var(--white);
      }

      .signup__container {
        opacity: 0;
        z-index: 1;
      }

      .signin__container {
        z-index: 2;
      }

      form {
        height: 100%;
        max-width: 400px;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      form h1 {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
      }

      .socials {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 2rem 0;
      }

      .socials a {
        padding: 5px 12px;
        text-decoration: none;
        font-size: 1.5rem;
        color: var(--text-dark);
        border: 1px solid var(--blue-muted);
        border-radius: 100%;
        transition: all 0.3s ease;
      }

      .socials a:hover {
        background-color: var(--purple-light);
        color: var(--primary-color);
        border-color: var(--purple-medium);
      }

      form span {
        color: var(--text-light);
        font-size: 0.9rem;
        margin-bottom: 1rem;
      }

      .form__group {
        position: relative;
        margin: 0.5rem 0;
        width: 100%;
      }

      input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: none;
        outline: none;
        font-size: 1rem;
        background-color: var(--extra-light);
        border-bottom: 2px solid var(--purple-medium);
        border-radius: 4px;
        transition: all 0.3s ease;
      }

      input:focus {
        background-color: var(--purple-light);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--shadow-light);
      }

      .forgot__password {
        text-decoration: none;
        font-size: 0.9rem;
        color: var(--text-light);
        border-bottom: 1px solid var(--text-light);
        transition: all 0.3s ease;
      }

      .forgot__password:hover {
        color: var(--primary-color);
        border-color: var(--primary-color);
      }

      .form__container button {
        padding: 0.75rem 4rem;
        margin-top: 2rem;
        border: none;
        outline: none;
        font-size: 1rem;
        font-weight: 500;
        color: var(--white);
        border-radius: 2rem;
        background-color: var(--primary-color);
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px var(--shadow-medium);
      }

      .form__container button:hover {
        background-color: var(--purple-deep);
        box-shadow: 0 6px 20px var(--shadow-hover);
        transform: translateY(-2px);
      }

      .overlay__container {
        position: absolute;
        top: 0;
        left: 60%;
        height: 100%;
        width: 40%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 10;
      }

      .overlay__wrapper {
        background: linear-gradient(135deg, var(--primary-color), var(--purple-deep));
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        position: relative;
        color: var(--white);
        left: -150%;
        height: 100%;
        width: 250%;
        transition: transform 0.6s ease-in-out;
        overflow: hidden;
      }

      /* Decorative elements for the overlay */
      .overlay__wrapper::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        opacity: 0.3;
        animation: rotate 30s linear infinite;
      }

      .overlay__wrapper::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.2;
      }

      @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      .overlay__panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 4rem;
        text-align: center;
        height: 100%;
        width: 40%;
        transition: transform 0.6s ease-in-out;
        z-index: 2;
      }

      /* Decorative circles */
      .decorative-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 1;
      }

      .circle-1 {
        width: 200px;
        height: 200px;
        top: -50px;
        right: -50px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
      }

      .circle-2 {
        width: 300px;
        height: 300px;
        bottom: -100px;
        left: -100px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
      }

      .circle-3 {
        width: 150px;
        height: 150px;
        bottom: 20%;
        right: 10%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
      }

      .overlay__panel__left {
        right: 60%;
        transform: translateX(-12%);
      }

      .overlay__panel__right {
        right: 0;
        transform: translateX(0);
      }

      .overlay__panel h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
      }

      .overlay__panel h1::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--white);
        border-radius: 3px;
      }

      .overlay__panel p {
        max-width: 350px;
        margin: 1rem auto;
        line-height: 2rem;
        color: var(--purple-light);
        position: relative;
      }

      .overlay__panel button {
        padding: 0.75rem 4rem;
        margin-top: 2rem;
        border: none;
        outline: none;
        font-size: 1rem;
        font-weight: 500;
        color: var(--white);
        border-radius: 2rem;
        background-color: transparent;
        border: 2px solid var(--white);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      .overlay__panel button::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
      }

      .overlay__panel button:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }

      .overlay__panel button:hover::before {
        left: 100%;
      }

      .right__panel__active .overlay__container {
        transform: translateX(-150%);
      }

      .right__panel__active .overlay__wrapper {
        transform: translateX(50%);
      }

      .right__panel__active .overlay__panel__left {
        transform: translateX(25%);
      }

      .right__panel__active .overlay__panel__right {
        transform: translateX(35%);
      }

      .right__panel__active .signin__container {
        transform: translateX(20%);
        opacity: 0;
      }

      .right__panel__active .signup__container {
        transform: translateX(65%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
      }

      @keyframes show {
        0%,
        50% {
          opacity: 0;
          z-index: 1;
        }
        51%,
        100% {
          opacity: 1;
          z-index: 5;
        }
      }

      .alert {
        color: var(--error-color);
        background-color: rgba(239, 68, 68, 0.1);
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        text-align: center;
        width: 100%;
        border: 1px solid rgba(239, 68, 68, 0.2);
      }

      .alert-success {
        color: var(--success-color);
        background-color: rgba(16, 185, 129, 0.1);
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        text-align: center;
        width: 100%;
        border: 1px solid rgba(16, 185, 129, 0.2);
      }

      .err {
        margin-bottom: 1.5rem;
        width: 100%;
      }

      .form__group .error {
        color: var(--error-color);
        font-size: 0.8rem;
        margin-top: 0.25rem;
      }

      @media (max-width: 768px) {
        .form__container {
          width: 100%;
        }
        
        .overlay__container {
          display: none;
        }
        
        .right__panel__active .signin__container,
        .right__panel__active .signup__container {
          transform: translateX(0);
        }
      }
    </style>
  </head>
  <body>
    <div class="container" id="container">
      <div class="form__container signup__container">
        <form action="{{ route('processRegister') }}" method="POST">
          @csrf
          <h1>Create Account</h1>
        

          @if($errors->any())
            <div class="err">
              @foreach ($errors->all() as $error)
                <div class="alert">{{ $error }}</div>
              @endforeach
            </div>
          @endif

          @if(session()->has('error'))
            <div class="alert">{{ session('error') }}</div>
          @endif

          @if(session()->has('success'))
            <div class="alert-success">{{ session('success') }}</div>
          @endif

          <div class="form__group">
            <input type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required />
            @error('name')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
          <div class="form__group">
            <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
            @error('email')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
          <div class="form__group">
            <input type="password" id="password" name="password" placeholder="Password" required />
            @error('password')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
          <div class="form__group">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required />
          </div>
          <button type="submit">SIGN UP</button>
        </form>
      </div>

      <div class="form__container signin__container">
        <form action="{{ route('admin.authenticate') }}" method="POST">
          @csrf
          <h1>Sign In</h1>
          

          @if($errors->any())
            <div class="err">
              @foreach ($errors->all() as $error)
                <div class="alert">{{ $error }}</div>
              @endforeach
            </div>
          @endif

          @if(session()->has('error'))
            <div class="alert">{{ session('error') }}</div>
          @endif

          @if(session()->has('success'))
            <div class="alert-success">{{ session('success') }}</div>
          @endif

          <div class="form__group">
            <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
            @error('email')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
          <div class="form__group">
            <input type="password" id="password" name="password" placeholder="Password" required />
            @error('password')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
          <button type="submit">SIGN IN</button>
        </form>
      </div>

      <div class="overlay__container">
        <div class="overlay__wrapper">
          <!-- Decorative circles -->
          <div class="decorative-circle circle-1"></div>
          <div class="decorative-circle circle-2"></div>
          <div class="decorative-circle circle-3"></div>
          
          <div class="overlay__panel overlay__panel__left">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <button class="ghost" id="signIn">SIGN IN</button>
          </div>
          <div class="overlay__panel overlay__panel__right">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start journey with us</p>
            <button class="ghost" id="signUp">SIGN UP</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      const container = document.getElementById("container");
      const signInBtn = document.getElementById("signIn");
      const signUpBtn = document.getElementById("signUp");

      signUpBtn.addEventListener("click", () => {
        container.classList.add("right__panel__active");
      });

      signInBtn.addEventListener("click", () => {
        container.classList.remove("right__panel__active");
      });

      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('show') === 'signup') {
        container.classList.add("right__panel__active");
      }
    </script>
  </body>
</html>