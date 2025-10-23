<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Payroll Menu Quick Links --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <a href="{{ route('filament.admin.pages.salary-payout') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-primary-100 rounded-lg">
                            <x-heroicon-o-banknotes class="w-6 h-6 text-primary-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Salary Payout</h3>
                            <p class="text-sm text-gray-600">Manage salary disbursements</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.tax-benefits') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-info-100 rounded-lg">
                            <x-heroicon-o-document-text class="w-6 h-6 text-info-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Tax & Benefits</h3>
                            <p class="text-sm text-gray-600">Manage tax and benefits</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.payslips') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-success-100 rounded-lg">
                            <x-heroicon-o-newspaper class="w-6 h-6 text-success-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Payslips</h3>
                            <p class="text-sm text-gray-600">Generate payslips</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.loans-advances') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-warning-100 rounded-lg">
                            <x-heroicon-o-currency-dollar class="w-6 h-6 text-warning-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Loans & Advances</h3>
                            <p class="text-sm text-gray-600">Track loans and advances</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.notices') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <x-heroicon-o-megaphone class="w-6 h-6 text-purple-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Notices</h3>
                            <p class="text-sm text-gray-600">Company announcements</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.pages.shift-management') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-indigo-100 rounded-lg">
                            <x-heroicon-o-clock class="w-6 h-6 text-indigo-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Shift Management</h3>
                            <p class="text-sm text-gray-600">Manage work shifts</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>
        </div>
    </div>
</x-filament-panels::page>
