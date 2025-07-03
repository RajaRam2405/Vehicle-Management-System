<?php
require_once 'config.php';

$vehicleId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Simulated vehicle data (same as in buy_vehicle.php)
$vehicles = [
    1 => ['make'=>'Toyota', 'model'=>'Camry', 'year'=>2022, 'price'=>2400000, 'type'=>'new', 'image'=>'uploads/toyota_camry.jpg', 'description'=>'A reliable sedan.', 'details'=>'The Toyota Camry is a comfortable and fuel-efficient sedan with advanced safety features.'],
    2 => ['make'=>'Honda', 'model'=>'Civic', 'year'=>2021, 'price'=>2200000, 'type'=>'new', 'image'=>'uploads/honda_civic.jpg', 'description'=>'A sporty compact car.', 'details'=>'The Honda Civic offers sporty handling and a modern interior with advanced technology.'],
    3 => ['make'=>'Ford', 'model'=>'Mustang', 'year'=>2020, 'price'=>3500000, 'type'=>'used', 'image'=>'uploads/ford_mustang.jpg', 'description'=>'A classic muscle car.', 'details'=>'The Ford Mustang is an iconic muscle car with powerful performance and aggressive styling.'],
    4 => ['make'=>'Tesla', 'model'=>'Model 3', 'year'=>2023, 'price'=>4500000, 'type'=>'new', 'image'=>'uploads/Fortuner.jpg', 'description'=>'A Luxury of Freedom.', 'details'=>'Toyota Fortuner is a  sedan with impressive range and cutting-edge technology.'],
    5 => ['make'=>'Hyundai', 'model'=>'Creta', 'year'=>2022, 'price'=>1800000, 'type'=>'new', 'image'=>'uploads/hyundai_creta.jpg', 'description'=>'A popular SUV.', 'details'=>'The Hyundai Creta is a compact SUV offering comfort, style, and advanced features.'],
];

$vehicle = isset($vehicles[$vehicleId]) ? $vehicles[$vehicleId] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vehicle Details - <?php echo $_settings->info('name') ?></title>
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php include 'inc/topBarNav.php'; ?>

<div class="container mt-5">
    <?php if($vehicle): ?>
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($vehicle['image']); ?>" alt="<?php echo htmlspecialchars($vehicle['make'] . ' ' . $vehicle['model']); ?>" class="img-fluid rounded" />
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($vehicle['make'] . ' ' . $vehicle['model']); ?></h2>
            <p><strong>Year:</strong> <?php echo htmlspecialchars($vehicle['year']); ?></p>
            <p><strong>Price:</strong> ₹<?php echo number_format($vehicle['price']); ?></p>
            <p><strong>Type:</strong> <?php echo ucfirst(htmlspecialchars($vehicle['type'])); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($vehicle['description']); ?></p>
            <p><strong>Details:</strong> <?php echo htmlspecialchars($vehicle['details']); ?></p>
            <a href="buy_vehicle.php" class="btn btn-secondary mt-3">Back to Search</a>
        </div>
    </div>
    <?php else: ?>
    <div class="alert alert-warning">Vehicle not found.</div>
    <a href="buy_vehicle.php" class="btn btn-secondary">Back to Search</a>
    <?php endif; ?>
</div>

</body>
</html>
