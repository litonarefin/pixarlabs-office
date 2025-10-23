<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalEmployeesWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalEmployees = Employee::where('status', 'active')->count();
        $newThisMonth = Employee::where('status', 'active')
            ->whereMonth('joining_date', now()->month)
            ->whereYear('joining_date', now()->year)
            ->count();
        $inactiveEmployees = Employee::where('status', 'inactive')->count();

        return [
            Stat::make('Total Employees', $totalEmployees)
                ->description($newThisMonth > 0 ? "{$newThisMonth} new this month" : 'No new joinings')
                ->descriptionIcon($newThisMonth > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-minus')
                ->color('success')
                ->chart([7, 5, 10, 5, 12, 4, $totalEmployees]),

            Stat::make('Active Employees', $totalEmployees)
                ->description('Currently working')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Inactive Employees', $inactiveEmployees)
                ->description('Not currently active')
                ->descriptionIcon('heroicon-m-user-minus')
                ->color('warning'),
        ];
    }
}
