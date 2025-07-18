<?php

namespace App\Exports;

use App\Models\Bon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BonsExport implements FromView
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $bons = Bon::whereBetween('date_bon', [$this->start, $this->end])
            ->selectRaw('site_id, type_carburant, SUM(quantite) as total_quantite, SUM(total) as total_valeur')
            ->with('site')
            ->groupBy('site_id', 'type_carburant')
            ->get()
            ->groupBy('site_id');

        return view('/excel/esite', [
            'bons' => $bons,
            'start' => $this->start,
            'end' => $this->end,
        ]);
    }
}
