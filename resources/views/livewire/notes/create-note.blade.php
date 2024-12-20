<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $isDateAvailable = true; // Variável para controle da disponibilidade da data
    public $dateErrorMessage;

    // Método para verificar a disponibilidade da data em tempo real
    public function checkDateAvailability()
    {
        $formattedDate = \Carbon\Carbon::parse($this->noteSendDate)->format('Y-m-d');
        $existingNote = auth()->user()->notes()->whereDate('send_date', $formattedDate)->first();

        // Verifica se já existe uma anotação para a data
        if ($existingNote) {
            $this->isDateAvailable = false;
            $this->dateErrorMessage = 'Já existe uma anotação agendada para esta data.';
        } else {
            $this->isDateAvailable = true;
            $this->dateErrorMessage = null;
        }
    }

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:1'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ], [
            'noteTitle.required' => 'O título da nota é obrigatório.',
            'noteBody.required' => 'O corpo da nota é obrigatório.',
            'noteRecipient.required' => 'O destinatário da nota é obrigatório.',
            'noteSendDate.required' => 'A data de envio da nota é obrigatória.',
        ]);

        // Verifica se a data está disponível antes de criar a anotação
        if (!$this->isDateAvailable) {
            return;
        }

        // Criação da anotação
        auth()->user()->notes()->create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => \Carbon\Carbon::parse($this->noteSendDate)->format('Y-m-d'),
            'is_published' => false,
        ]);

        redirect(route('notes.index'));
    }
};
?>

<div>
    <form wire:submit='submit' class="space-y-4">
        <x-mary-input wire:model='noteTitle' label='Título da Anotação' placeholder="Hoje está sendo um ótimo dia."/>
        <x-mary-textarea wire:model='noteBody' label='Sua Anotação' placeholder='Compartilhar seus pensamentos' />
        <x-mary-input icon="o-user" wire:model='noteRecipient' tupe='email' label='Destinatário' placeholder='exemplo@mail.com'/>
        {{-- <x-mary-input icon="o-calendar" wire:model='noteSendDate' type='date' label='Data de envio' /> --}}
        <x-mary-input icon="o-calendar" wire:model='noteSendDate' type='date' label='Data de envio' wire:change="checkDateAvailability" />
        
        @if (!$isDateAvailable)
            <div class="text-sm text-red-500">{{ $dateErrorMessage }}</div>
        @endif

        <div class="pt-4">
            {{-- <x-mary-button wire:click='submit' primary icon-right="o-paper-airplane" spinner class="btn-success">Agendar anotação</x-mary-button> --}}
            <x-mary-button type="submit" primary icon-right="o-paper-airplane" spinner class="btn-success">Agendar anotação</x-mary-button>
        </div>
        <x-mary-errors />
    </form>
</div>
