<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class ClientRequest extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function client()
    {
        return $this->belongsTo(Registration::class, 'client_id', 'reg_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function (self $routine) {
    //         $routine->request_id =  $routine->generateRequestId();
    //     });
    // }

    // public function generateRequestId()
    // {
    //     $request_id = rand(10000000, 99999999);

    //     while (self::where('request_id', $request_id)->exists()) {
    //         $this->generateRequestId();
    //     }

    //     return $request_id;
    // }
}
