<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalDepartmentsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $totalDepartments = Department::count();

        // Get department with most employees
        $largestDept = Department::withCount('employees')
            ->orderBy('employees_count', 'desc')
            ->first();

        // Get average employees per department
        $avgEmployeesPerDept = $totalDepartments > 0
            ? round(Employee::where('status', 'active')->count() / $totalDepartments, 1)
            : 0;

        return [
            Stat::make('Total Departments', $totalDepartments)
                ->description('Active departments')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info'),

            Stat::make('Largest Department', $largestDept ? $largestDept->name : 'N/A')
                ->description($largestDept ? "{$largestDept->employees_count} employees" : 'No departments')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),

            Stat::make('Avg per Department', $avgEmployeesPerDept)
                ->description('Employees per department')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('warning'),
        ];
    }
}
