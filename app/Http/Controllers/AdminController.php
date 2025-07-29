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
use App\Exports\ServiceExport;
use App\Exports\VehiculeExport;
use App\Exports\PreneurExport;
use App\Exports\JourneeExport;
use App\Exports\NbonExport;
use App\Exports\NmatriculeExport;
use App\Exports\NvehiculeExport;
use App\Exports\AccExport;
use Illuminate\Support\Facades\Hash;
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

      public function pdf_acc()
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
                $pdf = PDF::loadView('pdf/acc',compact('bons','si','se','ve','pr','ut'))
                  ->setPaper('a4', 'portrait');

                  return $pdf->stream('rapport_acc.pdf');
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

    public function exportExcelservice(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        return Excel::download(new ServiceExport($start, $end), 'services.xlsx');
    }

    public function exportExcelvehicule(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        return Excel::download(new VehiculeExport($start, $end), 'vehicules.xlsx');
    }

    public function exportExcelpreneur(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        return Excel::download(new PreneurExport($start, $end), 'preneurs.xlsx');
    }

    public function exportExceljournee(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        return Excel::download(new JourneeExport($start, $end), 'journees.xlsx');
    }

    public function exportExcelnbon(Request $request)
    {
        $motcle=$request->motcle;
        return Excel::download(new NbonExport($motcle), 'nbon.xlsx');
    }

    public function exportExcelnmatricule(Request $request)
    { 
        $motcle=$request->motcle;
        return Excel::download(new NmatriculeExport($motcle), 'nmatricule.xlsx');
    }

    public function exportExcelnvehicule(Request $request)
    {
        $motcle=$request->motcle;
        return Excel::download(new NvehiculeExport($motcle), 'nvehicule.xlsx');
    }

    public function exportExcelacc()
    {
        return Excel::download(new AccExport(), 'acceuil.xlsx');
    }

    public function ajoutsite()
    {
      return view('ajout_site');
    }

    public function savesite(Request $request)
    {
       $code = ltrim($request->input('codesite'), '0');
       if ($code === '') 
       {
        $code = '0';
       }
       $nom=$request->input('nomsite');

      if (Site::where('code_site', $code)->exists()) 
      {
      return back()->with('error', 'Ce code site existe déjà.')->withInput();
      }

      $site=new Site();
      $site->code_site=$code;
      $site->nom_site=$nom;
      $site->save();
      return redirect('/as')->with('success', 'Site ajouté avec succès.');
    }

    public function displaysite()
    {
      $site=new Site();
      $sites=$site->all();
      return view('display_site', compact('sites'));
    }

    public function updatesite(Request $request)
    { 
      $id=$request->input('id');
      $site=Site::find($id);
      return view('update_site', compact('site'));
    }
   
    public function saveupdatesite(Request $request)
    {
      $code=$request->input('codesite');
      $nom=$request->input('nomsite');
      $id=$request->input('id');

      $site=Site::find($id);

      $exists = Site::where('code_site', $code)
                  ->where('id', '!=', $id)
                  ->exists();

      if ($exists) 
      {
        return redirect('/update?id='.$id)->with('error', 'Ce code site est déjà utilisé par un autre site.')->withInput();
      }

      $site->code_site=$code;
      $site->nom_site=$nom;

      $site->save();
      return redirect('/ds')->with('success', 'Site modifier avec succès.');
    }

    public function deletesite(Request $request)
    {
      $id=$request->input('id');
      $site=Site::find($id);
      $site->delete();
      return redirect('/ds')->with('success', 'Site supprimé avec succès.');
    }

    public function ajoutservice()
    {
      return view('ajout_service');
    }

    public function saveservice(Request $request)
    {
       $code =$request->input('codeservice');
       $nom=$request->input('nomservice');

      if (Service::where('code_service', $code)->exists()) 
      {
      return back()->with('error', 'Ce code service existe déjà.')->withInput();
      }

      $site=new Service();
      $site->code_service=$code;
      $site->nom_service=$nom;
      $site->save();
      return redirect('/aservice')->with('success', 'Service ajouté avec succès.');
    }

    public function displayservice()
    {
      $service=new Service();
      $services=$service->all();
      return view('display_service', compact('services'));
    }

    public function updateservice(Request $request)
    { 
      $id=$request->input('id');
      $service=Service::find($id);
      return view('update_service', compact('service'));
    }

    public function saveupdateservice(Request $request)
    {
      $code=$request->input('codeservice');
      $nom=$request->input('nomservice');
      $id=$request->input('id');

      $service=Service::find($id);

      $exists = Service::where('code_service', $code)
                  ->where('id', '!=', $id)
                  ->exists();

      if ($exists) 
      {
        return redirect('/updateservice?id='.$id)->with('error', 'Ce code service est déjà utilisé par un autre service.')->withInput();
      }

      $service->code_service=$code; 
      $service->nom_service=$nom;

      $service->save();
      return redirect('/gservice')->with('success', 'service modifier avec succès.');
    }

    public function deleteservice(Request $request)
    {
      $id=$request->input('id');
      $service=Service::find($id);
      $service->delete();
      return redirect('/gservice')->with('success', 'service supprimé avec succès.');
    }

    public function ajoutvehicule()
    {
      return view('ajout_vehicule');
    }

    public function savevehicule(Request $request)
    {
       $code =$request->input('codevehicule');
       $marque=$request->input('marque');
       $modele=$request->input('modele');

      if (Vehicule::where('n_vehicule', $code)->exists()) 
      {
      return back()->with('error', 'Ce numero vehicule existe déjà.')->withInput();
      }

      $vehicule=new Vehicule();
      $vehicule->n_vehicule=$code;
      $vehicule->marque=$marque;
      $vehicule->modele=$modele;
      $vehicule->save();
      return redirect('/avehicule')->with('success', 'vehicule ajouté avec succès.');
    }

    public function displayvehicule()
    {
      $vehicule=new Vehicule();
      $vehicules=$vehicule->all();
      return view('display_vehicule', compact('vehicules'));
    }

    public function updatevehicule(Request $request)
    { 
      $id=$request->input('id');
      $vehicule=Vehicule::find($id);
      return view('update_vehicule', compact('vehicule'));
    }

    public function saveupdatevehicule(Request $request)
    {
      $code=$request->input('codevehicule');
      $marque=$request->input('marque');
      $modele=$request->input('modele');
      $id=$request->input('id');

      $vehicule=Vehicule::find($id);

      $exists = Vehicule::where('n_vehicule', $code)
                  ->where('id', '!=', $id)
                  ->exists();

      if ($exists) 
      {
        return redirect('/updatevehicule?id='.$id)->with('error', 'Ce numero vehicule est déjà utilisé par un autre vehicule.')->withInput();
      }

      $vehicule->n_vehicule=$code; 
      $vehicule->marque=$marque;
      $vehicule->modele=$modele;

      $vehicule->save();
      return redirect('/gvehicule')->with('success', 'vehicule modifier avec succès.');
    }

    public function deletevehicule(Request $request)
    {
      $id=$request->input('id');
      $vehicule=Vehicule::find($id);
      $vehicule->delete();
      return redirect('/gvehicule')->with('success', 'vehicule supprimé avec succès.');
    }

    public function ajoutpreneur()
    {
      return view('ajout_preneur');
    }

    public function savepreneur(Request $request)
    {
       $matricule =$request->input('matricule');
       $nom=$request->input('nom');

      if (Preneur::where('n_matricule', $matricule)->exists()) 
      {
      return back()->with('error', 'Ce matricule preneur existe déjà.')->withInput();
      }

      $preneur=new Preneur();
      $preneur->n_matricule=$matricule;
      $preneur->nom=$nom;
      
      $preneur->save();
      return redirect('/apreneur')->with('success', 'preneur ajouté avec succès.');
    }

    public function displaypreneur()
    {
      $preneur=new Preneur();
      $preneurs=$preneur->all();
      return view('display_preneur', compact('preneurs'));
    }

    public function updatepreneur(Request $request)
    { 
      $id=$request->input('id');
      $preneur=Preneur::find($id);
      return view('update_preneur', compact('preneur'));
    }

    public function saveupdatepreneur(Request $request)
    {
      $matricule=$request->input('matricule');
      $nom=$request->input('nom');
      
      $id=$request->input('id');

      $preneur=Preneur::find($id);

      $exists = Preneur::where('n_matricule', $matricule)
                  ->where('id', '!=', $id)
                  ->exists();

      if ($exists) 
      {
        return redirect('/updatepreneur?id='.$id)->with('error', 'Ce matricule preneur est déjà utilisé par un autre preneur.')->withInput();
      }

      $preneur->n_matricule=$matricule; 
      $preneur->nom=$nom;

      $preneur->save();
      return redirect('/gpreneur')->with('success', 'preneur modifier avec succès.');
    }

    public function deletepreneur(Request $request)
    {
      $id=$request->input('id');
      $preneur=Preneur::find($id);
      $preneur->delete();
      return redirect('/gpreneur')->with('success', 'preneur supprimé avec succès.');
    }

    public function ajoutuser()
    {
      return view('ajout_utilisateur');
    }
    
    public function saveuser(Request $request)
    {
       $nom =$request->input('nom');
       $email=$request->input('user_email');
       $password=$request->input('user_password');
       $type=$request->input('type');

      if (User::where('email', $email)->exists()) 
      {
      return back()->with('error', 'Email existe déjà.')->withInput();
      }

      $user=new User();
      $user->name=$nom;
      $user->email=$email;
      $user->password=$password;
      $user->type=$type;
      
      $user->save();
      return redirect('/auser')->with('success', 'user ajouté avec succès.');
    }

    public function displayuser()
    {
      $user=new User();
      $users=$user->all();
      return view('display_user', compact('users'));
    }

    public function updateuser(Request $request)
    { 
      $id=$request->input('id');
      $user=User::find($id);
      return view('update_user', compact('user'));
    }

    public function saveupdateuser(Request $request)
    {
      $nom=$request->input('user_nom');
      $email=$request->input('user_email');
      $pwd=$request->input('pwd');
      $type=$request->input('type');
      
      $id=$request->input('id');

      $user=User::find($id);

      $exists = User::where('email', $email)->where('id', '!=', $id)->exists();

      if ($exists) 
      {
        return redirect('/updateuser?id='.$id)->with('error', 'Email est déjà utilisé par un autre utilisateur.')->withInput();
      }

      $user->name=$nom; 
      $user->email=$email;
      $user->type=$type;
      if (!Hash::check($pwd, $user->password)) 
      {
        $user->password = Hash::make($pwd);
      }

      $user->save();
      return redirect('/guser')->with('success', 'user modifier avec succès.');
    }

    public function deleteuser(Request $request)
    {
      $id=$request->input('id');
      $user=User::find($id);
      $user->delete();
      return redirect('/guser')->with('success', 'user supprimé avec succès.');
    }

    public function support()
    {
      return view('support');
    }

    public function dashbord()
    {
      $sites=Site::count();
      $services=Service::count();
      $vehicules=Vehicule::count();
      $preneurs=Preneur::count();
      $users=User::count();
      $bons=Bon::count();

      $vehi1=Vehicule::select('marque',DB::raw('count(*) as total'))->groupBy('marque')->get();
      $carburant = Bon::select(DB::raw('LOWER(type_carburant) as carburant'), DB::raw('SUM(total) as somme_total'))
      ->groupBy(DB::raw('LOWER(type_carburant)'))
      ->get();
      $bonsParAnnee = Bon::select(
        DB::raw('YEAR(date_bon) as annee'),
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('annee')
    ->orderBy('annee')
    ->get();

      return view('dashbord',compact('sites','services','vehicules','preneurs','users','bons','vehi1','carburant','bonsParAnnee'));
    }

}  


