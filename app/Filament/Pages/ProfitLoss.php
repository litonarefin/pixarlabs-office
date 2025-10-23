<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class ProfitLoss extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationParentItem = 'Income/Expense';

    protected static ?string $navigationLabel = 'Profit & Loss';

    protected static ?int $navigationSort = 304;

    protected string $view = 'filament.pages.profit-loss';
}
