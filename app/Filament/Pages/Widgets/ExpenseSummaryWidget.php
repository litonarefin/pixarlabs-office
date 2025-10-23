<?php

namespace App\Filament\Pages\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExpenseSummaryWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        // Total expense (all time)
        $totalExpense = Expense::sum('amount_in_bdt');

        // This month's expense
        $thisMonthExpense = Expense::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount_in_bdt');

        // Last month's expense
        $lastMonthExpense = Expense::whereMonth('transaction_date', now()->subMonth()->month)
            ->whereYear('transaction_date', now()->subMonth()->year)
            ->sum('amount_in_bdt');

        // Calculate percentage change
        $percentageChange = $lastMonthExpense > 0
            ? (($thisMonthExpense - $lastMonthExpense) / $lastMonthExpense) * 100
            : 0;

        return [
            Stat::make('Total Expense', '৳ ' . number_format($totalExpense, 2))
                ->description('All time expense')
                ->descriptionIcon('heroicon-o-arrow-trending-down')
                ->color('danger')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('This Month', '৳ ' . number_format($thisMonthExpense, 2))
                ->description(now()->format('F Y'))
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-o-arrow-up' : 'heroicon-o-arrow-down')
                ->color($percentageChange >= 0 ? 'danger' : 'success'),

            Stat::make('Last Month', '৳ ' . number_format($lastMonthExpense, 2))
                ->description(now()->subMonth()->format('F Y'))
                ->color('info'),
        ];
    }
}
