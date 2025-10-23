<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Performance extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Performance';

    protected static ?int $navigationSort = 704;

    protected string $view = 'filament.pages.performance';
}
