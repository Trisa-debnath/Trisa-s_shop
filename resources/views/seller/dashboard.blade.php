@extends('seller.layouts.layout')
@section('seller_page_title')
dashboard
@endsection
@section('seller_layout')

    <div class="container-fluid">
    <div class="row">
        <!-- Total Revenue Card -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card text-white bg-success shadow-sm border-0 rounded-3 h-100">
        <div class="card-body">
            <h4 class="fw-bold mb-1">{{$total_product}}</h4>
          
            <h6 class="fw-normal">Total Product</h6>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card text-white bg-primary shadow-sm border-0 rounded-3 h-100">
        <div class="card-body">
            <h4 class="fw-bold mb-1">{{$total_order}}</h4>
            
            <h6 class="fw-normal">Total Order</h6>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card text-white bg-danger shadow-sm border-0 rounded-3 h-100">
        <div class="card-body">
            <h4 class="fw-bold mb-1">{{$total_store}}</h4>
           
            <h6 class="fw-normal">Total Store</h6>
        </div>
    </div>
</div>


        <!-- Total Revenue -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card text-white bg-success shadow-sm border-0 rounded-3 h-100">
        <div class="card-body">
            <h4 class="fw-bold mb-1">#</h4>
          
            <h6 class="fw-normal">Total Revenue</h6>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card text-white bg-primary shadow-sm border-0 rounded-3 h-100">
        <div class="card-body">
            <h4 class="fw-bold mb-1">#</h4>
           
            <h6 class="fw-normal">Delevered Product</h6>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card text-white bg-danger shadow-sm border-0 rounded-3 h-100">
        <div class="card-body">
            <h4 class="fw-bold mb-1">#</h4>
      
            <h6 class="fw-normal">Total Order Pending Product</h6>
        </div>
    </div>
</div>


        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="fw-bold mb-1 text-dark">#</h4>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 p-3 rounded-3 d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-account-group text-primary fs-3"></i>
                        </div>
                    </div>
                    <h6 class="text-muted fw-normal mb-0">Total Order Cancelled</h6>
                </div>
            </div>
        </div>
       
       
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="fw-bold mb-1 text-dark">250</h4>
                            <p class="text-primary fw-semibold mb-0">
                                <i class="mdi mdi-account me-1"></i> +1.8%
                            </p>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 p-3 rounded-3 d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-account-group text-primary fs-3"></i>
                        </div>
                    </div>
                    <h6 class="text-muted fw-normal mb-0">Customers</h6>
                </div>
            </div>
        </div>
        <!-- -->

    </div>
</div>

@endsection


