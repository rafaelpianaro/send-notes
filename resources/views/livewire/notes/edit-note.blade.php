<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;
use Carbon\Carbon;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        // $this->noteSendDate = $note->send_date;
        $this->noteSendDate = $note->send_date ? Carbon::parse($note->send_date)->format('Y-m-d') : null;
        $this->noteIsPublished = $note->is_published;
        // dd($this->noteSendDate);
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ],[
            'noteTitle.required' => 'O título da nota é obrigatório.',
            'noteTitle.min' => 'O título da nota deve ter pelo menos :min caracteres.',
            'noteBody.required' => 'O corpo da nota é obrigatório.',
            'noteBody.min' => 'O corpo da nota deve ter pelo menos :min caracteres.',
            'noteRecipient.required' => 'O destinatário da nota é obrigatório.',
            'noteRecipient.email' => 'Por favor, insira um endereço de e-mail válido.',
            'noteSendDate.required' => 'A data de envio da nota é obrigatória.',
            'noteSendDate.date' => 'Por favor, insira uma data válida.',
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

        $this->dispatch('note-saved');
    }
}; ?>

<div class="py-12">
    <div class="max-w-2xl mx-auto space-y-4 sm:px-6 lg:px-8">
        <form wire:submit='saveNote' class="space-y-4">
            <x-mary-input wire:model="noteTitle" label="Note Title" placeholder="It's been a great day." />
            <x-mary-textarea wire:model="noteBody" label="Sua anotação"
                placeholder="Share all your thoughts with your friend." />
            <x-mary-input icon="o-user" wire:model="noteRecipient" label="Destinatário" placeholder="yourfriend@email.com"
                type="email" />
            <x-mary-input icon="o-calendar" wire:model="noteSendDate" type="date" label="Data de Envio" />
            <x-mary-checkbox label="Note Published" wire:model='noteIsPublished' />
            <div class="flex justify-between pt-4">
                <x-mary-button type="submit" spinner="saveNote" class="btn-success">Salvar Anotação</x-mary-button>
                <x-mary-button href="{{ route('notes.index') }}" class="btn-outline" wire:navigate flat negative>Voltar para Anotações</x-mary-button>
            </div>
            <x-action-message on="note-saved" />
            {{-- <x-mary-errors /> --}}
        </form>
    </div>
</div>
