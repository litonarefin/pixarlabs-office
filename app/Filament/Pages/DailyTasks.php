<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class DailyTasks extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationParentItem = 'Employees';

    protected static ?string $navigationLabel = 'Daily Tasks';

    protected static ?int $navigationSort = 506;

    protected string $view = 'filament.pages.daily-tasks';
}
