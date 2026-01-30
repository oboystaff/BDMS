<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class Sale extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function client()
    {
        return $this->belongsTo(Registration::class, 'client_id', 'reg_id');
    }

    public function clientRequest()
    {
        return $this->belongsTo(ClientRequest::class, 'request_id', 'request_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }

    public function zso()
    {
        return $this->belongsTo(ZonalSalesOfficer::class, 'zonal_sales_officer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $routine) {
            $routine->sales_id =  $routine->generateSalesId();
        });
    }

    public function generateSalesId()
    {
        $sales_id = rand(10000000, 99999999);

        while (self::where('sales_id', $sales_id)->exists()) {
            $this->generateSalesId();
        }

        return $sales_id;
    }
}
