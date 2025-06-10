<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buy Vehicle - <?php echo $_settings->info('name') ?></title>
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Hero Section */
        .hero {
            background: url('uploads/vehicle-hero.jpg') center center/cover no-repeat;
            height: 400px;
            position: relative;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        /* Filter Sidebar */
        .filter-sidebar {
            max-width: 300px;
        }
        /* Vehicle Cards */
        .vehicle-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .vehicle-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        /* Floating Search Bar */
        .floating-search {
            position: sticky;
            top: 70px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        /* Footer */
        footer {
            background: #343a40;
            color: white;
            padding: 20px 0;
        }
        footer a {
            color: #adb5bd;
            text-decoration: none;
        }
        footer a:hover {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php include 'inc/topBarNav.php'; ?>

<!-- Hero Section -->
<section class="hero mb-5">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="display-4 fw-bold">Find Your Perfect Vehicle</h1>
        <p class="lead mb-4">Browse and filter new vehicles available for purchase</p>
        <a href="#searchSection" class="btn btn-primary btn-lg">Start Your Search</a>
    </div>
</section>

<div class="container">
    <div class="row">
        <!-- Filter Sidebar -->
        <aside class="col-lg-3 filter-sidebar mb-4">
            <h5>Filters</h5>
            <form id="filterForm">
                <div class="mb-3">
                    <label for="make" class="form-label">Make</label>
                    <select id="make" name="make" class="form-select">
                        <option value="">All Makes</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <select id="model" name="model" class="form-select" disabled>
                        <option value="">All Models</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                <select id="year" name="year" class="form-select" disabled>
                    <option value="">Any Year</option>
                </select>
                </div>
                <div class="mb-3">
                    <label for="priceRange" class="form-label">Price Range</label>
                    <select id="priceRange" name="priceRange" class="form-select">
                        <option value="">Any Price</option>
                        <option value="0-500000">Up to ₹5,00,000</option>
                        <option value="500001-1000000">₹5,00,001 - ₹10,00,000</option>
                        <option value="1000001-2000000">₹10,00,001 - ₹20,00,000</option>
                        <option value="2000001-5000000">₹20,00,001 - ₹50,00,000</option>
                        <option value="5000001-10000000">Above ₹50,00,000</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select id="type" name="type" class="form-select">
                        <option value="">Any Type</option>
                        <option value="new">New</option>
                        <option value="used">Used</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="col-lg-9">
            <!-- Floating Search Bar -->
            <div class="floating-search mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by make or model..." />
            </div>

            <!-- Sorting Options -->
            <div class="d-flex justify-content-end mb-3">
                <select id="sortOptions" class="form-select w-auto">
                    <option value="">Sort By</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="year_asc">Year: Oldest First</option>
                    <option value="year_desc">Year: Newest First</option>
                </select>
            </div>

            <!-- Vehicle Cards -->
            <div id="vehicleCards" class="row g-4">
                <!-- Vehicle cards will be dynamically inserted here -->
            </div>
        </main>
    </div>
</div>

<!-- Footer -->
<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Popular Categories</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Sedans</a></li>
                    <li><a href="#">SUVs</a></li>
                    <li><a href="#">Hatchbacks</a></li>
                    <li><a href="#">Electric Vehicles</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Financing Options</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Loan Calculator</a></li>
                    <li><a href="#">EMI Plans</a></li>
                    <li><a href="#">Insurance</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>Email: support@yourwebsite.com</p>
                <p>Phone: +91 12345 67890</p>
                <p>Address: 123 Vehicle St, City, Country</p>
            </div>
        </div>
    </div>
</footer>

<script>
$(document).ready(function() {
    // Load makes from CarQuery API
    $.ajax({
        url: 'https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getMakes',
        dataType: 'jsonp',
        success: function(data) {
            if(data && data.Makes) {
                var makeSelect = $('#make');
                $.each(data.Makes, function(i, make) {
                    makeSelect.append($('<option>', {
                        value: make.make_slug,
                        text: make.make_display
                    }));
                });
            }
        }
    });

    // Load models when make is selected
    $('#make').change(function() {
        var make = $(this).val();
        var modelSelect = $('#model');
        var yearSelect = $('#year');
        modelSelect.empty().append('<option value="">All Models</option>');
        yearSelect.empty().append('<option value="">Any Year</option>').prop('disabled', true);
        if(make) {
            modelSelect.prop('disabled', false);
            $.ajax({
                url: 'https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getModels&make=' + make,
                dataType: 'jsonp',
                success: function(data) {
                    if(data && data.Models) {
                        $.each(data.Models, function(i, model) {
                            modelSelect.append($('<option>', {
                                value: model.model_name,
                                text: model.model_name
                            }));
                        });
                    }
                }
            });
        } else {
            modelSelect.prop('disabled', true);
        }
    });

    // Load years when model is selected
    $('#model').change(function() {
        var make = $('#make').val();
        var model = $(this).val();
        var yearSelect = $('#year');
        yearSelect.empty().append('<option value="">Any Year</option>');
        if(make && model) {
            yearSelect.prop('disabled', false);
            $.ajax({
                url: 'https://www.carqueryapi.com/api/0.3/?callback=?&cmd=getYears&make=' + make + '&model=' + model,
                dataType: 'jsonp',
                success: function(data) {
                    if(data && data.Years) {
                        $.each(data.Years, function(i, year) {
                            yearSelect.append($('<option>', {
                                value: year,
                                text: year
                            }));
                        });
                    }
                }
            });
        } else {
            yearSelect.prop('disabled', true);
        }
    });

    // Filter and search vehicles (simulated)
    function filterVehicles() {
        var make = $('#make').val().toLowerCase();
        var model = $('#model').val().toLowerCase();
        var year = $('#year').val();
        var priceRange = $('#priceRange').val();
        var type = $('#type').val();
        var searchText = $('#searchInput').val().toLowerCase();
        var sortOption = $('#sortOptions').val();

        // Simulated vehicle data
        var vehicles = [
            {id:1, make:'Toyota', model:'Camry', year:2022, price:2400000, type:'new', image:'uploads/toyota_camry.jpg', description:'A reliable sedan.'},
            {id:2, make:'Honda', model:'Civic', year:2021, price:2200000, type:'new', image:'uploads/honda_civic.jpg', description:'A sporty compact car.'},
            {id:3, make:'Ford', model:'Mustang', year:2020, price:3500000, type:'used', image:'uploads/ford_mustang.jpg', description:'A classic muscle car.'},
            {id:4, make:'Toyota', model:'Fortuner', year:2023, price:4500000, type:'new', image:'uploads/Fortuner.jpg', description:'A Luxury of Freedom'},
            {id:5, make:'Hyundai', model:'Creta', year:2022, price:1800000, type:'new', image:'uploads/hyundai_creta.jpg', description:'A popular SUV.'}
        ];

        // Filter vehicles
        var filtered = vehicles.filter(function(v) {
            var matchesMake = make ? v.make.toLowerCase() === make : true;
            var matchesModel = model ? v.model.toLowerCase() === model : true;
            var matchesYear = year ? v.year == year : true;
            var matchesType = type ? v.type === type : true;
            var matchesSearch = searchText ? (v.make.toLowerCase().includes(searchText) || v.model.toLowerCase().includes(searchText)) : true;
            var matchesPrice = true;
            if(priceRange) {
                var parts = priceRange.split('-');
                var min = parseInt(parts[0]);
                var max = parseInt(parts[1]);
                matchesPrice = v.price >= min && v.price <= max;
            }
            return matchesMake && matchesModel && matchesYear && matchesType && matchesSearch && matchesPrice;
        });

        // Sort vehicles
        if(sortOption) {
            if(sortOption === 'price_asc') {
                filtered.sort((a,b) => a.price - b.price);
            } else if(sortOption === 'price_desc') {
                filtered.sort((a,b) => b.price - a.price);
            } else if(sortOption === 'year_asc') {
                filtered.sort((a,b) => a.year - b.year);
            } else if(sortOption === 'year_desc') {
                filtered.sort((a,b) => b.year - a.year);
            }
        }

        // Render vehicle cards
        var container = $('#vehicleCards');
        container.empty();
        if(filtered.length === 0) {
            container.html('<p>No vehicles found matching your criteria.</p>');
            return;
        }
        filtered.forEach(function(v) {
            var card = $('<div>').addClass('col-md-6 col-lg-4');
            var cardInner = $('<div>').addClass('card vehicle-card h-100 shadow-sm');
            var img = $('<img>').addClass('card-img-top').attr('src', v.image).attr('alt', v.make + ' ' + v.model);
            var cardBody = $('<div>').addClass('card-body d-flex flex-column');
            var title = $('<h5>').addClass('card-title').text(v.make + ' ' + v.model);
            var price = $('<p>').addClass('card-text text-primary fw-bold').text('₹' + v.price.toLocaleString());
            var desc = $('<p>').addClass('card-text flex-grow-1').text(v.description);
            var cta = $('<a>').addClass('btn btn-success mt-auto').attr('href', 'vehicle_details.php?id=' + v.id).text('View Details');

            cardBody.append(title, price, desc, cta);
            cardInner.append(img, cardBody);
            card.append(cardInner);
            container.append(card);
        });
    }

    // Event handlers
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        filterVehicles();
    });
    $('#searchInput').on('input', function() {
        filterVehicles();
    });
    $('#sortOptions').on('change', function() {
        filterVehicles();
    });

    // Initial load
    filterVehicles();
});
</script>
</body>
</html>
