<?php

namespace App\Filament\Resources\Expenses\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;

class ExpenseByCategoryWidget extends ChartWidget
{
    protected ?string $heading = 'Expenses by Category';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $expenses = Expense::with('category')
            ->selectRaw('expense_category_id, SUM(amount_in_bdt) as total')
            ->groupBy('expense_category_id')
            ->orderByDesc('total')
            ->get();

        $labels = [];
        $data = [];
        $colors = [
            'rgb(239, 68, 68)',   // red
            'rgb(251, 146, 60)',  // orange
            'rgb(250, 204, 21)',  // yellow
            'rgb(34, 197, 94)',   // green
            'rgb(59, 130, 246)',  // blue
            'rgb(147, 51, 234)',  // purple
            'rgb(236, 72, 153)',  // pink
        ];

        foreach ($expenses as $expense) {
            $labels[] = $expense->category->name ?? 'Unknown';
            $data[] = round($expense->total, 2);
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => array_slice($colors, 0, count($data)),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'right',
                ],
            ],
        ];
    }

    public function getHeight(): ?int
    {
        return 120;
    }
}
