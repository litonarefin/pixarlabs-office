<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class InternalApiIntegration extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationParentItem = 'API Integrations';

    protected static ?string $navigationLabel = 'Internal API';

    protected static ?int $navigationSort = 806;

    protected string $view = 'filament.pages.internal-api-integration';
}
