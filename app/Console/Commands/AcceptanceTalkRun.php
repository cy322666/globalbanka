<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AcceptanceTalkRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accept:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $talks = Message::query()
            ->select('talk_id')
            ->distinct()
            ->get();

        foreach ($talks as $talk) {

            Artisan::call('accept:talk '.$talk->talk_id);
        }

        return Command::SUCCESS;
    }
}
