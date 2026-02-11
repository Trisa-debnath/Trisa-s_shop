@extends('seller.layouts.layout')
@section('seller_page_title')
store create
@endsection
@section('seller_layout')


      <div class="message">
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
       <div class="message-success">
       @if(session('message'))
       <h3 class="mb-4">{{session('message')}}</h3>
        @endif
        <!-- store Form -->
        <div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header primary">
									<h5 class=" card-title mb-1 ">create store</h5>
								</div>
        <form action="{{ route('vendor.store.create') }}"  method="POST" class="mb-4">
            @csrf
            <div class="col-12 col-lg-6" >
                <label for="store_name" class="mb-2">Store Name</label>
                <input type="text" name="store_name" id="store_name" class="form-control" required placeholder="create store name " >
            </div>
            <div class="card col-4 col-lg-6" >
                <label for="slug" class="mb-2">slug</label>
                <input type="text" name="slug" id="slug" class="form-control" required placeholder="create slug " >
            </div>
            <div class="card col-4 col-lg-6" >
                <label for="details" class="mb-2">details</label>
                <textarea name="details" id="details" class="form-control" required ></textarea>
            </div>
         
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
       </div>
    </div>


@endsection
