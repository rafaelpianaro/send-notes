<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Criar Anotações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <x-mary-button icon="o-arrow-long-left" class="mb-8" href="{{ route('notes.index') }}" wire:navigate>
                    Todas as Anotações
                </x-mary-button>
                <livewire:notes.create-note />
            </div>
        </div>
    </div>
</x-app-layout>
