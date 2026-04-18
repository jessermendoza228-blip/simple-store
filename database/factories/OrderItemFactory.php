<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        return [
            'order_id' => Order::inRandomOrder()->first()->id ?? 1,
            'product_id' => $product->id ?? 1,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $product->price ?? 100,
        ];
    }
}