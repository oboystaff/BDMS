<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class Zone extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function zonalSalesOfficer()
    {
        return $this->belongsTo(ZonalSalesOfficer::class, 'zonal_sales_officer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
