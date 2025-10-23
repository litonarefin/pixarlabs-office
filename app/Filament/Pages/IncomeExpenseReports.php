<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class IncomeExpenseReports extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationParentItem = 'Dashboard';

    protected static ?string $navigationLabel = 'Income & Expense';

    protected static ?int $navigationSort = 102;

    protected string $view = 'filament.pages.income-expense-reports';
}
