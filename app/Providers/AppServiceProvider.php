<?php

namespace App\Providers;

use App\Http\Middleware\ApiRequestLogging;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->when(\App\Services\ArticleService::class)
//                  ->needs(\App\Application\Repositories\RepositoryInterface::class)
//                  ->give(\App\Repositories\ArticleRepository::class);
        $this->app->singleton(ApiRequestLogging::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('int_or_array', function ($attribute, $value, $parameters, $validator) {
            return is_int($value) || is_array($value);
        });
        Validator::extend('string_or_array', function ($attribute, $value, $parameters, $validator) {
            return is_string($value) || is_array($value);
        });
        Validator::extend('boolean_or_string_as_bool', function ($attribute, $value, $parameters, $validator) {
            $booleanStringValue = ['true', 'false'];
            $booleanNumericValue = ['0', '1'];
            return in_array($value, $booleanStringValue) || in_array($value, $booleanNumericValue) || is_bool($value);
        });
    }
}
