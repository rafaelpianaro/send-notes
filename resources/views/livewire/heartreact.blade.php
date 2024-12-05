<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public $heartCount;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heartCount = $note->heart_count;
    }

    public function increaseHeartCount()
    {
        // $this->note->heart_count++;
        // $this->note->save();
        // $this->heartCount = $this->note->heart_count;

        $this->note->update([
            'hert_count' => $this->heartCount + 1,
        ]);

        $this->heartCount = $this->note->heart_count;
    }
}; ?>

<div>
    <x-mary-button xs wire:click='increaseHeartCount' rose icon="o-heart" spinner>{{ $heartCount }}</x-mary-button>
</div>