<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class AwardsRecognitions extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationParentItem = 'HR';

    protected static ?string $navigationLabel = 'Awards & Recognitions';

    protected static ?int $navigationSort = 708;

    protected string $view = 'filament.pages.awards-recognitions';
}
