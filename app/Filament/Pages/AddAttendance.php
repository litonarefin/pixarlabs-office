<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class AddAttendance extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static \UnitEnum|string|null $navigationGroup = 'Quick Menus';

    protected static ?string $navigationLabel = 'Add Attendance';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.add-attendance';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getNavigationUrl(): string
    {
        return route('filament.admin.resources.attendances.create');
    }
}
