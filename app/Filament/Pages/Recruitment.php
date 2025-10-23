<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Recruitment extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Recruitment';

    protected static ?int $navigationSort = 702;

    protected string $view = 'filament.pages.recruitment';
}
