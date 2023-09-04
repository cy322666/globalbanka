<?php

namespace App\Console\Commands;

use App\Models\Accept;
use App\Models\Account;
use App\Models\Message;
use App\Services\amoCRM\Client;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DelForMsg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:msg-del';

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

        $msgs = Message::query()
            ->where('element_type', 'lead')
            ->where('created_at', '>', Carbon::now()->subMinutes(20)->format('Y-m-d H:i:s'))
            ->distinct('element_id')
            ->get();

        dump('count '. $msgs->count());

        foreach ($msgs as $msg) {

            dump('msg '.$msg->id);

            $lead = $amoApi->service
                ->leads()
                ->find($msg->element_id);

            if ($lead->cf('Канал связи')->getValue() == 'Звонок') {

                dump('have call');

                Accept::query()
                    ->where('lead_id', $msg->element_id)
                    ->delete();
            }
        }
        return Command::SUCCESS;
    }
}
