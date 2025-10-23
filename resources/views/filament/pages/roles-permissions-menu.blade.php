<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Roles & Permissions Menu Quick Links --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <a href="{{ route('filament.admin.resources.roles.index') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-primary-100 rounded-lg">
                            <x-heroicon-o-user-group class="w-6 h-6 text-primary-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Roles</h3>
                            <p class="text-sm text-gray-600">Manage user roles</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="{{ route('filament.admin.resources.permissions.index') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-info-100 rounded-lg">
                            <x-heroicon-o-key class="w-6 h-6 text-info-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Permissions</h3>
                            <p class="text-sm text-gray-600">Manage permissions</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="/admin/user-roles" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-success-100 rounded-lg">
                            <x-heroicon-o-users class="w-6 h-6 text-success-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">User Roles</h3>
                            <p class="text-sm text-gray-600">Assign roles to users</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            <a href="/admin/role-permissions" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-warning-100 rounded-lg">
                            <x-heroicon-o-lock-closed class="w-6 h-6 text-warning-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Role Permissions</h3>
                            <p class="text-sm text-gray-600">Assign permissions to roles</p>
                        </div>
                    </div>
                </x-filament::card>
            </a>
        </div>
    </div>
</x-filament-panels::page>
