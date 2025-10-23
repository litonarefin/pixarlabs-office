<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class ExpenseClaims extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Expense Claims';

    protected static ?int $navigationSort = 706;

    protected string $view = 'filament.pages.expense-claims';
}
