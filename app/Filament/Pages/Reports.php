<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Reports extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Income/Expense';

    protected static ?int $navigationSort = 300;

    protected static ?string $slug = 'income-expense-reports';

    protected string $view = 'filament.pages.reports';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Pages\Widgets\IncomeSummaryWidget::class,
            \App\Filament\Pages\Widgets\ExpenseSummaryWidget::class,
            \App\Filament\Pages\Widgets\ProfitLossWidget::class,
            \App\Filament\Pages\Widgets\IncomeExpenseChartWidget::class,
        ];
    }
}
