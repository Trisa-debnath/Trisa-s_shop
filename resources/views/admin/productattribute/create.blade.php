@extends('admin.layouts.layout')
@section('admin_page_title')
default attribute create page
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
									<h5 class=" card-title mb-1 ">Default attribute create</h5>
								</div>
        <form action="{{ route('store.productattribute') }}"  method="POST" class="mb-4">
            @csrf
            <div class="card col-12 col-lg-6" >
                <label for="attribute_value" class="mb-2">Attribute Value</label>
                <input type="text" name="attribute_value" id="attribute_value" class="form-control" required placeholder="create attribute value " >
            </div>
         
            <button type="submit" class="btn btn-success" >Submit</button>
        </form>
       </div>
    </div>


@endsection
