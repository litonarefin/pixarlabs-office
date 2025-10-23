<?php

namespace App\Filament\Resources\Incomes\Widgets;

use App\Models\Income;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class IncomeChartWidget extends ChartWidget
{
    protected ?string $heading = 'Income Trend - Last 6 Months';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $now = now();
        $months = [];
        $incomeData = [];

        // Get last 6 months data
        for ($i = 5; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $monthName = $date->format('M Y');
            $months[] = $monthName;

            $income = Income::whereYear('transaction_date', $date->year)
                ->whereMonth('transaction_date', $date->month)
                ->sum('amount_in_bdt');

            $incomeData[] = round($income, 2);
        }

        // Calculate average
        $average = count($incomeData) > 0 ? array_sum($incomeData) / count($incomeData) : 0;
        $averageData = array_fill(0, count($incomeData), round($average, 2));

        return [
            'datasets' => [
                [
                    'label' => 'Monthly Income',
                    'data' => $incomeData,
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
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
