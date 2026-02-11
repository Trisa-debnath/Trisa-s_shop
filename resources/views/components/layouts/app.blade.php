<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trisha's Shop</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
  <!-- Custom Style -->
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }
    .navbar {
      background: linear-gradient(to right, #e91e63, #9c27b0);
    }
    .navbar-brand {
      color: #fff !important;
      font-size: 1.5rem;
      font-weight: bold;
    }
    .nav-link {
      color: #f1f1f1 !important;
      position: relative;
      transition: all 0.3s ease;
    }
    .nav-link:hover::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: #fff;
    }
    .search-bar {
      width: 100%;
      max-width: 400px;
    }
    .time-flash {
      background-color: #fff3cd;
      padding: 15px;
      border-left: 5px solid #ffc107;
      font-size: 1.2rem;
      font-weight: 500;
      margin-bottom: 30px;
      text-align: center;
    }
    #footer {
      background-color: #343a40;
      color: white;
      padding: 40px 0;
    }
    #footer a {
      color: #ccc;
      text-decoration: none;
    }
    #footer a:hover {
      color: #fff;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">
      <a class="navbar-brand" href="#">Trisha's Shop</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Shoes</a></li>
              <li><a class="dropdown-item" href="#">Clothing</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>

        <!-- Searchbar -->
        <form class="d-flex search-bar me-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search">
          <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
        </form>

        <!-- Login Button -->
        <a href="#" class="btn btn-outline-light"><i class="fas fa-user"></i> Login</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="py-5">
    <div class="container">

      <!-- Time Flash -->
      <div class="time-flash">
        Time <span id="time">--:--:--</span>
      </div>

      {{ $slot }}
    </div>
  </main>

  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-4">
          <h4>Trisha's Shop</h4>
          <p>One-stop shop for all your style and fashion needs.</p>
        </div>
        <div class="col-lg-3 mb-4">
          <h5>Categories</h5>
          <ul class="list-unstyled">
            <li><a href="#">Shoes</a></li>
            <li><a href="#">Clothing</a></li>
          </ul>
        </div>
        <div class="col-lg-3 mb-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Support</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Live Time
    function updateTime() {
      const now = new Date();
      const timeString = now.toLocaleTimeString('bn-BD');
      document.getElementById('time').textContent = timeString;
    }
    setInterval(updateTime, 1000);
    updateTime(); // Initial call
  </script>
</body>
</html>
