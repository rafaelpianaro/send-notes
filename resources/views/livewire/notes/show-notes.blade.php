<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    
    public function delete($noteId)
    {
        // dd($noteId);
        $note = Note::where('id', $noteId)->first();
        // dd($note);
        $note->delete();
    }

    public function with(): array
    {
        return [
        'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    {{-- <p>hello {{ $notes }}</p> --}}
    {{-- @foreach ($notes as $note)
    <ul>
        <li>
            {{ $note->title }}
        </li>
    </ul>
    @endforeach --}}
    @if ($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">Ainda sem anotações</p>
            <p class="text-xl font-bold">Aproveite para criar seu primeiro envio de anotação.</p>
            <x-mary-button icon-right="o-plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>
                Criar anotação
            </x-mary-button>
        </div>
    @else
        <x-mary-button icon-right="o-plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>
            Criar anotação
        </x-mary-button>
        <div class="mt-12">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                @foreach ($notes as $note)
                <x-mary-card wire:key='{{ $note->id }}' shadow>
                    <div class="flex justify-between">
                        <div>
                            <a href="#" class="py-2 text-xl font-bold hover:underline hover:text-blue-500">
                                {{ $note->title }}
                            </a>
                            {{-- <p>{{ Str::limit($note->body, 20) }}</p> --}}
                            <p>{{ str($note->body)->words(5) }}</p>
                        </div>
                        <div class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('M/d/Y') }}
                        </div>
                    </div>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs text-gray-300">Destinatário: 
                            <span class="font-semibold text-gray-100">
                                {{ $note->recipient }}
                            </span>
                        </p>
                        <div>
                            <x-mary-button icon="o-eye" class="w-12 h-2 bg-transparent hover:bg-transparent btn-circle" />
                            <x-mary-button icon="o-trash" wire:click="delete('{{ $note->id }}')" class="w-12 h-2 bg-transparent hover:bg-transparent btn-circle" />
                        </div>
                    </div>
                </x-mary-card>
                @endforeach
            </div>
        </div>
    @endif
    
</div>
