<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Employee Menu Quick Links --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <a href="{{ route('filament.admin.resources.employees.index') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-primary-100 rounded-lg">
                            <x-heroicon-o-users class="w-6 h-6 text-primary-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Employees</h3>
                            <p class="text-sm text-gray-600">Manage team members</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.resources.departments.index') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-info-100 rounded-lg">
                            <x-heroicon-o-building-office class="w-6 h-6 text-info-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Departments</h3>
                            <p class="text-sm text-gray-600">Manage departments</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.resources.attendances.index') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-success-100 rounded-lg">
                            <x-heroicon-o-calendar-days class="w-6 h-6 text-success-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Attendance</h3>
                            <p class="text-sm text-gray-600">Track attendance</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.resources.leaves.index') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-warning-100 rounded-lg">
                            <x-heroicon-o-clock class="w-6 h-6 text-warning-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Leave Requests</h3>
                            <p class="text-sm text-gray-600">Manage leave requests</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>
        </div>
    </div>
</x-filament-panels::page>
