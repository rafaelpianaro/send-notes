<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-mary-button class="btn-primary">
                        Index 😃
                    </x-mary-button>
                    {{-- <x-mary-input label="Name" wire:model="name" /> --}}
                    {{-- <x-mary-dropdown label="Hello" class="btn-warning" right>
                        <x-mary-menu-item title="It should align correctly on right side" />
                        <x-mary-menu-item title="Yes!" />
                    </x-mary-dropdown> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
