<?php

namespace App\Exports;

use App\Models\Bon;
use App\Models\Site;
use App\Models\Service;
use App\Models\Vehicule;
use App\Models\Preneur;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AccExport implements FromView
{
    public function view(): View
    {
        $bon=new Bon();
        $bons=$bon->all();

        $site=new Site();
        $service=new Service();
        $vehicule=new Vehicule();
        $preneur=new Preneur();
        $utilisateur=new User();

        $si=[];
        $se=[];
        $ve=[];
        $pr=[];
        $ut=[];
        $i=0;
        foreach ($bons as $bon) 
        {
            $si[$i]=$site->find($bon->site_id);
            $se[$i]=$service->find($bon->service_id);
            $ve[$i]=$vehicule->find($bon->vehicule_id);
            $pr[$i]=$preneur->find($bon->preneur_id);
            $ut[$i]=$utilisateur->find($bon->utilisateur_id);
            $i++;
        }

        return view('/excel/eacc',compact('bons','si','se','ve','pr','ut'));
    }
}
