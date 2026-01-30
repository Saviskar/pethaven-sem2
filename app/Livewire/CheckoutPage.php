<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

class CheckoutPage extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $subtotal = 0;
    public $shipping = 500.00;

    public $name = '';
    public $email = '';
    public $address = '';

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->loadCart();

        if (request()->routeIs('checkout.success')) {
            $this->handleSuccess();
        } elseif (request()->routeIs('checkout.cancel')) {
            session()->flash('error', 'Payment was cancelled.');
        }

        if (empty($this->cartItems) && !session()->has('message')) {
            return redirect()->route('shop');
        }

        if (!request()->routeIs('checkout.success') && !request()->routeIs('checkout.cancel')) {
           $this->prefillUser();
        }
    }

    public function prefillUser()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $userAddress = $user->addresses()->first();
        if ($userAddress) {
            $this->address = $userAddress->address_line;
        }
    }

    public function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        
        $this->total = $this->subtotal + $this->shipping;
    }

    public function placeOrder()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'address' => 'required|min:5',
        ]);

        if (empty($this->cartItems)) {
            return;
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        foreach ($this->cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => $item['name'],
                        // 'images' => [$item['image_url']], // Optional if image exists
                    ],
                    'unit_amount' => intval($item['price'] * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Add shipping
        $lineItems[] = [
            'price_data' => [
                'currency' => 'lkr',
                'product_data' => [
                    'name' => 'Shipping Fee',
                ],
                'unit_amount' => intval($this->shipping * 100),
            ],
            'quantity' => 1,
        ];

        try {
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
                'customer_email' => $this->email,
            ]);

            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            session()->flash('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function handleSuccess()
    {
        // In a real app, verify the session_id with Stripe here.
        
        if (empty($this->cartItems)) {
            return redirect()->route('home');
        }

        $order = DB::transaction(function () {
            $order = Order::create([
                'user_id' => auth()->id(),
                'placed_at' => now(),
                'status' => 'processing',
            ]);

            foreach ($this->cartItems as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId, // Ensure this matches existing product IDs
                    'quantity' => $item['quantity'],
                    'unit_price_at_order' => $item['price'],
                ]);

                // Decrement stock
                $product = \App\Models\Product::find($productId);
                if ($product) {
                    $product->stock = max(0, $product->stock - $item['quantity']);
                    $product->save();
                }
            }
            
            return $order;
        });

        // Queue order confirmation email
        Mail::to($this->email)->queue(new OrderPlaced($order));

        session()->forget('cart');
        $this->cartItems = [];
        
        session()->flash('message', 'Payment successful! Your order has been placed.');
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.checkout-page')->layout('layouts.guest');
    }
}
