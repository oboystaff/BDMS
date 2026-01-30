<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class Payment extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function client()
    {
        return $this->belongsTo(Registration::class, 'client_id', 'reg_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'invoice_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $routine) {
            $routine->payment_id =  $routine->generatePaymentId();
        });
    }

    public function generatePaymentId()
    {
        $payment_id = rand(10000000, 99999999);

        while (self::where('payment_id', $payment_id)->exists()) {
            $this->generatePaymentId();
        }

        return $payment_id;
    }
}
