<?php

namespace App\Filament\Resources\Expenses\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;

class ExpenseChartWidget extends ChartWidget
{
    protected ?string $heading = 'Expense Trend - Last 6 Months';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $now = now();
        $months = [];
        $expenseData = [];

        // Get last 6 months data
        for ($i = 5; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $monthName = $date->format('M Y');
            $months[] = $monthName;

            $expense = Expense::whereYear('transaction_date', $date->year)
                ->whereMonth('transaction_date', $date->month)
                ->sum('amount_in_bdt');

            $expenseData[] = round($expense, 2);
        }

        // Calculate average
        $average = count($expenseData) > 0 ? array_sum($expenseData) / count($expenseData) : 0;
        $averageData = array_fill(0, count($expenseData), round($average, 2));

        return [
            'datasets' => [
                [
                    'label' => 'Monthly Expense',
                    'data' => $expenseData,
                    'borderColor' => 'rgb(239, 68, 68)',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Average',
                    'data' => $averageData,
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderDash' => [5, 5],
                    'fill' => false,
                    'tension' => 0,
                    'pointRadius' => 0,
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
            'maintainAspectRatio' => false,
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

    public function getHeight(): ?int
    {
        return 120;
    }
}
