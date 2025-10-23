<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class TaxBenefits extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationParentItem = 'Payroll';

    protected static ?string $navigationLabel = 'Tax & Benefits';

    protected static ?int $navigationSort = 603;

    protected string $view = 'filament.pages.tax-benefits';
}
