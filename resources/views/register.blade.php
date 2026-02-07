<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      display: flex;
      height: 100vh;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-form h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .input-group {
      margin-bottom: 1rem;
    }

    .input-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }

    .input-group input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    .btn {
      width: 100%;
      padding: 0.75rem;
      background-color: #4f46e5;
      color: #fff;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background-color: #3730a3;
    }

    .signup-link {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .signup-link a {
      color: #4f46e5;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <form action="{{ route('processRegister') }}" method="POST" class="login-form">
      @csrf
      <h2>Sign Up</h2>
      <div class="input-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Your Name" required />
        @error('name')
          <p class="">{{ $message }}</p>
        @enderror
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="name@example.com" required />
        @error('email')
          <p class="">{{ $message }}</p>
        @enderror
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required />
        @error('password')
          <p class="">{{ $message }}</p>
        @enderror
      </div>
      <div class="input-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password" required />
      </div>
      <button type="submit" class="btn">Create Account</button>
      <p class="signup-link">Already have an account? <a href="/signin">Sign in</a></p>
    </form>
  </div>
</body>
</html>
