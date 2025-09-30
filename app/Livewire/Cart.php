<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Cart extends Component
{

    public $customer_id;
    public $product_id;
    public $quantity  ;

    public function mount()
    {
        if (!Auth::guard('customer')->check()) {
             return redirect()->route('customer.login');
        }
    }

    public function up($cart )
    {

        $this->product_id = $cart['product_id'];
        $product = Product::where( 'id', $cart['product_id'] )->first();
        $customer_id = Auth::guard('customer')->user()->id;

        $cart =ModelsCart::where(['customer_id'=>$customer_id,'product_id'=>$this->product_id ])->first();
        $this->quantity = $cart->quantity;


        if ($product->quantity >  $cart->quantity ) {
            $ip = request()->ip();
            $response = Http::get("http://ip-api.com/json/{$ip}");
            if ($response->successful()) {
                $data = $response->json();
                $country = $data['countryCode'] ?? 'Unknown';
                if ($country == 'Egypt') {
                   $price = $product->price ;
                } else {
                   $price =$product->price1;
                }
            }
            $cart->update(['quantity' => $cart->quantity+1,'total' => $price * ($cart->quantity+1)]);
            $this->quantity++;
            session()->flash('success1', 'تم زيادة المنتج بنجاح');

        } else {
            session()->flash('error1', 'لا يمكن تجاوز الكمية المتوفرة.');
        }
}


public function down($cart )
{

    $this->product_id = $cart['product_id'];
    $product = Product::where( 'id', $cart['product_id'] )->first();
    $customer_id = Auth::guard('customer')->user()->id;
    $cart =ModelsCart::where(['customer_id'=>$customer_id,'product_id'=>$this->product_id ])->first();

    $this->quantity = $cart->quantity;
//   dd($this->quantity);
    if ($this->quantity >1) {

        $ip = request()->ip();
        $response = Http::get("http://ip-api.com/json/{$ip}");
        if ($response->successful()) {
            $data = $response->json();
            $country = $data['countryCode'] ?? 'Unknown';
            if ($country == 'Egypt') {
               $price = $product->price ;
            } else {
               $price =$product->price1;
            }
        }
        $cart->update(['quantity' => $cart->quantity-1,'total' => $price * ($cart->quantity-1)]);
        $this->quantity--;
        session()->flash('success1', 'تم انقاص المنتج بنجاح');

    } else {
        session()->flash('error1', 'لا يمكن تجاوز الكمية المتوفرة.');
    }
}



public function delete($product_id) {
    $customer_id = Auth::guard('customer')->user()->id;
      $cart =ModelsCart::where(['customer_id'=>$customer_id,'product_id'=>$product_id])->first();
        if ($cart) {

            $cart->delete();
        session()->flash('success1', 'تم الحذف بنجاح');

        }
}





    public function render()
    {

        $customer_id = Auth::guard('customer')->user()->id;
        $carts =ModelsCart::where(['customer_id'=>$customer_id])->get();

          return view('livewire.cart',['carts'=>$carts  ]);

    }
}
