<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
     protected $table = 'bons'; // ou le nom réel de ta table

    // si tu utilises les timestamps
    public $timestamps = true;

    /**
     * Relations
     */

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }

    public function preneur()
    {
        return $this->belongsTo(Preneur::class, 'preneur_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}
