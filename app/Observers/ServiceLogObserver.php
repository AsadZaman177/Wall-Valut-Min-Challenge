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
            'new_values' => [
                'id' => $serviceLog->id,
                'notes' => $serviceLog->notes,
                'client' => trim(
                    ($serviceLog->client->first_name ?? '') . ' ' . ($serviceLog->client->last_name ?? '')
                ),
                'file_path' => $serviceLog->file_path,
                'created_at' => $serviceLog->created_at,
                'updated_at' => $serviceLog->updated_at,
            ],
        ]);
    }

    /**
     * Handle the ServiceLog "updated" event.
     */
    public function updated(ServiceLog $serviceLog): void
    {
        $old = $serviceLog->getOriginal();
        $new = $serviceLog->getChanges();

        // Replace client_id with client name
        if (isset($old['client_id'])) {
            $old['client'] = trim(
                ($serviceLog->client->first_name ?? '') . ' ' . ($serviceLog->client->last_name ?? '')
            );
            unset($old['client_id']);
        }

        if (isset($new['client_id'])) {
            $new['client'] = trim(
                ($serviceLog->client->first_name ?? '') . ' ' . ($serviceLog->client->last_name ?? '')
            );
            unset($new['client_id']);
        }

        AuditLog::create([
            'crp_id' => $serviceLog->crp_id,
            'action' => 'updated',
            'model_type' => 'ServiceLog',
            'model_id' => $serviceLog->id,
            'old_values' => $old,
            'new_values' => $new,
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
            'new_values' => [
                'id' => $serviceLog->id,
                'notes' => $serviceLog->notes,
                'client' => trim(
                    ($serviceLog->client->first_name ?? '') . ' ' . ($serviceLog->client->last_name ?? '')
                ),
                'file_path' => $serviceLog->file_path,
                'created_at' => $serviceLog->created_at,
                'updated_at' => $serviceLog->updated_at,
            ],
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
