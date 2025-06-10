<?php
require_once 'config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; // 'user' or 'staff'

    if (empty($username) || empty($password)) {
        $error = 'Please enter username and password.';
    } else {
        // Query user from database based on role
        $table = ($role === 'staff') ? 'staff' : 'users';
        $stmt = $conn->prepare("SELECT id, username, password FROM $table WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $row = $result->fetch_assoc()) {
            if (md5($password) === $row['password']) {
                // Successful login
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $role;
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        } else {
            $error = 'Invalid username or password.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - <?php echo $_settings->info('name') ?></title>
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php include 'inc/topBarNav.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Login</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" action="login.php" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="username" class="form-label">Username or Email</label>
            <input type="text" class="form-control" id="username" name="username" required autofocus />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Login as</label>
            <select name="role" class="form-select">
                <option value="user">User</option>
                <option value="staff">Staff</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <div class="mt-3 text-center">
            <a href="signup.php">Sign Up</a> | <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </form>
</div>
</body>
</html>
