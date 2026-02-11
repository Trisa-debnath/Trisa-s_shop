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

        <!--  Form -->
        <div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header primary">
									<h5 class="card-title mb-4 ">product Attribute manage</h5>

                                    
       @if(session('success'))
      <div class="alert alert-success">
       <h3 class="mb-4">{{session('success')}}</h3>
       </div>
        @endif
               
        <!-- category Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Attribute Value</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($manageat as $defaultat)
                    <tr>
                        <td>{{ $defaultat->id }}</td>
                        <td>{{ $defaultat->attribute_value}}</td>
                        <td>
                            <a href="{{ route('edit.productattribute', $defaultat->id)}}" method="GET"  class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('update.productattribute', $defaultat->id)}}" method="POST" style="display:inline;"></td>
                            <td>
                    @csrf
                                @method('DELETE')
                   
                                <a href="{{ route('delete.productattribute',  $defaultat->id)}}" method="GET"  class="btn btn-warning btn-sm">
                                <button type="submit" class="btn btn-danger btn-sm">Delete
                                </a>

                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    


				</div>
							</div>


@endsection
