<?php

namespace App\Filament\Resources\Incomes\Tables;

use App\Models\IncomeCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IncomesTable
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
                    ->color('success'),

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
                        'freemius' => 'info',
                        'paddle' => 'warning',
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
                SelectFilter::make('income_category_id')
                    ->label('Category')
                    ->options(IncomeCategory::pluck('name', 'id'))
                    ->placeholder('e.g., Sales, Service, Interest')
                    ->searchable(),

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
            ->emptyStateHeading('No income records found')
            ->emptyStateDescription('Get started by adding your first income record.')
            ->emptyStateIcon('heroicon-o-chart-bar-square')
            ->emptyStateActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Add Income')
                    ->icon('heroicon-o-plus'),
            ]);
    }
}
