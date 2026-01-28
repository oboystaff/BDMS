<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class BookRequisition extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function agent()
    {
        return $this->belongsTo(SalesAgent::class, 'agent_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function zso()
    {
        return $this->belongsTo(ZonalSalesOfficer::class, 'zonal_sales_officer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $routine) {
            $routine->req_id =  $routine->generateReqId();
        });
    }

    public function generateReqId()
    {
        $req_id = rand(10000000, 99999999);

        while (self::where('req_id', $req_id)->exists()) {
            $this->generateReqId();
        }

        return $req_id;
    }
}
