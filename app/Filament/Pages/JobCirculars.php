<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class JobCirculars extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Job Circulars';

    protected static ?int $navigationSort = 707;

    protected string $view = 'filament.pages.job-circulars';
}
