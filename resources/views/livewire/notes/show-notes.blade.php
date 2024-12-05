<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    
    public function delete($noteId)
    {
        // dd($noteId);
        $note = Note::where('id', $noteId)->first();
        // dd($note);
        $this->authorize('delete', $note);
        $note->delete();
    }

    // from flowbite
    public function placeholder()
    {
        return trim('
            <div class="text-center">
                <div role="status">
                    <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        ');
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
                            <a href="{{ route('notes.edit', $note) }}" wire:navigate class="py-2 text-xl font-bold hover:underline hover:text-blue-500">
                                {{ $note->title }}
                            </a>
                            {{-- <p>{{ Str::limit($note->body, 20) }}</p> --}}
                            <p>{{ str($note->body)->words(5) }}</p>
                        </div>
                        <div class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('M/d/Y') }}
                        </div>
                    </div>
                    <span class="badge {{ $note->is_published ? 'badge-success' : 'badge-error' }}">
                        {{ $note->is_published ? 'Yes' : 'No' }}
                    </span>
                    <div class="flex items-end justify-between mt-4 space-x-1">
                        <p class="text-xs text-gray-300">Destinatário: 
                            <span class="font-semibold text-gray-100">
                                {{ $note->recipient }}
                            </span>
                        </p>
                        <div>
                            <x-mary-button href="{{ route('notes.edit', $note) }}" wire:navigate icon="o-eye" class="w-12 h-2 bg-transparent hover:bg-transparent btn-circle" />
                            <x-mary-button icon="o-trash" wire:click="delete('{{ $note->id }}')" class="w-12 h-2 bg-transparent hover:bg-transparent btn-circle" />
                        </div>
                    </div>
                </x-mary-card>
                @endforeach
            </div>
        </div>
    @endif
    
</div>
