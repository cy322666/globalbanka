<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Services\amoCRM\Client;
use App\Services\Telegram;
use Illuminate\Http\Request;

class TgController extends Controller
{
    public function hook(Request $request)
    {
        $leadId = $request->toArray()['leads']['add'][0]['id'];

        $amoApi = (new Client(account: Account::query()->first()))->init();

        $lead = $amoApi->service->leads()->find($leadId);

        Telegram::send(implode("\n", [
            '*Успешная сделка!* ',
            '-----------------------',
            '*Сделка*',
            'Название : '.$lead->name,
            '*Клиент* ',
            'Имя : '.$lead->contact->name ?? '-',
//            'Почта контакта : '.$lead->contact?->cf('Email')->getValue() ?? '-',
        ]), env('TG_CHAT'), env('TG_TOKEN'), [
            "text" => "Перейти в сделку",
            "url"  => "https://globalbanka1.amocrm.ru/leads/detail/".$leadId
        ], false
        );
    }
}
