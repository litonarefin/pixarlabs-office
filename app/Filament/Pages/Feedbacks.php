<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Feedbacks extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationParentItem = 'Employees';

    protected static ?string $navigationLabel = 'Feedbacks';

    protected static ?int $navigationSort = 505;

    protected string $view = 'filament.pages.feedbacks';
}
