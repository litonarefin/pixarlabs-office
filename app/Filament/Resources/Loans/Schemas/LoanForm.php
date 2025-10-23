<?php

namespace App\Filament\Resources\Loans\Schemas;

use App\Models\Employee;
use App\Models\PaymentMethod;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->label('Loan Amount')
                    ->required()
                    ->numeric()
                    ->prefix('৳')
                    ->default('0.00')
                    ->helperText('Enter amount in BDT or USD')
                    ->maxValue(99999999.99)
                    ->step(0.01)
                    ->columnSpanFull(),

                Section::make()
                    ->schema([
                        Select::make('loan_type')
                            ->label('Loan Type')
                            ->required()
                            ->options([
                                'personal' => 'Personal',
                                'office' => 'Office',
                                'employee' => 'Employee',
                            ])
                            ->default('office')
                            ->native(false),

                        Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'disbursed' => 'Disbursed',
                                'repaid' => 'Repaid',
                                'defaulted' => 'Defaulted',
                            ])
                            ->default('pending')
                            ->native(false),

                        DatePicker::make('loan_date')
                            ->label('Loan Date')
                            ->required()
                            ->default(now())
                            ->native(false),

                        DatePicker::make('due_date')
                            ->label('Due Date')
                            ->native(false),

                        Select::make('currency')
                            ->label('Currency')
                            ->required()
                            ->options([
                                'BDT' => 'BDT',
                                'USD' => 'USD',
                            ])
                            ->default('BDT')
                            ->native(false),

                        TextInput::make('interest_rate')
                            ->label('Interest Rate (%)')
                            ->numeric()
                            ->suffix('%')
                            ->default(0)
                            ->maxValue(100)
                            ->step(0.01),

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

                        Select::make('employee_id')
                            ->label('Employee')
                            ->options(Employee::pluck('name', 'id'))
                            ->searchable()
                            ->placeholder('Select employee (if employee loan)')
                            ->nullable(),

                        Select::make('lender_id')
                            ->label('Lender')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->placeholder('Who gave the loan?')
                            ->nullable(),

                        Select::make('borrower_id')
                            ->label('Borrower')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->placeholder('Who received the loan?')
                            ->nullable(),

                        TextInput::make('reference_number')
                            ->label('Reference Number')
                            ->placeholder('Loan reference number')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Notes')
                            ->placeholder('Brief description of this loan...')
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('document_path')
                            ->label('Document')
                            ->image()
                            ->directory('documents/loans')
                            ->visibility('private')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->maxSize(5120) // 5MB
                            ->columnSpanFull(),

                        Hidden::make('created_by')
                            ->default(auth()->id()),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
