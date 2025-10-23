<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class PaddleIntegration extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationParentItem = 'API Integrations';

    protected static ?string $navigationLabel = 'Paddle';

    protected static ?int $navigationSort = 805;

    protected string $view = 'filament.pages.paddle-integration';
}
