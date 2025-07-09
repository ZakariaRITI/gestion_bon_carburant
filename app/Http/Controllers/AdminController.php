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

}
