<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class SlackIntegration extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationParentItem = 'API Integrations';

    protected static ?string $navigationLabel = 'Slack';

    protected static ?int $navigationSort = 801;

    protected string $view = 'filament.pages.slack-integration';
}
