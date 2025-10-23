<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class LoansAdvances extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationParentItem = 'Payroll';

    protected static ?string $navigationLabel = 'Loans & Advances';

    protected static ?int $navigationSort = 605;

    protected string $view = 'filament.pages.loans-advances';
}
