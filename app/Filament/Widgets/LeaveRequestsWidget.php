<?php

namespace App\Filament\Widgets;

use App\Models\Leave;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeaveRequestsWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected function getStats(): array
    {
        // Pending leave requests
        $pendingLeaves = Leave::where('status', 'pending')->count();

        // Approved leaves this month
        $approvedThisMonth = Leave::where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Rejected leaves this month
        $rejectedThisMonth = Leave::where('status', 'rejected')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Ongoing leaves (approved and currently active)
        $ongoingLeaves = Leave::where('status', 'approved')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->count();

        return [
            Stat::make('Pending Requests', $pendingLeaves)
                ->description($pendingLeaves > 0 ? 'Awaiting approval' : 'No pending requests')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingLeaves > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.leaves.index', ['tableFilters' => ['status' => 'pending']])),

            Stat::make('Approved This Month', $approvedThisMonth)
                ->description('Leave requests approved')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Currently on Leave', $ongoingLeaves)
                ->description('Active leave periods')
                ->descriptionIcon('heroicon-m-user-minus')
                ->color('info'),
        ];
    }
}
