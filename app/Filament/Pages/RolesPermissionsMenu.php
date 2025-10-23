<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class RolesPermissionsMenu extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'Roles & Permissions';

    protected static ?int $navigationSort = 900;

    protected string $view = 'filament.pages.roles-permissions-menu';
}
