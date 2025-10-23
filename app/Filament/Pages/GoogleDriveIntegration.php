<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class GoogleDriveIntegration extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cloud';

    protected static ?string $navigationParentItem = 'API Integrations';

    protected static ?string $navigationLabel = 'Google Drive';

    protected static ?int $navigationSort = 803;

    protected string $view = 'filament.pages.google-drive-integration';
}
