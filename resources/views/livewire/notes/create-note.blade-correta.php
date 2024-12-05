<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:1'],
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

        // Verificar se a data está disponível
        // dd($this->noteSendDate);
        $formattedDate = \Carbon\Carbon::parse($this->noteSendDate)->format('Y-m-d');
        $existingNote = auth()->user()->notes()->whereDate('send_date', $formattedDate)->first();

        if ($existingNote) {
            $this->addError('noteSendDate', 'Já existe uma anotação agendada para esta data.');
            return;
        }
        // dd($this->noteTitle, $this->noteBody, $this->noteRecipient, $this->noteSendDate);
        auth()->user()->notes()->create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            // 'send_date' => $this->noteSendDate,
            'send_date' => \Carbon\Carbon::parse($this->noteSendDate)->format('Y-m-d'),
            'is_published' => false,
        ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form wire:submit='submit' class="space-y-4">
        <x-mary-input wire:model='noteTitle' label='Título da Anotação' placeholder="Hoje está sendo um ótimo dia."/>
        <x-mary-textarea wire:model='noteBody' label='Sua Anotação' placeholder='Compartilhar seus pensamentos' />
        <x-mary-input icon="o-user" wire:model='noteRecipient' tupe='email' label='Destinatário' placeholder='exemplo@mail.com'/>
        <x-mary-input icon="o-calendar" wire:model='noteSendDate' type='date' label='Data de envio' />
        <div class="pt-4">
            {{-- <x-mary-button wire:click='submit' primary icon-right="o-paper-airplane" spinner class="btn-success">Agendar anotação</x-mary-button> --}}
            <x-mary-button type="submit" primary icon-right="o-paper-airplane" spinner class="btn-success">Agendar anotação</x-mary-button>
        </div>
        <x-mary-errors />
    </form>
</div>
