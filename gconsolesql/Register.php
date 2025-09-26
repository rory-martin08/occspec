<?php
require_once "assets/topbar.php";
require_once "assets/nav.php";
echo '
<div class="register-container">
    <form class="register-form" action="process_register.php" method="post">
        <h2>Register</h2>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Register</button>
    </form>
</div>
';

