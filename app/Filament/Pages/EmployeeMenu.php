<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AttendanceOverviewWidget;
use App\Filament\Widgets\LeaveRequestsWidget;
use App\Filament\Widgets\TotalDepartmentsWidget;
use App\Filament\Widgets\TotalEmployeesWidget;
use BackedEnum;
use Filament\Pages\Page;

class EmployeeMenu extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Employees';

    protected static ?int $navigationSort = 500;

    protected string $view = 'filament.pages.employee-menu';

    public function getHeaderWidgets(): array
    {
        return [
            TotalEmployeesWidget::class,
            TotalDepartmentsWidget::class,
            AttendanceOverviewWidget::class,
            LeaveRequestsWidget::class,
        ];
    }
}
