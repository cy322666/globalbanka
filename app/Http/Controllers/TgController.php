<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\amoCRM\Client;
use App\Services\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TgController extends Controller
{
    public function hook(Request $request)
    {
        Log::info(__METHOD__, $request->toArray());

        $leadId = $request->toArray()['leads']['add'][0]['id'];

        $amoApi = (new Client(account: Account::query()->first()))->init();

        $lead = $amoApi->service->leads()->find($leadId);

        Telegram::send(implode("\n", [
            '*Новая сделка!* ',
            '-----------------------',
            'Название : '.$lead->name,
            'Воронка : '.$lead->pipeline_id == 6716018 ? 'TipsForTrips' : 'Globalbanka',
//            '*Клиент* ',
//            'Имя : '.$lead->contact->name ?? '-',
//            'Почта контакта : '.$lead->contact?->cf('Email')->getValue() ?? '-',
        ]), env('TG_CHAT'), env('TG_TOKEN'), [
            "text" => "Перейти в сделку",
            "url"  => "https://globalbanka1.amocrm.ru/leads/detail/".$leadId
        ], true
        );
    }
}
