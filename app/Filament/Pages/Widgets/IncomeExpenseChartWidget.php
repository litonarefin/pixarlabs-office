<?php

namespace App\Filament\Pages\Widgets;

use App\Models\Income;
use App\Models\Expense;
use Filament\Widgets\ChartWidget;

class IncomeExpenseChartWidget extends ChartWidget
{
    protected ?string $heading = 'Income vs Expense - Last 6 Months';

    protected ?string $description = 'Comparative view of income and expense trends';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $now = now();
        $months = [];
        $incomeData = [];
        $expenseData = [];

        // Get last 6 months data
        for ($i = 5; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $monthName = $date->format('M Y');
            $months[] = $monthName;

            $income = Income::whereYear('transaction_date', $date->year)
                ->whereMonth('transaction_date', $date->month)
                ->sum('amount_in_bdt');

            $expense = Expense::whereYear('transaction_date', $date->year)
                ->whereMonth('transaction_date', $date->month)
                ->sum('amount_in_bdt');

            $incomeData[] = round($income, 2);
            $expenseData[] = round($expense, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Income',
                    'data' => $incomeData,
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Expense',
                    'data' => $expenseData,
                    'borderColor' => 'rgb(239, 68, 68)',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "৳" + value.toLocaleString(); }',
                    ],
                ],
            ],
        ];
    }
}
