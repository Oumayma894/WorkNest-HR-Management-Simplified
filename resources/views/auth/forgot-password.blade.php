<!DOCTYPE html>
<html>
<head>
    <title>Set Your Password</title>
    <style>
    :root {
        --primary: #8635FD;
        --primary-light: #a274e6;
        --background: #f7f8fd;
        --white: #ffffff;
        --text-dark: #0e0d16;
        --text-light: #767268;
        --error: #EF4444;
        --border: #DDD6FE;
        --shadow: rgba(134, 53, 253, 0.15);
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: var(--background);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        padding: 20px;
    }

    .auth-card {
        background-color: var(--white);
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px var(--shadow);
        width: 100%;
        max-width: 400px;
        border-top: 4px solid var(--primary);
    }

    .auth-title {
        text-align: center;
        margin-bottom: 1.75rem;
        color: var(--text-dark);
        font-size: 1.5rem;
        font-weight: 600;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(134, 53, 253, 0.1);
    }

    .submit-btn {
        padding: 0.875rem;
        background-color: var(--primary);
        border: none;
        border-radius: 8px;
        color: var(--white);
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .submit-btn:hover {
        background-color: var(--primary-light);
        transform: translateY(-1px);
    }

    .status-message {
        color: var(--primary);
        text-align: center;
        margin-bottom: 1rem;
        padding: 0.75rem;
        background-color: rgba(134, 53, 253, 0.1);
        border-radius: 8px;
    }

    .error-message {
        color: var(--error);
        font-size: 0.875rem;
        margin-top: -0.75rem;
        margin-bottom: -0.5rem;
    }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2 class="auth-title">Set Your Password</h2>

        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf
            <input type="email" name="email" class="form-input" placeholder="Your Email" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <button type="submit" class="submit-btn">Send Password Setup Link</button>
        </form>
    </div>
</body>
</html>