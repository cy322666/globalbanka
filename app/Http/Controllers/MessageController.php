<?php

namespace App\Http\Controllers;

use App\Models\Accept;
use App\Models\Message;
use App\Models\Staff;
use App\Models\Talk;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function hook(Request $request)
    {
        Message::query()->create($request->toArray());
    }

    public function widget(Request $request): Factory|View|Application
    {
        Log::info(__METHOD__, $request->toArray());

        $staffs = Staff::query()
            ->orderByDesc('id')
            ->get();

        if ($request->period !== 'false') {

            $dayAt = match ($request->period) {

                'day'   => Carbon::now()->subDay(),
                'yesterday' => Carbon::now()->subDays(2),
                'month' => Carbon::now()->subMonth(),
                default => Carbon::now()->subDays(7),
            };
        }

        if ($request->date_from !== 'false') {

            $dayAt = Carbon::parse($request->date_from);
        }

        $dayAt = empty($dayAt) ? Carbon::now()->subDays(7) : $dayAt;

        $dayTo = $request->date_to !== 'false' ? Carbon::parse($request->date_to) : Carbon::now();

        $staffInfo = [];

        foreach ($staffs as $staff) {

                $talks = Accept::query()
                    ->select(['time'])
                    ->where('time', '<', 3600)
                    ->where('responsible_user_id', $staff->staff_id)
                    ->whereBetween('lead_created_at', [
                        $dayAt->format('Y-m-d H:i:s'),
                        $dayTo->format('Y-m-d H:i:s'),
                    ])
                    ->get();

                $info = [
                    'name'  => $staff->name,
                    'avg'   => $talks->count() > 0 ? round(($talks->sum('time') / $talks->count()) / 60, 1) : 0,
                    'count' => $talks->count(),
                ];

                $staffInfo[] = $info;
        }

        return view('widget', ['staffs' => $staffInfo]);
    }

    public function widget1(Request $request): Factory|View|Application
    {
        Log::info(__METHOD__, $request->toArray());

        $staffs = Staff::query()
            ->orderByDesc('id')
            ->get();

        if ($request->period !== 'false') {

            $dayAt = match ($request->period) {

                'day'   => Carbon::now()->subDay(),
                'yesterday' => Carbon::now()->subDays(2),
                'month' => Carbon::now()->subMonth(),
                default => Carbon::now()->subDays(7),
            };
        }

        if ($request->date_from !== 'false') {

            $dayAt = Carbon::parse($request->date_from);
        }

        $dayAt = empty($dayAt) ? Carbon::now()->subDays(7) : $dayAt;

        $dayTo = $request->date_to !== 'false' ? Carbon::parse($request->date_to) : Carbon::now();

        $staffInfo = [];

        foreach ($staffs as $staff) {

            if ($staff->avg_out == 0 &&
                $staff->count_out == 0 &&
                $staff->count_in == 0) {

                $talks = Talk::query()
                    ->select(['time'])
                    ->where('responsible_user_id', $staff->staff_id)
                    ->whereBetween('out_at', [
                        $dayAt->format('Y-m-d H:i:s'),
                        $dayTo->format('Y-m-d H:i:s'),
                    ])
                    ->get();

                $out = Message::query()
                    ->select(['msg_at', 'sum'])
                    ->where('responsible_user_id', $staff->staff_id)
                    ->where('type', 'out')
                    ->whereBetween('msg_at', [
                        $dayAt->format('Y-m-d H:i:s'),
                        $dayTo->format('Y-m-d H:i:s'),
                    ]);

                $info = [
                    'name'  => $staff->name,
                    'avg'   => $talks->count() !== 0 ? round($talks->sum('time') / $talks->count(), 1) : 0,
                    'count' => $out->count(),
                ];

                $staffInfo[] = $info;

            }
        }

        return view('widget', ['staffs' => $staffInfo]);
    }
}
