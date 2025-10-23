<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Payslips extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationParentItem = 'Payroll';

    protected static ?string $navigationLabel = 'Payslips';

    protected static ?int $navigationSort = 604;

    protected string $view = 'filament.pages.payslips';
}
