<?php

namespace App\Exports;

use App\Models\Bon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class JourneeExport implements FromView
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
       $bons=Bon::select('bons.n_bon','bons.date_bon',
            DB::raw('LOWER(bons.type_carburant) as type_carburant'),
            DB::raw('SUM(quantite) as total_quantite'),
            DB::raw('SUM(total) as total_valeur'))
            ->whereBetween('bons.date_bon',[$this->start,$this->end])
            ->groupBy('bons.n_bon','bons.date_bon',DB::raw('LOWER(type_carburant)'))
            ->orderBy('date_bon')
            ->get()
            ->groupBy('date_bon');
        return view('/excel/ejournee',compact('bons'));
    }
}
