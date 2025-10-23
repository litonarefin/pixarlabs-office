<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Notices extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationParentItem = 'Payroll';

    protected static ?string $navigationLabel = 'Notices';

    protected static ?int $navigationSort = 606;

    protected string $view = 'filament.pages.notices';
}
