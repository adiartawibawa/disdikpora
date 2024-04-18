<?php

namespace App\Concerns;

use App\Models\Organisation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Multitenantable
{
    /**
     * Boot the trait
     */
    protected static function bootMultitenantable(): void
    {
        if (auth()->user() && !(auth()->user()->hasRole(['super_admin', 'admin']))) {

            static::addGlobalScope('organisation', function (Builder $query) {
                if (auth()->check() && (auth()->user()->organisation_id !== null)) {
                    $query->where('organisation_id', auth()->user()->organisation_id);
                    // or with a `organisation` relationship defined:
                    $query->whereBelongsTo(auth()->user()->organisation);
                }
            });
        }


        static::creating(function (Model $model) {
            if (auth()->check() && !(auth()->user()->hasRole(['super_admin', 'admin']))) {
                if (empty($model->organisation_id)) {

                    $organisationId = auth()->user()?->organisation_id;

                    if (is_null($organisationId)) {
                        throw new Exception($model);
                    }

                    // or with a `organisation` relationship defined:
                    $model->organisation()->associate($organisationId);
                }
            }
        });
    }

    /**
     * Relationship
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }
}
