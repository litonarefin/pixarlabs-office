<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class WebTraffics extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationParentItem = 'Dashboard';

    protected static ?string $navigationLabel = 'Web Traffics';

    protected static ?int $navigationSort = 103;

    protected string $view = 'filament.pages.web-traffics';
}
