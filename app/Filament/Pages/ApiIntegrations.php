<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class ApiIntegrations extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationLabel = 'API Integrations';

    protected static ?int $navigationSort = 800;

    protected string $view = 'filament.pages.api-integrations';
}
