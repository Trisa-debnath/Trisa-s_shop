@extends('admin.layouts.layout')

@section('admin_page_title')
Review Management
@endsection

@section('admin_layout')

<div class="container mt-4">
    <h3>Product Reviews</h3>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>User</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Status</th>
                <th width="150">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->product->product_name }}</td>
                <td>{{ $review->user->name }}</td>
                <td>{{ $review->rating }}/5</td>
                <td>{{ $review->review }}</td>
                <td>
                    <span class="badge bg-{{ 
                        $review->status=='approved'?'success':
                        ($review->status=='rejected'?'danger':'warning') }}">
                        {{ ucfirst($review->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.review.approve',$review->id) }}"
                       class="btn btn-success btn-sm">Approve</a>

                    <a href="{{ route('admin.review.reject',$review->id) }}"
                       class="btn btn-danger btn-sm">Reject</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Reviews Found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $reviews->links() }}
</div>
@endsection