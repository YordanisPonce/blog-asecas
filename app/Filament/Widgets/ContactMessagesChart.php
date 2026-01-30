<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ContactMessagesChart extends ChartWidget
{
    protected static ?string $heading = 'Mensajes recibidos (últimos 14 días)';
    protected static ?int $sort = 2;

    // opcional: altura
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $days = 14;
        $start = Carbon::now()->subDays($days - 1)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $rows = Contact::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('day')
            ->get()
            ->keyBy('day');

        $labels = [];
        $values = [];

        for ($i = 0; $i < $days; $i++) {
            $d = $start->copy()->addDays($i)->toDateString();
            $labels[] = Carbon::parse($d)->format('d M');
            $values[] = (int) ($rows[$d]->total ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Mensajes',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // 'bar' si prefieres barras
    }
}
