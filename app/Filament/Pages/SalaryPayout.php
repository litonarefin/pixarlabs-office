<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class SalaryPayout extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationParentItem = 'Payroll';

    protected static ?string $navigationLabel = 'Salary Payout';

    protected static ?int $navigationSort = 602;

    protected string $view = 'filament.pages.salary-payout';
}
