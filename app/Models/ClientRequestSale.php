<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class ClientRequestSale extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function clientRequest()
    {
        return $this->belongsTo(ClientRequest::class, 'request_id');
    }

    public function agent()
    {
        return $this->belongsTo(SalesAgent::class, 'agent_id');
    }
}
