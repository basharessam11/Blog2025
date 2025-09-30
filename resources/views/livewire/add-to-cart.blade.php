<div>


    <div class="products-add-to-cart">
        <button type="submit" class="default-btn"
            wire:click="addToCart({{ $product }})">{{ __('web.Add to Cart') }}<i
                class="flaticon-shopping-cart"></i></button>

        <div class="input-counter">
            <span class="minus-btn" wire:click="down({{ $product }},1)"><i class='bx bx-minus'></i></span>
            <input type="text" value="1" wire:model="quantity" min="1" max="{{ $product->quantity }}">
            <span class="plus-btn" wire:click="up({{ $product }},1)"><i class='bx bx-plus'></i></span>
        </div>
    </div>

    @if (session('success1'))
        <br>
        <div class="alert alert-success text-center">
            {{ session('success1') }}
        </div>
    @endif

    @if (session('error1'))
        <br>

        <div class="alert alert-danger text-center">
            {{ session('error1') }}
        </div>
    @endif
</div>
