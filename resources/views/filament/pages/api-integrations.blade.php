<x-filament-panels::page>
    <div class="space-y-6">
        {{-- API Integrations Header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">API Integrations</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage your third-party integrations and API connections</p>
        </div>

        {{-- Integration Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Slack Integration --}}
            <a href="{{ route('filament.admin.pages.slack-integration') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M5.042 15.165a2.528 2.528 0 0 1-2.52 2.523A2.528 2.528 0 0 1 0 15.165a2.527 2.527 0 0 1 2.522-2.52h2.52v2.52zM6.313 15.165a2.527 2.527 0 0 1 2.521-2.52 2.527 2.527 0 0 1 2.521 2.52v6.313A2.528 2.528 0 0 1 8.834 24a2.528 2.528 0 0 1-2.521-2.522v-6.313zM8.834 5.042a2.528 2.528 0 0 1-2.521-2.52A2.528 2.528 0 0 1 8.834 0a2.528 2.528 0 0 1 2.521 2.522v2.52H8.834zM8.834 6.313a2.528 2.528 0 0 1 2.521 2.521 2.528 2.528 0 0 1-2.521 2.521H2.522A2.528 2.528 0 0 1 0 8.834a2.528 2.528 0 0 1 2.522-2.521h6.312zM18.956 8.834a2.528 2.528 0 0 1 2.522-2.521A2.528 2.528 0 0 1 24 8.834a2.528 2.528 0 0 1-2.522 2.521h-2.522V8.834zM17.688 8.834a2.528 2.528 0 0 1-2.523 2.521 2.527 2.527 0 0 1-2.52-2.521V2.522A2.527 2.527 0 0 1 15.165 0a2.528 2.528 0 0 1 2.523 2.522v6.312zM15.165 18.956a2.528 2.528 0 0 1 2.523 2.522A2.528 2.528 0 0 1 15.165 24a2.527 2.527 0 0 1-2.52-2.522v-2.522h2.52zM15.165 17.688a2.527 2.527 0 0 1-2.52-2.523 2.526 2.526 0 0 1 2.52-2.52h6.313A2.527 2.527 0 0 1 24 15.165a2.528 2.528 0 0 1-2.522 2.523h-6.313z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Slack</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Attendance tracking and daily updates</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Connected
                                </span>
                            </div>
                            <div class="mt-3 space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <p>• #signin-out channel</p>
                                <p>• #daily-updates channel</p>
                            </div>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            {{-- WhatsApp Integration --}}
            <a href="{{ route('filament.admin.pages.whatsapp-integration') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">WhatsApp</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Income & expense logging</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Connected
                                </span>
                            </div>
                            <div class="mt-3 space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <p>• Receipt uploads</p>
                                <p>• Quick transactions</p>
                            </div>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            {{-- Google Drive Integration --}}
            <a href="{{ route('filament.admin.pages.google-drive-integration') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.71 3.5L1.15 15l3.42 5.5L12 12.5 7.71 3.5zM12 12.5l4.29 8.5h6.84L12 3.5 7.71 12.5H12zM12 12.5L7.71 3.5 12 0l4.29 3.5L12 12.5z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Google Drive</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Receipt storage & backups</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    Connected
                                </span>
                            </div>
                            <div class="mt-3 space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <p>• Automated daily backups</p>
                                <p>• 7-day retention</p>
                            </div>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            {{-- Freemius Integration --}}
            <a href="{{ route('filament.admin.pages.freemius-integration') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Freemius</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Product income tracking</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    Pending Setup
                                </span>
                            </div>
                            <div class="mt-3 space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <p>• Product sales tracking</p>
                                <p>• Revenue analytics</p>
                            </div>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            {{-- Paddle Integration --}}
            <a href="{{ route('filament.admin.pages.paddle-integration') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="p-3 bg-orange-100 dark:bg-orange-900 rounded-lg">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Paddle</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Payment processing</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    Pending Setup
                                </span>
                            </div>
                            <div class="mt-3 space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <p>• Transaction sync</p>
                                <p>• Income tracking</p>
                            </div>
                        </div>
                    </div>
                </x-filament::card>
            </a>

            {{-- Internal API (bo.jeweltheme.com) --}}
            <a href="{{ route('filament.admin.pages.internal-api-integration') }}" class="block">
                <x-filament::card class="hover:shadow-lg transition-shadow duration-200">
                    <div class="flex items-start space-x-4">
                        <div class="p-3 bg-pink-100 dark:bg-pink-900 rounded-lg">
                            <svg class="w-8 h-8 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Internal API</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">bo.jeweltheme.com</p>
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    Pending Setup
                                </span>
                            </div>
                            <div class="mt-3 space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <p>• Internal income tracking</p>
                                <p>• Custom reports</p>
                            </div>
                        </div>
                    </div>
                </x-filament::card>
            </a>

        </div>

        {{-- Configuration Notice --}}
        <div class="mt-8">
            <x-filament::card>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">Integration Configuration</h4>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Configure your API integrations in the <code class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs">.env</code> file.
                            Refer to <code class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs">CLAUDE.md</code> for setup instructions.
                        </p>
                    </div>
                </div>
            </x-filament::card>
        </div>
    </div>
</x-filament-panels::page>
