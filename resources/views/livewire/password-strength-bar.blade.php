<div class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl p-4 mt-2">
    <div class="flex justify-between items-center mb-2">
        <div class="text-sm text-gray-500 dark:text-gray-400 font-semibold">
            {{ __('effectix/password-checker::livewire.title') }}
        </div>
    </div>

    <div class="relative pt-1">
        <!-- Pill-shaped progress bar -->
        <div class="flex mb-2">
            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                <!-- Dynamically apply the color of the progress bar based on the score -->
                <div class="h-2 rounded-full transition-all duration-500"
                     style="width: {{ $score }}%;"
                     class="{{ $barColor }}">
                </div>
            </div>
        </div>

        <!-- Label with strength message, shown next to the bar -->
        <div class="w-full">
            <div class="relative w-full rounded-full h-2.5">
                <div class="w-full h-full rounded-full {{ $barColor }}"></div>
                <div class="absolute top-0 left-0 w-full text-center text-white py-1">
                    <span>{{ $scoreIcon }}</span> <!-- Display the icon here -->
                    <span>{{ $scoreMessage }}</span> <!-- Display the message here -->
                </div>
            </div>
        </div>
    </div>
</div>