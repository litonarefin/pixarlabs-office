<?php

namespace App\Filament\Pages\Widgets;

use App\Models\Income;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IncomeSummaryWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Total income (all time)
        $totalIncome = Income::sum('amount_in_bdt');

        // This month's income
        $thisMonthIncome = Income::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount_in_bdt');

        // Last month's income
        $lastMonthIncome = Income::whereMonth('transaction_date', now()->subMonth()->month)
            ->whereYear('transaction_date', now()->subMonth()->year)
            ->sum('amount_in_bdt');

        // Calculate percentage change
        $percentageChange = $lastMonthIncome > 0
            ? (($thisMonthIncome - $lastMonthIncome) / $lastMonthIncome) * 100
            : 0;

        return [
            Stat::make('Total Income', '৳ ' . number_format($totalIncome, 2))
                ->description('All time income')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('This Month', '৳ ' . number_format($thisMonthIncome, 2))
                ->description(now()->format('F Y'))
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-o-arrow-up' : 'heroicon-o-arrow-down')
                ->color($percentageChange >= 0 ? 'success' : 'danger'),

            Stat::make('Last Month', '৳ ' . number_format($lastMonthIncome, 2))
                ->description(now()->subMonth()->format('F Y'))
                ->color('info'),
        ];
    }
}
