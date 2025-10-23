<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class FreemiusIntegration extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationParentItem = 'API Integrations';

    protected static ?string $navigationLabel = 'Freemius';

    protected static ?int $navigationSort = 804;

    protected string $view = 'filament.pages.freemius-integration';
}
