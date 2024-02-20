<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blueprint::macro('organisation', function () {
            return tap(
                $this->foreignUuid('organisation_id'),
                fn (ForeignIdColumnDefinition $column) =>
                $column
                    ->constrained()
                    ->cascadeOnDelete()
            );
        });

        Blueprint::macro('dropOrganisation', function () {
            $this->dropForeign(['organisation_id']);
            $this->dropColumn('organisation_id');

            return $this;
        });
    }
}
