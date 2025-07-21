<?php

namespace App\Exports;

use App\Models\Bon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class NbonExport implements FromView
{
    protected $motcle;

    public function __construct($motcle)
    {
        $this->motcle = $motcle;
    }

    public function view(): View
    {
       $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->where('n_bon', 'like', '%'.$this->motcle.'%')
            ->get();

        return view('/excel/enbon', ['bons' => $bons]);
    }
}
