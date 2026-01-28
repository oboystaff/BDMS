<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class BookReturn extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function requisition()
    {
        return $this->belongsTo(BookRequisition::class, 'req_id');
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

    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $routine) {
            $routine->return_id =  $routine->generateReturnId();
        });
    }

    public function generateReturnId()
    {
        $return_id = rand(10000000, 99999999);

        while (self::where('return_id', $return_id)->exists()) {
            $this->generateReturnId();
        }

        return $return_id;
    }
}
