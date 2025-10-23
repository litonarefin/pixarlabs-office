<?php

namespace App\Filament\Pages\Widgets;

use App\Models\Income;
use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProfitLossWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected function getStats(): array
    {
        // This month's income and expense
        $thisMonthIncome = Income::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount_in_bdt');

        $thisMonthExpense = Expense::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount_in_bdt');

        $thisMonthProfit = $thisMonthIncome - $thisMonthExpense;

        // Last month's profit
        $lastMonthIncome = Income::whereMonth('transaction_date', now()->subMonth()->month)
            ->whereYear('transaction_date', now()->subMonth()->year)
            ->sum('amount_in_bdt');

        $lastMonthExpense = Expense::whereMonth('transaction_date', now()->subMonth()->month)
            ->whereYear('transaction_date', now()->subMonth()->year)
            ->sum('amount_in_bdt');

        $lastMonthProfit = $lastMonthIncome - $lastMonthExpense;

        // All time profit
        $allTimeIncome = Income::sum('amount_in_bdt');
        $allTimeExpense = Expense::sum('amount_in_bdt');
        $allTimeProfit = $allTimeIncome - $allTimeExpense;

        return [
            Stat::make('Net Profit/Loss', '৳ ' . number_format($allTimeProfit, 2))
                ->description('All time')
                ->descriptionIcon($allTimeProfit >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($allTimeProfit >= 0 ? 'success' : 'danger')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('This Month', '৳ ' . number_format($thisMonthProfit, 2))
                ->description(now()->format('F Y'))
                ->descriptionIcon($thisMonthProfit >= 0 ? 'heroicon-o-arrow-up' : 'heroicon-o-arrow-down')
                ->color($thisMonthProfit >= 0 ? 'success' : 'danger'),

            Stat::make('Last Month', '৳ ' . number_format($lastMonthProfit, 2))
                ->description(now()->subMonth()->format('F Y'))
                ->descriptionIcon($lastMonthProfit >= 0 ? 'heroicon-o-arrow-up' : 'heroicon-o-arrow-down')
                ->color($lastMonthProfit >= 0 ? 'success' : 'danger'),
        ];
    }
}
