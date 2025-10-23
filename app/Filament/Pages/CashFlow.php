<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class CashFlow extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationParentItem = 'Income/Expense';

    protected static ?string $navigationLabel = 'Cash Flow';

    protected static ?int $navigationSort = 305;

    protected string $view = 'filament.pages.cash-flow';
}
