<!DOCTYPE html>
<html lang="en">
<head>

  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your E-commerce Store</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Login</a></li>
                <li><a href="">Contact Us</a></li>
                <li><a href="">About Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Your E-commerce Store</h1>
            <p>Shop the latest trends in fashion, electronics, and more!</p>
            <a href="" class="btn btn-primary">Shop Now</a>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <!-- Display featured products here -->
            <!-- Example product card -->
            <div class="product-card">
                <img src="{{ asset('images/product1.jpg') }}" alt="Product 1">
                <h3>Product 1</h3>
                <p class="price">$99.99</p>
                <a href="" class="btn btn-secondary">View Details</a>
            </div>

            <!-- Repeat this structure for more products -->
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <!-- Your footer content goes here -->
        <p>&copy; 2023 Your E-commerce Store</p>
    </footer>
</body>
</html>
