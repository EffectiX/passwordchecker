<div>
    @if(!empty($scoreMessage ?? null))
        <div class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md p-4 mt-2">
            <div class="flex justify-between items-center mb-2">
                <div class="text-sm text-gray-500 dark:text-gray-400 font-semibold">
                    {{ __('effectix/password-checker::livewire.title') }}
                </div>
            </div>

            <div class="relative pt-1">
                <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2 overflow-hidden relative">
                    <div class="absolute top-0 left-0 h-2 rounded-full transition-all duration-500 {{ $barColor }}"
                    style="width: {{$barWidth}}%;"></div>
                </div>

                <div class="mt-2 text-sm text-gray-800 dark:text-gray-300">
                    {{ $scoreMessage }}
                </div>
            </div>
        </div>
    @endif
</div>
