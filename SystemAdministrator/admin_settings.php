                <!-- Simplified Settings Module -->
<div id="settings" class="module-container centered-module" style="display: none;">
    <div class="module-header">
        <h2 class="module-title">
            <i class="fas fa-sliders-h"></i>
            Admin Settings
        </h2>
    </div>

    <div class="module-body">
        <!-- Account Info -->
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" placeholder="e.g. Karl Carpena">
            </div>
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" placeholder="e.g. admin@excellens.com">
            </div>
        </div>

        <!-- Password Change -->
        <div class="form-grid" style="margin-top: 20px;">
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm new password">
            </div>
        </div>

        <!-- Preferences -->
        <div class="form-group" style="margin-top: 20px;">
            <label class="form-label">Theme</label>
            <select class="form-control form-select">
                <option>Light</option>
                <option>Dark</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div style="margin-top: 25px; display: flex; gap: 15px;">
            <button class="btn btn-success">
                <i class="fas fa-save"></i>
                Save Settings
            </button>
            <button class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </div>
    </div>
</div>
