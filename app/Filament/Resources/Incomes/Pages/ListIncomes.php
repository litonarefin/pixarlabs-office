<?php

namespace App\Filament\Resources\Incomes\Pages;

use App\Filament\Resources\Incomes\IncomeResource;
use App\Models\Income;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\IconPosition;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;

    protected static ?string $title = 'Income Records';

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('managePaymentMethods')
                ->label('Manage Payment Methods')
                ->icon('heroicon-o-credit-card')
                ->iconPosition(IconPosition::Before)
                ->color('gray')
                ->modalHeading('Manage Payment Methods')
                ->modalDescription('Add or edit payment methods')
                ->modalWidth('2xl')
                ->form([
                    \Filament\Forms\Components\Repeater::make('payment_methods')
                        ->label('')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('name')
                                ->label('Payment Method Name')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g., City Bank, BKash, Cash'),
                            \Filament\Forms\Components\TextInput::make('account_number')
                                ->label('Account Number')
                                ->maxLength(255)
                                ->placeholder('Optional account number'),
                            \Filament\Forms\Components\Hidden::make('id'),
                        ])
                        ->columns(1)
                        ->defaultItems(0)
                        ->addActionLabel('Add Payment Method')
                        ->reorderable(false)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'New Payment Method')
                        ->default(function () {
                            return \App\Models\PaymentMethod::all()
                                ->map(fn ($method) => [
                                    'id' => $method->id,
                                    'name' => $method->name,
                                    'account_number' => $method->account_number,
                                ])
                                ->toArray();
                        }),
                ])
                ->action(function (array $data) {
                    // Get existing payment method IDs
                    $existingIds = collect($data['payment_methods'] ?? [])
                        ->pluck('id')
                        ->filter()
                        ->toArray();

                    // Delete payment methods that were removed
                    \App\Models\PaymentMethod::whereNotIn('id', $existingIds)->delete();

                    // Update or create payment methods
                    foreach ($data['payment_methods'] ?? [] as $methodData) {
                        if (!empty($methodData['id'])) {
                            // Update existing
                            \App\Models\PaymentMethod::where('id', $methodData['id'])
                                ->update([
                                    'name' => $methodData['name'],
                                    'account_number' => $methodData['account_number'] ?? null,
                                ]);
                        } else {
                            // Create new
                            \App\Models\PaymentMethod::create([
                                'name' => $methodData['name'],
                                'account_number' => $methodData['account_number'] ?? null,
                                'type' => 'bank', // Default to bank type
                                'is_active' => true,
                            ]);
                        }
                    }

                    \Filament\Notifications\Notification::make()
                        ->title('Payment methods updated successfully')
                        ->success()
                        ->send();
                })
                ->modalSubmitActionLabel('Save Payment Methods')
                ->modalCancelActionLabel('Cancel'),

            \Filament\Actions\Action::make('manageCategories')
                ->label('Manage Categories')
                ->icon('heroicon-o-tag')
                ->iconPosition(IconPosition::Before)
                ->color('gray')
                ->modalHeading('Manage Income Categories')
                ->modalDescription('Add or edit income categories')
                ->modalWidth('2xl')
                ->form([
                    \Filament\Forms\Components\Repeater::make('categories')
                        ->label('')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('name')
                                ->label('Category Name')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g., Sales, Service, Interest'),
                            \Filament\Forms\Components\Textarea::make('description')
                                ->label('Description')
                                ->maxLength(500)
                                ->rows(2)
                                ->placeholder('Optional description'),
                            \Filament\Forms\Components\Hidden::make('id'),
                        ])
                        ->columns(1)
                        ->defaultItems(0)
                        ->addActionLabel('Add Category')
                        ->reorderable(false)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'New Category')
                        ->default(function () {
                            return \App\Models\IncomeCategory::all()
                                ->map(fn ($category) => [
                                    'id' => $category->id,
                                    'name' => $category->name,
                                    'description' => $category->description,
                                ])
                                ->toArray();
                        }),
                ])
                ->action(function (array $data) {
                    // Get existing category IDs
                    $existingIds = collect($data['categories'] ?? [])
                        ->pluck('id')
                        ->filter()
                        ->toArray();

                    // Delete categories that were removed
                    \App\Models\IncomeCategory::whereNotIn('id', $existingIds)->delete();

                    // Update or create categories
                    foreach ($data['categories'] ?? [] as $categoryData) {
                        if (!empty($categoryData['id'])) {
                            // Update existing
                            \App\Models\IncomeCategory::where('id', $categoryData['id'])
                                ->update([
                                    'name' => $categoryData['name'],
                                    'description' => $categoryData['description'] ?? null,
                                ]);
                        } else {
                            // Create new
                            \App\Models\IncomeCategory::create([
                                'name' => $categoryData['name'],
                                'description' => $categoryData['description'] ?? null,
                            ]);
                        }
                    }

                    \Filament\Notifications\Notification::make()
                        ->title('Categories updated successfully')
                        ->success()
                        ->send();
                })
                ->modalSubmitActionLabel('Save Categories')
                ->modalCancelActionLabel('Cancel'),

            CreateAction::make()
                ->label('Add Income')
                ->icon('heroicon-o-plus')
                ->iconPosition(IconPosition::Before)
                ->modalHeading('Add Income')
                ->modalDescription('Quick entry for income records')
                ->modalWidth('3xl')
                ->modalSubmitActionLabel('Add Income')
                ->successNotificationTitle('Income record created successfully')
                ->using(function (array $data): Income {
                    return Income::create($data);
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\Incomes\Widgets\IncomeOverviewWidget::class,
            \App\Filament\Resources\Incomes\Widgets\IncomeChartWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return [
            'md' => 2,
            'xl' => 2,
        ];
    }

    public function getTitle(): string
    {
        return 'Income Records';
    }
}
