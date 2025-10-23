<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Expenses\Schemas\ExpenseForm;
use App\Models\Expense;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Enums\IconPosition;

class AddExpense extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-credit-card';

    protected static \UnitEnum|string|null $navigationGroup = 'Quick Menus';

    protected static ?string $navigationLabel = 'Add Expense';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.add-expense';

    public function mount(): void
    {
        // Automatically show the modal when page loads
        $this->dispatch('open-modal', id: 'add-expense-modal');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('addExpense')
                ->label('Add Expense')
                ->icon('heroicon-o-plus')
                ->iconPosition(IconPosition::Before)
                ->modalHeading('Add Expense')
                ->modalDescription('Quick entry for expense records')
                ->modalWidth('3xl')
                ->form(fn () => ExpenseForm::configure(new \Filament\Schemas\Schema)->getComponents())
                ->action(function (array $data) {
                    Expense::create($data);

                    \Filament\Notifications\Notification::make()
                        ->title('Expense record created successfully')
                        ->success()
                        ->send();

                    return redirect()->route('filament.admin.resources.expenses.index');
                })
                ->modalSubmitActionLabel('Add Expense'),
        ];
    }
}
