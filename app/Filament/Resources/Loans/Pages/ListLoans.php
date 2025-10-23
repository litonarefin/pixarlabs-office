<?php

namespace App\Filament\Resources\Loans\Pages;

use App\Filament\Resources\Loans\LoanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\IconPosition;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;

    protected static ?string $title = 'Loans Overview';

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('managePaymentMethods')
                ->label('Payment Methods')
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

            CreateAction::make()
                ->label('Add Loan')
                ->icon('heroicon-o-plus')
                ->iconPosition(IconPosition::Before)
                ->modalHeading('Add Loan')
                ->modalDescription('Quick entry for loan records')
                ->modalWidth('3xl')
                ->modalSubmitActionLabel('Add Loan')
                ->successNotificationTitle('Loan record created successfully')
                ->using(function (array $data): \App\Models\Loan {
                    return \App\Models\Loan::create($data);
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Loans Overview';
    }
}
