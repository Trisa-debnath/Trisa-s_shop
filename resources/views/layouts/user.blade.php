<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trisha's Shop</title>
    <link rel="icon" type="image/png" href="{{ asset('home_asset/img/favi.png') }}">

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
      background: linear-gradient(to right, #90db2e, #df4399);
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
    main {
  padding-top: 0 !important;
  margin-top: 0 !important;
   padding-left: 0 !important;
   margin-left: 0 !important;
}


    .time-flash {
      background-color: #fff3cd;
       padding: 20px 30px; 
      border-left: 6px solid #ffc107;
      font-size: 1.4rem;
      font-weight: 600;
      margin-bottom: 0px;
      text-align: center;
       display: inline-block;
  border-radius: 6px;
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

    .btn-pink {
    background: linear-gradient(to right, #e91e63, #f06292);
    color: white;
    border: none;
    padding: 6px 16px;
    border-radius: 20px;
    font-weight: 500;
    box-shadow: 0 4px 6px rgba(233, 30, 99, 0.3);
    transition: all 0.3s ease-in-out;
  }

  .btn-pink:hover {
    background: linear-gradient(to right, #d81b60, #ec407a);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(233, 30, 99, 0.4);
  }
  </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   @livewireStyles
   <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

 
</head>

<body>

  <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark py-1 sticky-top">
 
    <div class="container">
     

      <a class="navbar-brand" href="{{url('/')}}">
    <img src="{{ asset('home_asset/img/logo.png') }}" 
    alt="logo" height="60px">
</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>


        @php
  $categories = \App\Models\Category::all();
@endphp

            <ul class="dropdown-menu">
              @foreach ($categories as $categori)
                 <li><a class="dropdown-item" href="{{ route('productby.category', $categori->category_name) }}">{{$categori->category_name}}</a></li>
              @endforeach
             
             
            </ul>
          </li>
         
          
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>

     
     
<!-- Cart Dropdown Button -->
 <div class="ms-4">
      @livewire('ProductCartComponent')
  </div>


<!-- Login / Register / Logout Button -->

<div class="ms-4 d-flex gap-2">
@guest

   <a href="{{ route('login') }}" class="btn btn-outline-light">
       <i class="fas fa-user"></i> Login
   </a>
   <a href="{{ route('register') }}" class="btn btn-outline-light">
       <i class="fas fa-user-plus"></i> Register
   </a>
@endguest

@auth
   <form method="POST" action="{{ route('logout') }}" class="d-inline">
       @csrf
       <button type="submit" class="btn btn-outline-light">
           <i class="fas fa-sign-out-alt"></i> Logout
       </button>
   </form>
@endauth

</div>


        
      </div>
    </div>
  </nav>

  <!-- Main Content -->
 <main class="p-0 m-0 w-100">

    <div class="container-fluid p-0 m-0">

<!-- 🕒 Time -->
    <div class="time-flash px-3 py-2" style="font-size: 1rem;">
      Time: <span id="time">--:--:--</span>
    </div>

    <!-- 🔍 Search Full Width -->
    <div class="w-100" style="width: 100%;">
      @livewire('product-search-component')
    </div>

  
     <main>
        @yield('home')
        @livewire('HomeSellerflashComponent') 
 
        
      </main>
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

   @livewireScripts

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('cart-updated', event => {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: event.detail.type,
            title: event.detail.title,
            showConfirmButton: false,
            timer: 1500
        });
    });

     //  notify 
    window.addEventListener('notify', event => {
        const data = event.detail[0];  
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: data.type,
            title: data.title,
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>


<script>
  function updateTime() {
    const now = new Date();
    document.getElementById("time").innerText =
      now.toLocaleTimeString('en-US', { hour12: true });
  }
  setInterval(updateTime, 1000);
  updateTime();
</script>
</body>
</html>
