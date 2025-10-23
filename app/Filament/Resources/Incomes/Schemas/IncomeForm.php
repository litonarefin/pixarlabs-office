<?php

namespace App\Filament\Resources\Incomes\Schemas;

use App\Models\IncomeCategory;
use App\Models\PaymentMethod;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric()
                    ->prefix('৳')
                    ->default('0.00')
                    ->helperText('Enter amount in BDT')
                    ->maxValue(99999999.99)
                    ->step(0.01)
                    ->columnSpanFull(),

                Select::make('income_category_id')
                    ->label('Category')
                    ->required()
                    ->options(IncomeCategory::pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('e.g., Sales, Service, Interest')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->maxLength(500),
                    ])
                    ->columnSpanFull(),

                Section::make()
                    ->schema([
                        DatePicker::make('transaction_date')
                            ->label('Date')
                            ->required()
                            ->default(now())
                            ->native(false),

                        Textarea::make('description')
                            ->label('Notes')
                            ->placeholder('Brief description of this income...')
                            ->rows(4)
                            ->columnSpanFull(),

                        Select::make('currency')
                            ->label('Currency')
                            ->required()
                            ->options([
                                'BDT' => 'BDT',
                                'USD' => 'USD',
                            ])
                            ->default('BDT')
                            ->native(false),

                        Select::make('payment_method_id')
                            ->label('Payment Method')
                            ->required()
                            ->options(PaymentMethod::pluck('name', 'id'))
                            ->default(function () {
                                return PaymentMethod::where('name', 'Cash Payment')->first()?->id ?? 7;
                            })
                            ->searchable()
                            ->placeholder('e.g., bank, cash, mobile_banking')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('account_number')
                                    ->maxLength(255),
                            ]),

                        TextInput::make('invoice_number')
                            ->label('Account Number')
                            ->placeholder('Account number or reference')
                            ->maxLength(255),

                        TextInput::make('external_id')
                            ->label('Transaction ID')
                            ->placeholder('Transaction reference number')
                            ->helperText('Bank or payment processor transaction reference')
                            ->maxLength(255),

                        FileUpload::make('receipt_path')
                            ->label('Receipt')
                            ->image()
                            ->directory('receipts/income')
                            ->visibility('private')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->maxSize(5120) // 5MB
                            ->columnSpanFull(),

                        Hidden::make('created_by')
                            ->default(auth()->id()),

                        Hidden::make('source')
                            ->default('manual'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
