<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'City Bank', 'type' => 'bank', 'sort_order' => 1],
            ['name' => 'IBBL Bank', 'type' => 'bank', 'sort_order' => 2],
            ['name' => 'Southeast Bank', 'type' => 'bank', 'sort_order' => 3],
            ['name' => 'Standard Chartered', 'type' => 'bank', 'sort_order' => 4],
            ['name' => 'Eastern Bank Limited', 'type' => 'bank', 'sort_order' => 5],
            ['name' => 'BKash', 'type' => 'mobile_banking', 'sort_order' => 6],
            ['name' => 'Cash Payment', 'type' => 'cash', 'sort_order' => 7],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
