<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;
    public Note $note;

    /**
     * Create a new job instance.
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;

        $emailContent = "Olá, você recebeu uma nova anotação, visualize aqui: {$noteUrl}";

        Mail::raw($emailContent, function ($message) {
            $message->from('rafaelpianaro@gmail.com', 'Sendnotes')
                ->to($this->note->user->email)
                ->subject('Você tem uma nova anotação de ' . $this->note->user->name);
        });
    }
}
