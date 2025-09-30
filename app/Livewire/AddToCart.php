<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddToCart extends Component
{

    public $customer_id;
    public $product_id ;
    public $quantity = 1;


    public function mount($product_id)
    {

        $this->product_id = $product_id;
    }


     public function addToCart($product)
    {

        if (!Auth::guard('customer')->check()) {

            return redirect()->route('customer.login');
        }


         $product = Product::findOrFail($product['id']);
         $customer_id = Auth::guard('customer')->user()->id;







         $cart = Cart::where('customer_id', $customer_id)
                    ->where('product_id', $product['id'])
                    ->first();

        if ($cart) {
             $totalQuantityInCart = $cart->quantity + $this->quantity;

             if ($totalQuantityInCart <= $product->quantity) {
                 $cart->increment('quantity', $this->quantity);



                 $ip = request()->ip();
                 $response = Http::get("http://ip-api.com/json/{$ip}");
                 if ($response->successful()) {
                     $data = $response->json();
                     $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)
                     if ($country == 'Egypt') {
                        $price = $product->price;
                     } else {
                        $price =$product->price1;
                     }
                 } else {
                    $price =$product->price1;
                 }

                $cart->update(['total' => $price * $cart->quantity]);

                session()->flash('success1', 'تم إضافة المنتج إلى السلة');
            } else {
                session()->flash('error1', 'لا يمكن زيادة الكمية عن المخزون المتوفر');
            }

        } else {
            $ip = request()->ip();
            $response = Http::get("http://ip-api.com/json/{$ip}");
            if ($response->successful()) {
                $data = $response->json();
                $country = $data['country'] ?? 'Unknown';
                if ($country == 'Egypt') {
                   $price = $product->price ;
                } else {
                   $price =$product->price1;
                }
            } else {
               $price =$product->price1;
               $country = $data['country'] ?? 'Unknown';
            }
             Cart::create([
                'customer_id' => $customer_id,
                'product_id' => $product['id'],

                'total' => $price * $this->quantity,
                'tax' => $product->tax ,
                'quantity' => $this->quantity,
            ]);
            session()->flash('success1', 'تم إضافة المنتج إلى السلة');
        }
    }



    public function up($product)
    {
        $this->product_id = $product['id'];
        if ($this->quantity < $product['quantity']) {
            $this->quantity++;
        } else {
            session()->flash('error1', 'لا يمكن تجاوز الكمية المتوفرة.');
        }




}


public function down($product)
    {
        $this->product_id = $product['id'];

        if ($this->quantity > 1) {
            $this->quantity--;
        } else {
            session()->flash('error1', 'لا يمكن أن تكون الكمية أقل من 1.');
        }
    }





    public function render()
    {

        $product =Product::findOrFail($this->product_id);
        return view('livewire.add-to-cart',['product'=>$product]);
    }
}
