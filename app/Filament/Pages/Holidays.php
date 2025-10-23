<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Holidays extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Holidays';

    protected static ?int $navigationSort = 705;

    protected string $view = 'filament.pages.holidays';
}
