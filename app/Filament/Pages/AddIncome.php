<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Incomes\Schemas\IncomeForm;
use App\Models\Income;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Enums\IconPosition;

class AddIncome extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static \UnitEnum|string|null $navigationGroup = 'Quick Menus';

    protected static ?string $navigationLabel = 'Add Income';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.add-income';

    public function mount(): void
    {
        // Automatically show the modal when page loads
        $this->dispatch('open-modal', id: 'add-income-modal');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('addIncome')
                ->label('Add Income')
                ->icon('heroicon-o-plus')
                ->iconPosition(IconPosition::Before)
                ->modalHeading('Add Income')
                ->modalDescription('Quick entry for income records')
                ->modalWidth('3xl')
                ->form(fn () => IncomeForm::configure(new \Filament\Schemas\Schema)->getComponents())
                ->action(function (array $data) {
                    Income::create($data);

                    \Filament\Notifications\Notification::make()
                        ->title('Income record created successfully')
                        ->success()
                        ->send();

                    return redirect()->route('filament.admin.resources.incomes.index');
                })
                ->modalSubmitActionLabel('Add Income'),
        ];
    }
}
