<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\School;
use App\Models\SchoolClass;
use App\Policies\SchoolClassPolicy;
use App\Policies\SchoolPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        School::class => SchoolPolicy::class,
        SchoolClass::class => SchoolClassPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
