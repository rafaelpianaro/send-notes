<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduleNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-schedule-notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->info('olá mundo!');
        $now = Carbon::now();

        $notes = Note::where('is_published', true)
            ->whereDate('send_date', $now->toDateString())
            // $notes->toSql();
            ->get();

        // dd($notes);
        
        $noteCount = $notes->count();
        $this->info("Enviado {$noteCount} anotações agendadas.");

        foreach($notes as $note)
        {
            // SendEmail::dispatch($note);
            $job = new SendEmail($note); // Cria a instância do Job
            $job->handle();
        }
    }
}
