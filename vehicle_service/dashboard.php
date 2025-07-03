<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'] ?? 'User';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - <?php echo $_settings->info('name') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            padding-top: 70px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            margin-bottom: 20px;
        }
        @media (max-width: 576px) {
            .card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Vehicle Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="view_vehicles.php">View Vehicles</a></li>
                <li class="nav-item"><a class="nav-link" href="buy_vehicle.php">Buy Vehicle</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">My Profile</a></li>
            </ul>
            <span class="navbar-text me-3">
                Logged in as: <?php echo htmlspecialchars($username); ?>
            </span>
            <a href="logout.php" class="btn btn-outline-light">Logout</a>
        </div>
    </div>
</nav>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>
<style>
    .under-construction-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 60vh;
        text-align: center;
        color: #dc3545;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .under-construction-text {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
    #lottie-animation {
        width: 300px;
        height: 300px;
        margin-bottom: 20px;
    }
</style>
<div class="under-construction-container">
    <div id="lottie-animation"></div>
    <div class="under-construction-text">🚧 Under Construction 🚧</div>
    <div>Please check back later.</div>
</div>
<script>
    var animation = lottie.loadAnimation({
        container: document.getElementById('lottie-animation'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: 'uploads/Animation - 1746717053998.json'
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
