<?php

namespace App\Filament\Resources\Expenses\Pages;

use App\Filament\Resources\Expenses\ExpenseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\IconPosition;

class ListExpenses extends ListRecords
{
    protected static string $resource = ExpenseResource::class;

    protected static ?string $title = 'Expense Overview';

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
                ->modalHeading('Manage Expense Categories')
                ->modalDescription('Add or edit expense categories')
                ->modalWidth('2xl')
                ->form([
                    \Filament\Forms\Components\Repeater::make('categories')
                        ->label('')
                        ->schema([
                            \Filament\Forms\Components\TextInput::make('name')
                                ->label('Category Name')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g., Office Rent, Marketing, Software'),
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
                            return \App\Models\ExpenseCategory::all()
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
                    \App\Models\ExpenseCategory::whereNotIn('id', $existingIds)->delete();

                    // Update or create categories
                    foreach ($data['categories'] ?? [] as $categoryData) {
                        if (!empty($categoryData['id'])) {
                            // Update existing
                            \App\Models\ExpenseCategory::where('id', $categoryData['id'])
                                ->update([
                                    'name' => $categoryData['name'],
                                    'description' => $categoryData['description'] ?? null,
                                ]);
                        } else {
                            // Create new
                            \App\Models\ExpenseCategory::create([
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
                ->label('Add Expense')
                ->icon('heroicon-o-plus')
                ->iconPosition(IconPosition::Before)
                ->modalHeading('Add Expense')
                ->modalDescription('Quick entry for expense records')
                ->modalWidth('3xl')
                ->modalSubmitActionLabel('Add Expense')
                ->successNotificationTitle('Expense record created successfully')
                ->using(function (array $data): \App\Models\Expense {
                    return \App\Models\Expense::create($data);
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\Expenses\Widgets\ExpenseOverviewWidget::class,
            \App\Filament\Resources\Expenses\Widgets\ExpenseChartWidget::class,
            \App\Filament\Resources\Expenses\Widgets\ExpenseByCategoryWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return [
            'md' => 2,
            'xl' => 4,
        ];
    }

    public function getTitle(): string
    {
        return 'Expense Overview';
    }
}
