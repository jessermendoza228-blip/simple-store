<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        User::factory(10)->create();
        Category::factory(5)->create();
        Product::factory(20)->create();
        Order::factory(10)->create();
        OrderItem::factory(30)->create();
    }
}