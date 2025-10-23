<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class WhatsappIntegration extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationParentItem = 'API Integrations';

    protected static ?string $navigationLabel = 'WhatsApp';

    protected static ?int $navigationSort = 802;

    protected string $view = 'filament.pages.whatsapp-integration';
}
