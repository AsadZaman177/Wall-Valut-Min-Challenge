<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'crp_id','action','model_type','model_id','old_values','new_values'
    ];

    protected $casts = [
    'new_values' => 'array',
    'old_values' => 'array',
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
}
