<?php

namespace App\Exports;

use App\Models\Bon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class NmatriculeExport implements FromView
{
    protected $motcle;

    public function __construct($motcle)
    {
        $this->motcle = $motcle;
    }

    public function view(): View
    {
       $mc=$this->motcle;
       $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->whereHas('preneur', function ($query) use ($mc) 
            {
            $query->where('n_matricule', 'like', '%'.$this->motcle.'%');
            })
            ->get();

        return view('/excel/enmatricule', ['bons' => $bons]);
    }
}
