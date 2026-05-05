<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>Admin Login — MindSnap</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      width: 100%;
      max-width: 400px;
      background: #fff;
      border-radius: 12px;
      padding: 2.5rem 2rem;
      box-shadow: 0 20px 60px rgba(0,0,0,.4);
    }

    .login-brand {
      font-size: 1.4rem;
      font-weight: 800;
      color: #1a1a2e;
      margin-bottom: .25rem;
    }

    .login-brand span { color: #e94560; }

    .login-sub {
      color: #888;
      font-size: .875rem;
      margin-bottom: 1.75rem;
    }

    .form-label {
      font-weight: 600;
      font-size: .85rem;
      color: #333;
    }

    .btn-login {
      background: #1a1a2e;
      color: #fff;
      font-weight: 700;
      padding: .7rem;
      border-radius: 8px;
      border: none;
      transition: background .2s;
    }

    .btn-login:hover { background: #e94560; color: #fff; }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="login-brand">Mind<span>Snap</span></div>
    <div class="login-sub">Admin — sign in to manage your content</div>

    @if($errors->any())
      <div class="alert alert-danger py-2 small mb-3">
        {{ $errors->first() }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-warning py-2 small mb-3">
        {{ session('error') }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input
          type="email"
          id="email"
          name="email"
          class="form-control @error('email') is-invalid @enderror"
          value="{{ old('email') }}"
          required
          autofocus
          autocomplete="email"
        >
      </div>

      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          class="form-control"
          required
          autocomplete="current-password"
        >
      </div>

      <button type="submit" class="btn btn-login w-100">Sign In</button>
    </form>
  </div>
</body>
</html>
