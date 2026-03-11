<!doctype html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nailed It! – Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <main class="page">
        <section class="card">
            <div class="brand-center">
                <a href="{{ route('dashboard.index') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Nailed-It logo" class="brand-logo" />
                </a>
            </div>
            <p class="brand-text">DIY and hardware store since 1992</p>

            <!-- login form -->
            <div class="login-box">
                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <div class="form-row">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            autocomplete="username"
                            aria-describedby="email-error">

                        @error('email')
                        <div>
                            
                        </div>
                        <div id="email-error" role="alert" class="error-message">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="password">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            aria-describedby="password-error">

                        @error('password')
                        <div>

                        </div>
                        <div id="password-error" role="alert" class="error-message">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="actions">
                        <button type="submit">login</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>