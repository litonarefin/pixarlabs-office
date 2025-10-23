<?php

namespace App\Filament\Resources\Incomes\Widgets;

use App\Models\Income;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IncomeOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Total income (all time)
        $totalIncome = Income::sum('amount_in_bdt');

        // This month's income
        $thisMonthIncome = Income::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount_in_bdt');

        return [
            Stat::make('Total', '৳ ' . number_format($totalIncome, 2))
                ->description('All time income')
                ->color('success'),

            Stat::make('This Month', '৳ ' . number_format($thisMonthIncome, 2))
                ->description(now()->format('F Y'))
                ->color('success'),
        ];
    }
}
