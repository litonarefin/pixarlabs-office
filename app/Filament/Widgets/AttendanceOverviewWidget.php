<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AttendanceOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected function getStats(): array
    {
        $today = now()->toDateString();
        $totalActiveEmployees = Employee::where('status', 'active')->count();

        // Today's attendance
        $presentToday = Attendance::whereDate('date', $today)
            ->where('status', 'present')
            ->count();

        $absentToday = Attendance::whereDate('date', $today)
            ->where('status', 'absent')
            ->count();

        $lateToday = Attendance::whereDate('date', $today)
            ->where('status', 'late')
            ->count();

        $onLeaveToday = Attendance::whereDate('date', $today)
            ->where('status', 'leave')
            ->count();

        // Calculate attendance percentage
        $attendancePercentage = $totalActiveEmployees > 0
            ? round(($presentToday / $totalActiveEmployees) * 100, 1)
            : 0;

        // Not marked yet
        $notMarked = $totalActiveEmployees - ($presentToday + $absentToday + $lateToday + $onLeaveToday);

        return [
            Stat::make('Present Today', $presentToday)
                ->description("{$attendancePercentage}% attendance rate")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([
                    $presentToday - 5,
                    $presentToday - 3,
                    $presentToday - 2,
                    $presentToday - 1,
                    $presentToday,
                ]),

            Stat::make('Absent Today', $absentToday)
                ->description($lateToday > 0 ? "{$lateToday} late arrivals" : 'No late arrivals')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('On Leave Today', $onLeaveToday)
                ->description($notMarked > 0 ? "{$notMarked} not marked yet" : 'All marked')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),
        ];
    }
}
