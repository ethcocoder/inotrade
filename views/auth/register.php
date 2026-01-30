<div class="register-bg min-vh-100 d-flex align-items-center position-relative py-5">
    <div class="container position-relative z-index-1">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 text-white mb-5 mb-lg-0 pe-lg-5">
                <div class="d-inline-flex align-items-center px-3 py-1 rounded-pill border border-light border-opacity-25 bg-white bg-opacity-10 mb-4 backdrop-blur-sm">
                    <span class="badge bg-success me-2 rounded-pill">Join Us</span>
                    <span class="small fw-medium tracking-wide">Start Your Journey Today</span>
                </div>
                <h1 class="display-3 fw-extrabold mb-4 tracking-tight">Create<br>Account</h1>
                <p class="lead text-gray-200 mb-5 opacity-90 fs-5 fw-light">
                    Join a community of forward-thinking innovators and investors. Unlock resources, connect with peers, and transform ideas into reality.
                </p>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white bg-opacity-10 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-rocket-takeoff fs-5 text-white"></i>
                        </div>
                        <span class="text-white opacity-90">Showcase your innovations globally</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white bg-opacity-10 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-shield-check fs-5 text-white"></i>
                        </div>
                        <span class="text-white opacity-90">Secure and verified environment</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white bg-opacity-10 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-people fs-5 text-white"></i>
                        </div>
                        <span class="text-white opacity-90">Network with industry leaders</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7 col-xl-6">
                <div class="card register-card border-0 p-4 p-md-5">
                    <form method="post" action="/register">
                        <?= $csrf ?? '' ?>
                        <div class="text-center mb-4">
                            <h3 class="fw-bold mb-1">Get Started</h3>
                            <p class="text-white-50 small">Fill in the details to create your account</p>
                        </div>
                        
                        <?php if (isset($errors)): ?>
                            <div class="alert alert-danger bg-danger bg-opacity-10 border-danger border-opacity-25 text-white mb-4 rounded-3 small">
                                <ul class="mb-0 ps-3">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label text-white-50 small text-uppercase tracking-wider">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($data['name'] ?? '') ?>" required placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label text-white-50 small text-uppercase tracking-wider">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>" required placeholder="name@example.com">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label text-white-50 small text-uppercase tracking-wider">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                                    <button class="btn btn-light bg-white bg-opacity-90 border-start-0" type="button" onclick="togglePassword('password', this)">
                                        <i class="bi bi-eye text-muted"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirm" class="form-label text-white-50 small text-uppercase tracking-wider">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" required placeholder="••••••••">
                                    <button class="btn btn-light bg-white bg-opacity-90 border-start-0" type="button" onclick="togglePassword('password_confirm', this)">
                                        <i class="bi bi-eye text-muted"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label text-white-50 small text-uppercase tracking-wider">I am a...</label>
                            <select name="role" id="role" class="form-select">
                                <option value="innovator" <?= (isset($data['role']) && $data['role'] === 'innovator') ? 'selected' : '' ?>>Innovator - I have ideas to share</option>
                                <option value="sponsor" <?= (isset($data['role']) && $data['role'] === 'sponsor') ? 'selected' : '' ?>>Sponsor - I want to support projects</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="organization" class="form-label text-white-50 small text-uppercase tracking-wider">Organization <span class="text-white-50 opacity-50">(Optional)</span></label>
                            <input type="text" name="organization" id="organization" class="form-control" value="<?= htmlspecialchars($data['organization'] ?? '') ?>" placeholder="Company or Institution Name">
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="form-label text-white-50 small text-uppercase tracking-wider">Bio <span class="text-white-50 opacity-50">(Optional)</span></label>
                            <textarea name="bio" id="bio" class="form-control" rows="2" placeholder="Tell us a little about yourself..."><?= htmlspecialchars($data['bio'] ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-lg mb-4">
                            Create Account
                        </button>
                        
                        <div class="text-center">
                            <span class="text-white-50 small">Already have an account?</span>
                            <a href="/login" class="text-white fw-bold text-decoration-none ms-1">Sign In</a>
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
