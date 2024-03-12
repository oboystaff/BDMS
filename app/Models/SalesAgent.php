<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesPrimaryUuid;

class SalesAgent extends Model
{
    use HasFactory, UsesPrimaryUuid;

    protected $guarded = [
        'id',
    ];

    public function territory()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $routine) {
            $routine->agent_id = 'SA' . $routine->generateAgentId();
        });
    }

    public function generateAgentId()
    {
        $agent_id = rand(100000, 999999);

        while (self::where('agent_id', $agent_id)->exists()) {
            $this->generateAgentId();
        }

        return $agent_id;
    }
}
