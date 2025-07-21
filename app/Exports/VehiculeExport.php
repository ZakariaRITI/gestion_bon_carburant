<?php

namespace App\Exports;

use App\Models\Bon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class VehiculeExport implements FromView
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
        $bons = Bon::join('vehicules', 'bons.vehicule_id', '=', 'vehicules.id')
            ->select('bons.vehicule_id','vehicules.n_vehicule','vehicules.marque',
            DB::raw('LOWER(bons.type_carburant) as type_carburant'),
            DB::raw('SUM(bons.quantite) as total_quantite'),
            DB::raw('SUM(bons.total) as total_valeur'))
            ->whereBetween('bons.date_bon', [$this->start, $this->end])
            ->groupBy('bons.vehicule_id','vehicules.n_vehicule','vehicules.marque',
            DB::raw('LOWER(bons.type_carburant)'))
            ->get()
            ->groupBy('vehicule_id');

        return view('/excel/evehicule',compact('bons'));
    }
}
