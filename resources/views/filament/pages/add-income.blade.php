<x-filament-panels::page>
    <div class="text-center py-12">
        <p class="text-gray-500 dark:text-gray-400">Click the "Add Income" button above to create a new income record.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-click the Add Income button when page loads
            setTimeout(function() {
                const addButton = document.querySelector('[wire\\:click*="mountAction"]');
                if (addButton) {
                    addButton.click();
                }
            }, 100);
        });
    </script>
</x-filament-panels::page>
