<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class=>PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
         /*
            *create_post
            * edit post
            * delete post

          */
        // Gate::define('create_post', function(){
        //     return Auth::user()->is_admin ;
        // });
        
        // Gate::define('edit_post', function(){
        //     return Auth::user()->is_admin ;
        // });
        
        // Gate::define('delete_post', function(){
        //     return Auth::user()->is_admin ;
        // });
        
    }
}
