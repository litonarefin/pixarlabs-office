<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseCategories = [
            // Office Expenses
            ['name' => 'Employee Salary', 'slug' => 'employee-salary', 'type' => 'office', 'sort_order' => 1],
            ['name' => 'Office Furniture', 'slug' => 'office-furniture', 'type' => 'office', 'sort_order' => 2],
            ['name' => 'Server Bill', 'slug' => 'server-bill', 'type' => 'office', 'sort_order' => 3],
            ['name' => 'AWS', 'slug' => 'aws', 'type' => 'office', 'sort_order' => 4],
            ['name' => 'Linode', 'slug' => 'linode', 'type' => 'office', 'sort_order' => 5],
            ['name' => 'Vultr', 'slug' => 'vultr', 'type' => 'office', 'sort_order' => 6],
            ['name' => 'Amazon SES', 'slug' => 'amazon-ses', 'type' => 'office', 'sort_order' => 7],
            ['name' => 'Rent', 'slug' => 'rent', 'type' => 'office', 'sort_order' => 8],
            ['name' => 'Lunch', 'slug' => 'lunch', 'type' => 'office', 'sort_order' => 9],
            ['name' => 'Office Internet', 'slug' => 'office-internet', 'type' => 'office', 'sort_order' => 10],
            ['name' => 'Coffee Beans', 'slug' => 'coffee-beans', 'type' => 'office', 'sort_order' => 11],

            // Personal Expenses
            ['name' => 'Family', 'slug' => 'family', 'type' => 'personal', 'sort_order' => 12],
            ['name' => 'Home Internet', 'slug' => 'home-internet', 'type' => 'personal', 'sort_order' => 13],
            ['name' => 'Home Rent', 'slug' => 'home-rent', 'type' => 'personal', 'sort_order' => 14],
            ['name' => 'Nahian School', 'slug' => 'nahian-school', 'type' => 'personal', 'sort_order' => 15],
            ['name' => 'Safwan School', 'slug' => 'safwan-school', 'type' => 'personal', 'sort_order' => 16],
            ['name' => 'Home Assistant (Bua)', 'slug' => 'home-assistant-bua', 'type' => 'personal', 'sort_order' => 17],

            // Shared Expenses
            ['name' => 'Product Share (Labu)', 'slug' => 'product-share-labu', 'type' => 'shared', 'sort_order' => 18],
            ['name' => 'Product Share (Babar Vai)', 'slug' => 'product-share-babar-vai', 'type' => 'shared', 'sort_order' => 19],
        ];

        foreach ($expenseCategories as $category) {
            ExpenseCategory::create($category);
        }
    }
}
