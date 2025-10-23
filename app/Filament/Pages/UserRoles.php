<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class UserRoles extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationParentItem = 'Roles & Permissions';

    protected static ?string $navigationLabel = 'User Roles';

    protected static ?int $navigationSort = 904;

    protected string $view = 'filament.pages.user-roles';
}
