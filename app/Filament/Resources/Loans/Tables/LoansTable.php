<?php

namespace App\Filament\Resources\Loans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('loan_date')
                    ->label('Loan Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('BDT')
                    ->sortable()
                    ->alignEnd(),

                TextColumn::make('loan_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'personal' => 'info',
                        'office' => 'warning',
                        'employee' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'info',
                        'disbursed' => 'primary',
                        'repaid' => 'success',
                        'defaulted' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('interest_rate')
                    ->label('Interest Rate')
                    ->suffix('%')
                    ->sortable(),

                TextColumn::make('currency')
                    ->label('Currency')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'USD' => 'info',
                        'BDT' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('due_date')
                    ->label('Due Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('employee.name')
                    ->label('Employee')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('lender.name')
                    ->label('Lender')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('borrower.name')
                    ->label('Borrower')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('paymentMethod.name')
                    ->label('Payment Method')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('reference_number')
                    ->label('Reference #')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('document_path')
                    ->label('Document')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter(),

                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->description)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('loan_type')
                    ->label('Loan Type')
                    ->options([
                        'personal' => 'Personal',
                        'office' => 'Office',
                        'employee' => 'Employee',
                    ])
                    ->placeholder('All'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'disbursed' => 'Disbursed',
                        'repaid' => 'Repaid',
                        'defaulted' => 'Defaulted',
                    ])
                    ->placeholder('All'),

                Filter::make('loan_date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')
                            ->label('From Date')
                            ->placeholder('mm/dd/yyyy')
                            ->native(false),
                        \Filament\Forms\Components\DatePicker::make('to')
                            ->label('To Date')
                            ->placeholder('mm/dd/yyyy')
                            ->native(false),
                    ])
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('loan_date', '>=', $date),
                            )
                            ->when(
                                $data['to'],
                                fn (Builder $query, $date): Builder => $query->whereDate('loan_date', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('loan_date', 'desc')
            ->emptyStateHeading('No loan records found')
            ->emptyStateDescription('Get started by adding your first loan record.')
            ->emptyStateIcon('heroicon-o-banknotes')
            ->emptyStateActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Add Loan')
                    ->icon('heroicon-o-plus'),
            ]);
    }
}
