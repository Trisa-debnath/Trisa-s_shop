<div >
    
   @if ($message)
    <div class="alert alert-success text-center">
        {{ $message }}
    </div>
@endif


    
<div class="d-flex gap-2 justify-content-center">

    <input type="number" wire:model="quantity" min="1" max="{{ $product->stock_quantity }}" class="form-control form-control-sm" style="width: 70px;">
    <button wire:click="addToCart" class="btn btn-sm btn-pink">
        Add to Cart
    </button>



</div>

</div>
