<?php

namespace App\Console\Commands;

use App\Models\Accept;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AcceptanceTalk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accept:talk {talk_id}';

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
        $firstOut = Message::query()
            ->where('type', 'out')
            ->where('element_type', 'lead')
            ->where('talk_id', $this->argument('talk_id'))
            ->orderBy('msg_at')
            ->first();

        if (!$firstOut) return 1;

        $diff = Carbon::parse($firstOut->msg_at)->diff(Carbon::parse($firstOut->lead_created_at));

        $hours   = $diff->format('%h') * 60 * 60;
        $minutes = $diff->format('%i') * 60;
        $seconds = $diff->format('%s');

        try {

            Accept::query()->create([
                'time'      => $hours + $minutes + $seconds,
                'lead_id'   => $firstOut->element_id,
                'lead_created_at' => $firstOut->lead_created_at,
                'first_out' => $firstOut->msg_at,
                'talk_id'   => $firstOut->talk_id,
                'responsible_user_id' => $firstOut->responsible_user_id,
            ]);

        } catch (\Throwable $e) {

            dump($e->getMessage());
        }
        return 1;
    }
}
