<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'crp_id','client_id','notes'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->crp_id = auth()->user()->crp_id;
        });

        static::addGlobalScope('crp', function ($query) {
            if (auth()->check()) {
                $query->where('crp_id', auth()->user()->crp_id);
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
