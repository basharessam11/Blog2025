<div>
    <section class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

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
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                @php

                                    $totalPrice = 0;
                                    $totalTax = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    @php
                                        if (App::isLocale('en')) {
                                            $slug = $cart->product->slug_en;

                                            $title = $cart->product->title_en;
                                        } else {
                                            $slug = $cart->product->slug_ar;
                                            $title = $cart->product->title_ar;
                                        }
                                    @endphp

                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#">
                                                <img src="{{ asset('images') }}/{{ $cart->product->photo }}"
                                                    alt="image">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ route('products_details', $slug) }}">{{ $title }}</a>
                                        </td>
                                        <td class="product-price">
                                            <span class="unit-amount">
                                                @php
                                                    $ip = request()->ip();
                                                    $response = Http::get("http://ip-api.com/json/{$ip}");
                                                    if ($response->successful()) {
                                                        $data = $response->json();
                                                        $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                                                        if ($country == 'Egypt') {
                                                            echo 'EGP ' . $cart->product->price . 'x' . $cart->quantity;
                                                        } else {
                                                            echo '$' . $cart->product->price1 . 'x' . $cart->quantity;
                                                        }
                                                    } else {
                                                        echo '$' . $cart->product->price1 . 'x' . $cart->quantity;
                                                    }
                                                @endphp </span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="input-counter">

                                                <span class="minus-btn" wire:click="down({{ $cart }},1)"><i
                                                        class='bx bx-minus'></i></span>
                                                <input type="text" value="{{ $cart->quantity }}" min="1"
                                                    max="{{ $cart->product->quantity }}">
                                                <span class="plus-btn" wire:click="up({{ $cart }},1)"><i
                                                        class='bx bx-plus'></i></span>





                                                {{--
                                                    <span class="minus-btn">
                                                        <i class='bx bx-minus'></i>
                                                    </span>
                                                    <input type="text" value="1">
                                                    <span class="plus-btn">
                                                        <i class='bx bx-plus'></i>
                                                    </span> --}}
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="subtotal-amount">@php

                                                if ($response->successful()) {
                                                    $data = $response->json();
                                                    $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                                                    if ($country == 'Egypt') {
                                                        echo 'EGP ' . $cart->quantity * $cart->product->price;
                                                        $totalPrice += $cart->quantity * $cart->product->price;
                                                        $totalTax += $cart->quantity * $cart->product->tax;
                                                    } else {
                                                        echo '$' . $cart->quantity * $cart->product->price1;
                                                        $totalPrice += $cart->quantity * $cart->product->price1;
                                                        $totalTax += $cart->quantity * $cart->product->tax1;
                                                    }
                                                } else {
                                                    echo '$' . $cart->quantity * $cart->product->price1;
                                                    $totalPrice += $cart->quantity * $cart->product->price1;
                                                    $totalTax += $cart->quantity * $cart->product->tax1;
                                                }
                                            @endphp </span>
                                        </td>
                                        <td class="remove">
                                            <a wire:click="delete({{ $cart->product_id }})">
                                                <i class='bx bx-x'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                    <div class="cart-buttons">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-sm-7 col-md-7">
                                <div class="shopping-coupon-code">
                                    {{-- <input type="text" class="form-control" placeholder="Enter Coupon Code"
                                        name="coupon-code" id="coupon-code">
                                    <button type="submit" class="default-btn">Apply Coupon <i
                                            class="flaticon-right-arrow"></i></button> --}}
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-5 col-md-5">
                                <a href="{{ route('products') }}" class="default-btn">Continue Shopping <i
                                        class="flaticon-right-arrow"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="cart-totals">
                        <h3>Cart Total</h3>
                        <ul>
                            <li>
                                Sub Total
                                <span>
                                    @php

                                        if ($response->successful()) {
                                            $data = $response->json();
                                            $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                                            if ($country == 'Egypt') {
                                                echo 'EGP ' . $totalPrice;
                                            } else {
                                                echo '$' . $totalPrice;
                                            }
                                        } else {
                                            echo '$' . $totalPrice;
                                        }
                                    @endphp

                                </span>
                            </li>
                            <li>
                                Tax
                                <span>@php

                                    if ($response->successful()) {
                                        $data = $response->json();
                                        $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                                        if ($country == 'Egypt') {
                                            echo 'EGP ' . $totalTax;
                                        } else {
                                            echo '$' . $totalTax;
                                        }
                                    } else {
                                        echo '$' . $totalTax;
                                    }
                                @endphp </span>
                            </li>
                            <li>
                                Total
                                <span><b>@php

                                    if ($response->successful()) {
                                        $data = $response->json();
                                        $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                                        if ($country == 'Egypt') {
                                            echo 'EGP ' . $totalPrice + $totalTax;
                                        } else {
                                            echo '$' . $totalPrice + $totalTax;
                                        }
                                    } else {
                                        echo '$' . $totalPrice + $totalTax;
                                    }
                                @endphp </b></span>
                            </li>
                        </ul>
                        <div class="totals-btn">



                            <a href="{{ route('checkout') }}" class="default-btn">Proceed To Checkout <i
                                    class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
