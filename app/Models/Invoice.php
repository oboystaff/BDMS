<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class Invoice extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function client()
    {
        return $this->belongsTo(Registration::class, 'client_id', 'reg_id');
    }

    public function clientSale()
    {
        return $this->belongsTo(ClientRequestSale::class, 'sale_id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sales_id', 'sales_id');
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
            $routine->invoice_id =  $routine->generateInvoiceId();
        });
    }

    public function generateInvoiceId()
    {
        $invoice_id = rand(10000000, 99999999);

        while (self::where('invoice_id', $invoice_id)->exists()) {
            $this->generateInvoiceId();
        }

        return $invoice_id;
    }
}
