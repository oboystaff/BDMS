<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class Registration extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function territory()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function zso()
    {
        return $this->belongsTo(ZonalSalesOfficer::class, 'zonal_sales_officer_id');
    }

    public function registrationType()
    {
        return $this->belongsTo(RegistrationType::class, 'reg_type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $routine) {
            $routine->reg_id =  $routine->generateRegId();
        });
    }

    public function generateRegId()
    {
        $reg_id = rand(10000000, 99999999);

        while (self::where('reg_id', $reg_id)->exists()) {
            $this->generateRegId();
        }

        return $reg_id;
    }
}
