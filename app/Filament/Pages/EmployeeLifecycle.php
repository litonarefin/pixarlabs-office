<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class EmployeeLifecycle extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Employee Lifecycle';

    protected static ?int $navigationSort = 703;

    protected string $view = 'filament.pages.employee-lifecycle';
}
