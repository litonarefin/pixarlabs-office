<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class ShiftManagement extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationParentItem = 'Payroll';

    protected static ?string $navigationLabel = 'Shift Management';

    protected static ?int $navigationSort = 607;

    protected string $view = 'filament.pages.shift-management';
}
