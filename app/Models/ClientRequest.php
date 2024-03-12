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
        return $this->belongsTo(Registration::class, 'client_id');
    }

    public function salesType()
    {
        return $this->belongsTo(SalesType::class, 'sales_type_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
