<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bon;
use App\Models\Site;
use App\Models\Service;
use App\Models\Preneur;
use App\Models\Utilisateur;
use App\Models\Vehicule;
use App\Models\User;
use App\Models\Carburant;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BonsExport;
use PDF;


class AdminController extends Controller
{

     public function __construct()
     {
        $this->middleware('auth');
     }

     public function display()
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
        return view('acceuil',compact('bons','si','se','ve','pr','ut'));
     }

     public function ajoutbon()
     {
      $c=new Carburant();
      $carburant=$c->all();

        $site=new Site();
        $service=new Service();
        $vehicule=new Vehicule();
        $preneur=new Preneur();

        $sites=$site->all();
        $services=$service->all();
        $vehicules=$vehicule->all();
        $preneurs=$preneur->all();
      return view('ajout_bon',compact('carburant','sites','services','vehicules','preneurs'));
     }

     public function enregistrer(Request $request)
     {
        $exists = Bon::where('n_bon', $request->n_bon)->exists();

        if ($exists) 
        {
            return back()
                ->withInput()
                ->withErrors(['n_bon' => 'Ce numéro de bon existe déjà.']);
        }

         $n_bon=$request->n_bon;
         $type_carburant=$request->type_carburant;
         $prix=$request->prix;  
         $quantite=$request->quantite;
         $date_bon=$request->date_bon;
         $date_saisis=$request->date_saisis;
         $site=$request->site;
         $service=$request->service;
         $n_vehicule=$request->n_vehicule;
         $preneur=$request->preneur;
         $user=$request->user;

         $bon=new Bon();

         $bon->n_bon=$n_bon;
         $bon->type_carburant=$type_carburant;
         $bon->quantite=$quantite;
         $bon->prix=$prix;
         $bon->total=$prix*$quantite;
         $bon->date_bon=$date_bon;
         $bon->date_saisis=$date_saisis;
         $bon->site_id=$site;
         $bon->service_id= $service;
         $bon->vehicule_id=$n_vehicule;
         $bon->preneur_id=$preneur;
         $bon->utilisateur_id=$user;

         $bon->save();
         return redirect('/acc');
     }

     public function prixcarburant()
     {
      $c=new Carburant();
      $carburant=$c->all();
      $carb=[];
      $i=0;

      foreach($carburant as $ca)
      {
        $carb[$i]=$ca->prix;
        $i++;
      }
      return view('prixcarburant',compact('carb'));
     }

     public function modifiercarburant(Request $request)
     {
        $objcarburant=new Carburant();
        $carburanta=$objcarburant->find(1);
        $a=$request->input('essence');
        $carburanta->prix=$a;
        $carburantb=$objcarburant->find(2);
        $b=$request->input('diesel');
        $carburantb->prix=$b;
        $carburanta->save();
        $carburantb->save();
        return redirect('/acc');
     }

     public function recherche_nbon(Request $request)
     {
         $motcle=$request->input('motcle');
         $bons = collect(); 

         if(!empty($motcle))
         {
            $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->where('n_bon', 'like', '%'.$motcle.'%')
            ->get();
         }
         return view('rechercher_bon', compact('bons','motcle'));
      }

      public function pdf_recherche_nbon(Request $request)
     {
         $motcle=$request->input('motcle');
         $bons = collect(); 

         if(!empty($motcle))
         {
            $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->where('n_bon', 'like', '%'.$motcle.'%')
            ->get();
         }
         
         $pdf = PDF::loadView('pdf/nbon', compact('bons','motcle'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_nbon.pdf');
      }

      public function recherche_nmatricule(Request $request)
      {
         $motcle = $request->input('motcle');
         $bons = collect();

         if (!empty($motcle)) 
         {
            $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->whereHas('preneur', function ($query) use ($motcle) 
            {
            $query->where('n_matricule', 'like', '%'.$motcle.'%');
            })
            ->get();
         }

         return view('rechercher_matricule', compact('bons', 'motcle'));
      }

      public function pdf_recherche_nmatricule(Request $request)
      {
         $motcle = $request->input('motcle');
         $bons = collect();

         if (!empty($motcle)) 
         {
            $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->whereHas('preneur', function ($query) use ($motcle) 
            {
            $query->where('n_matricule', 'like', '%'.$motcle.'%');
            })
            ->get();
         }

         $pdf = PDF::loadView('pdf/nmatricule', compact('bons','motcle'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_nmatricule.pdf');
      }

      public function recherche_nvehicule(Request $request)
      {
         $motcle = $request->input('motcle');
         $bons = collect();

         if (!empty($motcle)) 
         {
            $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->whereHas('vehicule', function ($query) use ($motcle) 
            {
            $query->where('n_vehicule', 'like', '%'.$motcle.'%');
            })
            ->get();
         }

         return view('rechercher_vehicule', compact('bons', 'motcle'));
      }

      public function pdf_recherche_nvehicule(Request $request)
      {
         $motcle = $request->input('motcle');
         $bons = collect();

         if (!empty($motcle)) 
         {
            $bons = Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])
            ->whereHas('vehicule', function ($query) use ($motcle) 
            {
            $query->where('n_vehicule', 'like', '%'.$motcle.'%');
            })
            ->get();
         }

         $pdf = PDF::loadView('pdf/nvehicule', compact('bons','motcle'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_nvehicule.pdf');
      }

      public function update_bon(Request $request)
      {
         $id=$request->input('id');
         $bon=Bon::with(['site', 'service', 'vehicule', 'preneur', 'utilisateur'])->find($id);

         $c=new Carburant();
         $carburant=$c->all();

        $site=new Site();
        $service=new Service();
        $vehicule=new Vehicule();
        $preneur=new Preneur();

        $sites=$site->all();
        $services=$service->all();
        $vehicules=$vehicule->all();
        $preneurs=$preneur->all();
         return view('update_bon',compact('bon','carburant','sites','services','vehicules','preneurs'));
      }

      public function modifier_bon(Request $request)
      {
         $exists = Bon::where('n_bon', $request->n_bon)->where('id', '!=', $request->id)->exists();

        if ($exists) 
        {
            return back()
                ->withInput()
                ->withErrors(['n_bon' => 'Ce numéro de bon existe déjà.']);
        }

         $id=$request->input('id');
         $objbon=new Bon();
         $bon=$objbon->find($id);

         $n_bon=$request->n_bon;
         $type_carburant=$request->type_carburant;
         $prix=$request->prix;  
         $quantite=$request->quantite;
         $date_bon=$request->date_bon;
         $date_saisis=$request->date_saisis;
         $site=$request->site;
         $service=$request->service;
         $n_vehicule=$request->n_vehicule;
         $preneur=$request->preneur;
         $user=$request->user;

         $bon->n_bon=$n_bon;
         $bon->type_carburant=$type_carburant;
         $bon->quantite=$quantite;
         $bon->prix=$prix;
         $bon->total=$prix*$quantite;
         $bon->date_bon=$date_bon;
         $bon->date_saisis=$date_saisis;
         $bon->site_id=$site;
         $bon->service_id= $service;
         $bon->vehicule_id=$n_vehicule;
         $bon->preneur_id=$preneur;
         $bon->utilisateur_id=$user;

         $bon->save();
         return redirect('/acc');
      }

      public function supprimer_bon(Request $request)
      {
       $id=$request->input('id');
       $bon=Bon::find($id);
       $bon->delete();
       return redirect('/acc');
      }

      public function impression($type,Request $request)
      {
         $start=$request->input('start');
         $end=$request->input('end');

         switch ($type) 
         {
         case 'site':
            $bons = DB::table('bons')
            ->join('sites', 'bons.site_id', '=', 'sites.id')
            ->select('sites.code_site','sites.nom_site',
            DB::raw('LOWER(bons.type_carburant) as type_carburant'),  // force minuscule ici
            DB::raw('SUM(bons.quantite) as total_quantite'),
            DB::raw('SUM(bons.total) as total_valeur'))
            ->whereBetween('bons.date_bon', [$start, $end])
            ->groupBy('sites.id', 'sites.code_site', 'sites.nom_site', DB::raw('LOWER(bons.type_carburant)'))
            ->orderBy('sites.code_site')
            ->get()
            ->groupBy('code_site');
            return view('impression_site',compact('start','end','bons'));
        case 'service':
            $bons = DB::table('bons')
            ->join('services', 'bons.service_id', '=', 'services.id')
            ->select('services.code_service','services.nom_service',
            DB::raw('LOWER(bons.type_carburant) as type_carburant'),  // force minuscule ici
            DB::raw('SUM(bons.quantite) as total_quantite'),
            DB::raw('SUM(bons.total) as total_valeur'))
            ->whereBetween('bons.date_bon', [$start, $end])
            ->groupBy('services.id', 'services.code_service', 'services.nom_service', DB::raw('LOWER(bons.type_carburant)'))
            ->orderBy('services.code_service')
            ->get()
            ->groupBy('code_service');
            return view('impression_service',compact('start','end','bons'));
        case 'vehicule':
            $bons = Bon::join('vehicules', 'bons.vehicule_id', '=', 'vehicules.id')
            ->select('bons.vehicule_id','vehicules.n_vehicule','vehicules.marque',
            DB::raw('LOWER(bons.type_carburant) as type_carburant'),
            DB::raw('SUM(bons.quantite) as total_quantite'),
            DB::raw('SUM(bons.total) as total_valeur'))
            ->whereBetween('bons.date_bon', [$start, $end])
            ->groupBy('bons.vehicule_id','vehicules.n_vehicule','vehicules.marque',
            DB::raw('LOWER(bons.type_carburant)'))
            ->get()
            ->groupBy('vehicule_id');
            return view('impression_vehicule',compact('start','end','bons'));
        case 'preneur':
            $bons = Bon::join('preneurs', 'bons.preneur_id', '=', 'preneurs.id')
            ->select('bons.preneur_id','preneurs.n_matricule','preneurs.nom',
            DB::raw('LOWER(bons.type_carburant) as type_carburant'),
            DB::raw('SUM(bons.quantite) as total_quantite'),
            DB::raw('SUM(bons.total) as total_valeur'))
            ->whereBetween('bons.date_bon', [$start, $end])
            ->groupBy('bons.preneur_id','preneurs.n_matricule','preneurs.nom',
            DB::raw('LOWER(bons.type_carburant)'))
            ->get()
            ->groupBy('preneur_id');
            return view('impression_preneur',compact('start','end','bons'));
        case 'journee':
            $bons=DB::table("bons")
            ->select('bons.n_bon','bons.date_bon',
            DB::raw('LOWER(bons.type_carburant) as type_carburant'),
            DB::raw('SUM(quantite) as total_quantite'),
            DB::raw('SUM(total) as total_valeur'))
            ->whereBetween('bons.date_bon',[$start,$end])
            ->groupBy('bons.n_bon','bons.date_bon',DB::raw('LOWER(type_carburant)'))
            ->orderBy('date_bon')
            ->get()
            ->groupBy('date_bon');
            return view('impression_journee',compact('start','end','bons'));
        default:
            abort(404); // si le type n'existe pas
         }
      }

      public function pdf($type, Request $request)
      {
         $start = $request->input('start');
         $end = $request->input('end');

         switch ($type) 
         {
            case 'site':
                  $bons = DB::table('bons')
                     ->join('sites', 'bons.site_id', '=', 'sites.id')
                     ->select('sites.code_site', 'sites.nom_site',
                        DB::raw('LOWER(bons.type_carburant) as type_carburant'),
                        DB::raw('SUM(bons.quantite) as total_quantite'),
                        DB::raw('SUM(bons.total) as total_valeur'))
                     ->whereBetween('bons.date_bon', [$start, $end])
                     ->groupBy('sites.id', 'sites.code_site', 'sites.nom_site', DB::raw('LOWER(bons.type_carburant)'))
                     ->orderBy('sites.code_site')
                     ->get()
                     ->groupBy('code_site');

                  $pdf = PDF::loadView('pdf/site', compact('start', 'end', 'bons'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_sites.pdf');

            case 'service':
                  $bons = DB::table('bons')
                     ->join('services', 'bons.service_id', '=', 'services.id')
                     ->select('services.code_service', 'services.nom_service',
                        DB::raw('LOWER(bons.type_carburant) as type_carburant'),
                        DB::raw('SUM(bons.quantite) as total_quantite'),
                        DB::raw('SUM(bons.total) as total_valeur'))
                     ->whereBetween('bons.date_bon', [$start, $end])
                     ->groupBy('services.id', 'services.code_service', 'services.nom_service', DB::raw('LOWER(bons.type_carburant)'))
                     ->orderBy('services.code_service')
                     ->get()
                     ->groupBy('code_service');

                  $pdf = PDF::loadView('pdf/service', compact('start', 'end', 'bons'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_services.pdf');

            case 'vehicule':
                  $bons = Bon::join('vehicules', 'bons.vehicule_id', '=', 'vehicules.id')
                     ->select('bons.vehicule_id', 'vehicules.n_vehicule', 'vehicules.marque',
                        DB::raw('LOWER(bons.type_carburant) as type_carburant'),
                        DB::raw('SUM(bons.quantite) as total_quantite'),
                        DB::raw('SUM(bons.total) as total_valeur'))
                     ->whereBetween('bons.date_bon', [$start, $end])
                     ->groupBy('bons.vehicule_id', 'vehicules.n_vehicule', 'vehicules.marque', DB::raw('LOWER(bons.type_carburant)'))
                     ->orderBy('vehicules.n_vehicule')
                     ->get()
                     ->groupBy('vehicule_id');

                  $pdf = PDF::loadView('pdf/vehicule', compact('start', 'end', 'bons'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_vehicules.pdf');

            case 'preneur':
                  $bons = Bon::join('preneurs', 'bons.preneur_id', '=', 'preneurs.id')
                     ->select('bons.preneur_id', 'preneurs.n_matricule', 'preneurs.nom',
                        DB::raw('LOWER(bons.type_carburant) as type_carburant'),
                        DB::raw('SUM(bons.quantite) as total_quantite'),
                        DB::raw('SUM(bons.total) as total_valeur'))
                     ->whereBetween('bons.date_bon', [$start, $end])
                     ->groupBy('bons.preneur_id', 'preneurs.n_matricule', 'preneurs.nom', DB::raw('LOWER(bons.type_carburant)'))
                     ->orderBy('preneurs.nom')
                     ->get()
                     ->groupBy('preneur_id');

                  $pdf = PDF::loadView('pdf/preneur', compact('start', 'end', 'bons'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_preneurs.pdf');

            case 'journee':
                  $bons = DB::table('bons')
                     ->select('bons.n_bon', 'bons.date_bon',
                        DB::raw('LOWER(bons.type_carburant) as type_carburant'),
                        DB::raw('SUM(quantite) as total_quantite'),
                        DB::raw('SUM(total) as total_valeur'))
                     ->whereBetween('bons.date_bon', [$start, $end])
                     ->groupBy('bons.n_bon', 'bons.date_bon', DB::raw('LOWER(type_carburant)'))
                     ->orderBy('bons.date_bon')
                     ->get()
                     ->groupBy('date_bon');

                  $pdf = PDF::loadView('pdf/journee', compact('start', 'end', 'bons'))
                  ->setPaper('a4', 'portrait');

                   return $pdf->stream('rapport_journees.pdf');

            default:
                  abort(404, 'Type de rapport non trouvé');
         }
      }

       public function exportExcelBon(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        return Excel::download(new BonsExport($start, $end), 'sites.xlsx');
    }

}


