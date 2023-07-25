<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Talk;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function hook(Request $request)
    {
        Message::query()->create($request->toArray());
    }

    public function widget(Request $request): Factory|View|Application
    {
        $talks = Talk::query()
            ->select(['time'])
            ->where('responsible_user_id', 9531654)
            ->get();

        return view('widget', [
            'staffs' => [[
                'name'  => 9531654,
                'count' => round($talks->count() / 2, 1),
                'avg'   => $talks->sum('time') / $talks->count(),
            ]]
        ]);
    }
}
