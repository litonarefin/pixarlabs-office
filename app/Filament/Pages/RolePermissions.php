<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class RolePermissions extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-lock-closed';

    protected static ?string $navigationParentItem = 'Roles & Permissions';

    protected static ?string $navigationLabel = 'Role Permissions';

    protected static ?int $navigationSort = 905;

    protected string $view = 'filament.pages.role-permissions';
}
