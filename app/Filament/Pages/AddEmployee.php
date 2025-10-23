<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class AddEmployee extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user-plus';

    protected static \UnitEnum|string|null $navigationGroup = 'Quick Menus';

    protected static ?string $navigationLabel = 'Add Employee';

    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.pages.add-employee';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getNavigationUrl(): string
    {
        return route('filament.admin.resources.employees.create');
    }
}
