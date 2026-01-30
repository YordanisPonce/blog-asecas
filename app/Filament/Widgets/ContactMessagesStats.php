<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContactMessagesStats extends BaseWidget
{
    protected static ?int $sort = 1; // orden en dashboard

    protected function getStats(): array
    {
        $today = Carbon::today();
        $last7 = Carbon::now()->subDays(6)->startOfDay();

        $todayCount = Contact::query()
            ->whereDate('created_at', $today)
            ->count();

        $last7Count = Contact::query()
            ->where('created_at', '>=', $last7)
            ->count();

        $total = Contact::query()->count();

        return [
            Stat::make('Mensajes hoy', $todayCount),
            Stat::make('Últimos 7 días', $last7Count),
            Stat::make('Total mensajes', $total),
        ];
    }
}
