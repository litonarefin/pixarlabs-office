<?php

namespace App\Filament\Resources\Expenses\Tables;

use App\Models\ExpenseCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('danger'),

                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->description),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('BDT')
                    ->sortable()
                    ->alignEnd(),

                TextColumn::make('expense_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'personal' => 'info',
                        'office' => 'warning',
                        'shared' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('currency')
                    ->label('Currency')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'USD' => 'info',
                        'BDT' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('paymentMethod.name')
                    ->label('Payment Method')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('invoice_number')
                    ->label('Invoice #')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('receipt_path')
                    ->label('Receipt')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter(),

                TextColumn::make('source')
                    ->label('Source')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'manual' => 'gray',
                        'slack' => 'purple',
                        'whatsapp' => 'success',
                        default => 'gray',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('expense_category_id')
                    ->label('Category')
                    ->options(ExpenseCategory::pluck('name', 'id'))
                    ->placeholder('e.g., Office Rent, Marketing, Software')
                    ->searchable(),

                SelectFilter::make('expense_type')
                    ->label('Expense Type')
                    ->options([
                        'personal' => 'Personal',
                        'office' => 'Office',
                        'shared' => 'Shared',
                    ])
                    ->placeholder('All'),

                Filter::make('transaction_date')
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
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '>=', $date),
                            )
                            ->when(
                                $data['to'],
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '<=', $date),
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
            ->defaultSort('transaction_date', 'desc')
            ->emptyStateHeading('No expense records found')
            ->emptyStateDescription('Get started by adding your first expense record.')
            ->emptyStateIcon('heroicon-o-chart-bar-square')
            ->emptyStateActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Add Expense')
                    ->icon('heroicon-o-plus'),
            ]);
    }
}

