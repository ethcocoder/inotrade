<div class="login-bg min-vh-100 d-flex align-items-center position-relative">
    <div class="container position-relative z-index-1">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-white mb-5 mb-lg-0 pe-lg-5">
                <h1 class="display-3 fw-extrabold mb-4 tracking-tight">Welcome<br>Back</h1>
                <p class="lead text-gray-200 mb-5 opacity-90 fs-5 fw-light">
                    Continue your innovation journey. Access your dashboard to manage projects, connect with partners, and track progress.
                </p>
                <div class="d-flex gap-4">
                    <a href="#" class="text-white opacity-75 hover-opacity-100 transition-all"><i class="bi bi-facebook fs-3"></i></a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100 transition-all"><i class="bi bi-twitter fs-3"></i></a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100 transition-all"><i class="bi bi-google fs-3"></i></a>
                    <a href="#" class="text-white opacity-75 hover-opacity-100 transition-all"><i class="bi bi-github fs-3"></i></a>
                </div>
            </div>
            
            <div class="col-lg-5 col-xl-4">
                <div class="card login-card border-0 p-4 p-md-5">
                    <form method="post" action="/login">
                        <?= $csrf ?? '' ?>
                        <div class="text-center mb-4">
                            <h3 class="fw-bold mb-1">Sign In</h3>
                            <p class="text-white-50 small">Enter your credentials to access your account</p>
                        </div>
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger py-2 mb-4 rounded-3">
                                <?php if (isset($errors['general'])): ?>
                                    <small><?= htmlspecialchars($errors['general']) ?></small>
                                <?php else: ?>
                                    <small>Please check your input and try again.</small>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label text-white-50 small text-uppercase tracking-wider">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white bg-opacity-10 border-end-0 text-white-50"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" placeholder="name@example.com" required autofocus>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label text-white-50 small text-uppercase tracking-wider">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white bg-opacity-10 border-end-0 text-white-50"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control border-start-0 border-end-0 ps-0" id="password" name="password" placeholder="••••••••" required>
                                <button class="btn btn-light bg-white bg-opacity-10 border-start-0 text-white-50" type="button" style="border-color: rgba(255,255,255,0.2);" onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input bg-transparent border-white-50" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label text-white-50 small" for="remember">Remember me</label>
                            </div>
                            <a href="/password-reset" class="text-primary text-decoration-none small fw-bold">Forgot password?</a>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-lg mb-4">
                            Sign In
                        </button>
                        
                        <div class="text-center">
                            <span class="text-white-50 small">Don't have an account?</span>
                            <a href="/register" class="text-white fw-bold text-decoration-none ms-1">Create Account</a>
                        </div>
                        
                        <div class="mt-4 pt-4 border-top border-white border-opacity-10 text-center">
                            <small class="text-white-50" style="font-size: 0.75rem;">
                                By signing in, you agree to our <a href="#" class="text-white-50 text-decoration-underline">Terms</a> & <a href="#" class="text-white-50 text-decoration-underline">Privacy Policy</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>