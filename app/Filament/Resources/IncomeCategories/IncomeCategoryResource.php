<?php

namespace App\Filament\Resources\IncomeCategories;

use App\Filament\Resources\IncomeCategories\Pages\CreateIncomeCategory;
use App\Filament\Resources\IncomeCategories\Pages\EditIncomeCategory;
use App\Filament\Resources\IncomeCategories\Pages\ListIncomeCategories;
use App\Filament\Resources\IncomeCategories\Schemas\IncomeCategoryForm;
use App\Filament\Resources\IncomeCategories\Tables\IncomeCategoriesTable;
use App\Models\IncomeCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class IncomeCategoryResource extends Resource
{
    protected static ?string $model = IncomeCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static \UnitEnum|string|null $navigationGroup = 'Income';

    protected static ?string $navigationLabel = 'Income Categories';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return IncomeCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncomeCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIncomeCategories::route('/'),
            'create' => CreateIncomeCategory::route('/create'),
            'edit' => EditIncomeCategory::route('/{record}/edit'),
        ];
    }
}
