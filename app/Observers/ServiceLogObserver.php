<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\ServiceLog;

class ServiceLogObserver
{
    /**
     * Handle the ServiceLog "created" event.
     */
    public function created(ServiceLog $serviceLog): void
    {
        AuditLog::create([
            'crp_id' => $serviceLog->crp_id,
            'action' => 'created',
            'model_type' => 'ServiceLog',
            'model_id' => $serviceLog->id,
            'new_values' => $serviceLog->toArray(),
        ]);
    }

    /**
     * Handle the ServiceLog "updated" event.
     */
    public function updated(ServiceLog $serviceLog): void
    {
        AuditLog::create([
            'crp_id' => $serviceLog->crp_id,
            'action' => 'updated',
            'model_type' => 'ServiceLog',
            'model_id' => $serviceLog->id,
            'old_values' => json_encode($serviceLog->getOriginal()),
            'new_values' => json_encode($serviceLog->getChanges()),
        ]);
    }

    /**
     * Handle the ServiceLog "deleted" event.
     */
    public function deleted(ServiceLog $serviceLog): void
    {
        AuditLog::create([
            'crp_id' => $serviceLog->crp_id,
            'action' => 'deleted',
            'model_type' => 'ServiceLog',
            'model_id' => $serviceLog->id,
            'new_values' => $serviceLog->toArray(),
        ]);
    }

    /**
     * Handle the ServiceLog "restored" event.
     */
    public function restored(ServiceLog $serviceLog): void
    {
        //
    }

    /**
     * Handle the ServiceLog "force deleted" event.
     */
    public function forceDeleted(ServiceLog $serviceLog): void
    {
        //
    }
}
