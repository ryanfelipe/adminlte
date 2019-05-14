<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use JWTAuth;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy'
      ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('somente-admin',function(User $user){
                if($user->permission == 'ADMIN'){
                       return true; 
                }
                return false;
        });

        Gate::define('api-proprio-perfil',function(User $user,$id){
            if($user->id == $id){
                return true;
            }
            abort(401,'Sem permissão');   
        });    


        //
    }
}
