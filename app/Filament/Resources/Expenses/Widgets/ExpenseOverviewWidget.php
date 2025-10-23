<?php

namespace App\Filament\Resources\Expenses\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExpenseOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Total expense (all time)
        $totalExpense = Expense::sum('amount_in_bdt');

        // This month's expense
        $thisMonthExpense = Expense::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount_in_bdt');

        // Average per month - calculate from total divided by number of months
        $firstExpense = Expense::orderBy('transaction_date', 'asc')->first();
        $avgMonthExpense = 0;

        if ($firstExpense) {
            $monthsDiff = now()->diffInMonths($firstExpense->transaction_date) + 1;
            $avgMonthExpense = $monthsDiff > 0 ? $totalExpense / $monthsDiff : 0;
        }

        // Count of categories
        $categoriesCount = Expense::distinct('expense_category_id')->count('expense_category_id');

        return [
            Stat::make('Total Expenses', '৳ ' . number_format($totalExpense, 2))
                ->description('All time expenses')
                ->color('danger'),

            Stat::make('This Month', '৳ ' . number_format($thisMonthExpense, 2))
                ->description(now()->format('F Y'))
                ->color('danger'),

            Stat::make('Avg/Month', '৳ ' . number_format($avgMonthExpense, 2))
                ->description('Average monthly expense')
                ->color('info'),

            Stat::make('Categories', $categoriesCount)
                ->description('Expense categories')
                ->color('success'),
        ];
    }
}
