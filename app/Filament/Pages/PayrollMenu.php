<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class PayrollMenu extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Payroll';

    protected static ?int $navigationSort = 600;

    protected string $view = 'filament.pages.payroll-menu';
}
