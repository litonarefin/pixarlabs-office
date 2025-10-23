<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class WeeklyReports extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationParentItem = 'Income/Expense';

    protected static ?string $navigationLabel = 'Weekly Reports';

    protected static ?int $navigationSort = 306;

    protected string $view = 'filament.pages.weekly-reports';
}
