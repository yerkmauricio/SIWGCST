<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }

    public function boot()
    {
        Validator::extend('no_repeated_chars', function ($attribute, $value, $parameters, $validator) {
            $maxRepeated = 3;

            for ($i = 0; $i < strlen($value) - $maxRepeated; $i++) {
                $repeated = true;
                for ($j = 0; $j < $maxRepeated; $j++) {
                    if ($value[$i + $j] !== $value[$i]) {
                        $repeated = false;
                        break;
                    }
                }
                if ($repeated) {
                    $validator->errors()->add($attribute, $attribute . ' contiene más de ' . $maxRepeated . ' caracteres repetidos seguidos.');
                     
                }
            }

            return true;
        });
    }
}
