@extends('admin.layouts.layout')
@section('admin_page_title')
category create page
@endsection
@section('admin_layout')


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
       @if(session('success'))
       <h3 class="mb-4">{{session('success')}}</h3>
        @endif
        </div>
        <!-- category Form -->
        <div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header primary">
									<h5 class=" card-title mb-1 ">create category</h5>
								</div>
        <form action="{{ route('store.categore') }}"  method="POST" class="mb-4">
            @csrf
            <div class="card col-12 col-lg-6" >
                <label for="category_name" class="mb-2">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" required placeholder="create category name " >
            </div>
         
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
       </div>
    </div>


@endsection
