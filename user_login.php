<?php
require_once 'config.php';
session_start();

if (isset($_SESSION['user_data'])) {
    header('Location: user_profile.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Please enter both email and password.';
    } else {
        require_once 'classes/Login.php';
        $login = new Login();
        $response = json_decode($login->login_user_custom($email, $password), true);
        if ($response['status'] === 'success') {
            $_SESSION['user_data'] = $response['user_data'];
            header('Location: user_profile.php');
            exit;
        } else {
            $error = 'Invalid email or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Login</title>
    <link rel="stylesheet" href="libs/style.css" />
</head>
<body>
    <div class="login-container">
        <h2>User Login</h2>
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="user_login.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required autocomplete="off" />
            <br />
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required autocomplete="off" />
            <br />
            <button type="submit">Login</button>
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
