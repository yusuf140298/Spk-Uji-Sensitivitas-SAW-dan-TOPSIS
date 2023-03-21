<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page'){
			$page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
			return new LengthAwarePaginator(
				$this->forPage($page, $perPage),
				$total ?: $this->count(),
				$perPage,
				$page,
				[
					'path' => LengthAwarePaginator::resolveCurrentPath(),
					'pageName' => $pageName,
				]
				);
		});
        Paginator::useBootstrap();

		Gate::define('Administrator', function(User $user){
			return $user->role->role == 'Administrator';
		});
    }
}
