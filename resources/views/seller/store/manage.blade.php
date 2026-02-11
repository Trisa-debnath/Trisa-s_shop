@extends('seller.layouts.layout')
@section('seller_page_title')
store manage
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

        <!--  Form -->
        <div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header primary">
									<h5 class="card-title mb-4 ">Manage store</h5>

                                    
       @if(session('success'))
      <div class="alert alert-success">
       <h3 class="mb-4">{{session('success')}}</h3>
       </div>
        @endif
               
        <!-- Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Store Name</th>
                    <th>Slug</th>
                    <th>Details</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stores as $store)
                    <tr>
                        <td>{{ $store->id }}</td>
                        <td>{{ $store->store_name}}</td>
                        <td>{{ $store->slug}}</td>
                        <td>{{ $store->details}}</td>

                        <td>
                            <a href="{{ route('edit.store', $store->id)}}" method="GET"  class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('update.store', $store->id)}}" method="POST" style="display:inline;"></td>
                           


                    @csrf
                        <td>   </form>

                   
                             <form action="{{ route('delete.store', $store->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>

                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    


				</div>
							</div>


@endsection
