<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class TrainingDevelopment extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Training & Development';

    protected static ?int $navigationSort = 709;

    protected string $view = 'filament.pages.training-development';
}
