<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <div class="col-sm-12 col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Sembark</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-2">Login</h3>
                    <form action="{{ route('login') }}" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail Address" value="{{ old('email') }}" required>
                            <label for="email">E-Mail Address</label>
                            @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember_me" id="remember_me" value="1" class="form-check-input" @checked(old('remember_me'))>
                            <label for="remember_me" class="form-check-label">Remember Me</label>
                        </div>
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
