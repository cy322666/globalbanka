<?php

namespace App\Console\Commands;

use App\Models\Accept;
use App\Models\Account;
use App\Models\Message;
use App\Models\Talk;
use App\Services\amoCRM\Client;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DelCallTalks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:call-del';

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
        $amoApi = (new Client(account: Account::query()->first()))->init();

        $talks = Talk::query()
            ->where('status', 1)
            ->get();

        foreach ($talks as $talk) {

            $msg = Message::query()
                ->where('talk_id', $talk->talk_id)
                ->where('element_type', 'lead')
                ->where('created_at', '>', Carbon::now()->subMinutes(20)->format('Y-m-d H:i:s'))
                ->first();

            if ($msg) {

                $lead = $amoApi->service
                    ->leads()
                    ->find($msg->element_id);

                if ($lead->cf('Канал связи')->getValue() == 'Звонок') {

                    $talk->status = 1;
                    $talk->save();

                    Accept::query()
                        ->where('talk_id', $talk->talk_id)
                        ->delete();

                } else {

                    $talk->status = 5;
                    $talk->save();
                }
            } else {

                $talk->status = 4;
                $talk->save();
            }
        }

        return Command::SUCCESS;
    }
}
