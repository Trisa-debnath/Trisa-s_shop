<div class="dropdown">
    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
        🛒 Cart ({{ count($cart) }})
    </button>
    <ul class="dropdown-menu p-3" style="min-width:300px;">
        @forelse ($cart as $id => $item)
            <li class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <strong>{{ $item['name'] }}</strong><br>
                    <small>{{ $item['quantity'] }} × {{ $item['price'] }} = {{ $item['quantity'] * $item['price'] }}</small>
                </div>
                <div>
                    <button wire:click="increaseQuantity({{ $id }})" class="btn btn-sm btn-success">+</button>
                    <button wire:click="decreaseQuantity({{ $id }})" class="btn btn-sm btn-warning">-</button>
                   
<button wire:click="removeItem({{ $id }})" class="btn btn-sm btn-danger">
    <i class="fas fa-trash"></i>
</button>

                </div>
            </li>
        @empty
            <li class="text-center text-muted">Cart is empty</li>
        @endforelse

   <!-- for payball option -->
        @if(count($cart) > 0)
    <li class="mt-2 text-center">
        <a href="{{ route('order.proceed') }}" class="btn btn-primary btn-sm">Proceed to Order</a>
    </li>
@endif

    </ul>
</div>

<script>
document.addEventListener('notify', function(e) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon:  e.detail.type,
        title: e.detail.title,
        showConfirmButton: false,
        timer: 2000

    });
});
</script>
