<div class="container-fluid register-bg">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-8 col-lg-6">
            <div class="card register-card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Create Account</h3>
                    <?php if (isset($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="/register">
                        <?= $csrf ?? '' ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($data['name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirm" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Register as</label>
                            <select name="role" id="role" class="form-select">
                                <option value="innovator" <?= (isset($data['role']) && $data['role'] === 'innovator') ? 'selected' : '' ?>>Innovator</option>
                                <option value="sponsor" <?= (isset($data['role']) && $data['role'] === 'sponsor') ? 'selected' : '' ?>>Sponsor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization (Optional)</label>
                            <input type="text" name="organization" id="organization" class="form-control" value="<?= htmlspecialchars($data['organization'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio (Optional)</label>
                            <textarea name="bio" id="bio" class="form-control" rows="3"><?= htmlspecialchars($data['bio'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
