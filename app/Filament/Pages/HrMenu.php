<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class HrMenu extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'HR';

    protected static ?int $navigationSort = 700;

    protected string $view = 'filament.pages.hr-menu';
}
