<?php

namespace App\Exports;

use App\Models\Bon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class ServiceExport implements FromView
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
        $bons = Bon::select('services.code_service', 'services.nom_service',
                        DB::raw('LOWER(bons.type_carburant) as type_carburant'),
                        DB::raw('SUM(bons.quantite) as total_quantite'),
                        DB::raw('SUM(bons.total) as total_valeur'))
                     ->join('services', 'bons.service_id', '=', 'services.id')
                     ->whereBetween('bons.date_bon', [$this->start, $this->end])
                     ->groupBy('services.id', 'services.code_service', 'services.nom_service', DB::raw('LOWER(bons.type_carburant)'))
                     ->orderBy('services.code_service')
                     ->get()
                     ->groupBy('code_service');

        return view('/excel/eservice',compact('bons'));
    }
}
