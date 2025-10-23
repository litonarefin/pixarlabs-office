<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class ResignationManagement extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-arrow-right-start-on-rectangle';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Resignation Management';

    protected static ?int $navigationSort = 710;

    protected string $view = 'filament.pages.resignation-management';
}
