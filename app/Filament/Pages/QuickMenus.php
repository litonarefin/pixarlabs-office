<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class QuickMenus extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationLabel = 'Quick Menus';

    protected static ?int $navigationSort = 100;

    protected static bool $shouldCollapseNavigation = false;

    protected string $view = 'filament.pages.quick-menus';

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Hide this from navigation, only show group items
    }

    public static function getNavigationUrl(): string
    {
        // Return the first child's URL as default
        return route('filament.admin.resources.incomes.create');
    }
}
