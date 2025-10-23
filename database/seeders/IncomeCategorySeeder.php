<?php

namespace Database\Seeders;

use App\Models\IncomeCategory;
use Illuminate\Database\Seeder;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomeCategories = [
            ['name' => 'Freemius Products', 'slug' => 'freemius-products', 'type' => 'freemius', 'sort_order' => 1],
            ['name' => 'Paddle', 'slug' => 'paddle', 'type' => 'paddle', 'sort_order' => 2],
            ['name' => 'Affiliate Earnings', 'slug' => 'affiliate-earnings', 'type' => 'affiliate', 'sort_order' => 3],
            ['name' => 'Internal Sales', 'slug' => 'internal-sales', 'type' => 'internal', 'description' => 'Sales from bo.jeweltheme.com', 'sort_order' => 4],
            ['name' => 'Others', 'slug' => 'others', 'type' => 'others', 'sort_order' => 5],
        ];

        foreach ($incomeCategories as $category) {
            IncomeCategory::create($category);
        }
    }
}
