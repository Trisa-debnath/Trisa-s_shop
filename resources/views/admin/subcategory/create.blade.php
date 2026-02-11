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
                <h5 class="card-title mb-1">Create Subcategory</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('store.subcategore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="subcategory_name" class="form-label">SubCategory Name</label>
                        <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" required placeholder="Create Subcategory Name">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category Name</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categorys as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> 



@endsection
