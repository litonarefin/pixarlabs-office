<x-filament-panels::page>
    <div class="space-y-6">
        {{-- HR Menu Quick Links --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <a href="{{ route('filament.admin.pages.recruitment') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-primary-100 rounded-lg">
                            <x-heroicon-o-user-plus class="w-6 h-6 text-primary-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recruitment</h3>
                            <p class="text-sm text-gray-600">Manage job postings</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.employee-lifecycle') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-info-100 rounded-lg">
                            <x-heroicon-o-arrow-path class="w-6 h-6 text-info-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Employee Lifecycle</h3>
                            <p class="text-sm text-gray-600">Track employee journey</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.performance') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-success-100 rounded-lg">
                            <x-heroicon-o-chart-bar class="w-6 h-6 text-success-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Performance</h3>
                            <p class="text-sm text-gray-600">Employee performance</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.holidays') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-warning-100 rounded-lg">
                            <x-heroicon-o-calendar class="w-6 h-6 text-warning-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Holidays</h3>
                            <p class="text-sm text-gray-600">Company holidays</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.expense-claims') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <x-heroicon-o-receipt-percent class="w-6 h-6 text-purple-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Expense Claims</h3>
                            <p class="text-sm text-gray-600">Process reimbursements</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.job-circulars') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-indigo-100 rounded-lg">
                            <x-heroicon-o-briefcase class="w-6 h-6 text-indigo-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Job Circulars</h3>
                            <p class="text-sm text-gray-600">Publish job openings</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.awards-recognitions') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <x-heroicon-o-trophy class="w-6 h-6 text-yellow-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Awards & Recognitions</h3>
                            <p class="text-sm text-gray-600">Recognize achievements</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.training-development') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-pink-100 rounded-lg">
                            <x-heroicon-o-academic-cap class="w-6 h-6 text-pink-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Training & Development</h3>
                            <p class="text-sm text-gray-600">Training programs</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.resignation-management') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <x-heroicon-o-arrow-right-start-on-rectangle class="w-6 h-6 text-red-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Resignation Management</h3>
                            <p class="text-sm text-gray-600">Handle resignations</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>
        </div>
    </div>
</x-filament-panels::page>
