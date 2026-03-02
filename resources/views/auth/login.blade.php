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
            <h1 class="brand-title">NAILED IT!</h1>
            <p class="brand-text">DIY and hardware store sins 1992</p>

            <div class="login-box">
                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <div class="form-row">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" required autocomplete="username">
                    </div>

                    <div class="form-row">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password">
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