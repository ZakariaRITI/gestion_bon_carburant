<?php

namespace App\Exports;

use App\Models\Bon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class PreneurExport implements FromView
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
        $bons = Bon::join('preneurs', 'bons.preneur_id', '=', 'preneurs.id')
                     ->select('bons.preneur_id', 'preneurs.n_matricule', 'preneurs.nom',
                        DB::raw('LOWER(bons.type_carburant) as type_carburant'),
                        DB::raw('SUM(bons.quantite) as total_quantite'),
                        DB::raw('SUM(bons.total) as total_valeur'))
                     ->whereBetween('bons.date_bon', [$this->start, $this->end])
                     ->groupBy('bons.preneur_id', 'preneurs.n_matricule', 'preneurs.nom', DB::raw('LOWER(bons.type_carburant)'))
                     ->orderBy('preneurs.nom')
                     ->get()
                     ->groupBy('preneur_id');

        return view('/excel/epreneur',compact('bons'));
    }
}
