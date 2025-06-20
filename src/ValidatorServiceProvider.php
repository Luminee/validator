<?php

namespace Luminee\Validator;

use Illuminate\Validation\ValidationServiceProvider as IlluminateValidationServiceProvider;
use Luminee\Validator\Console\Commands\MakeRequestCommand;
use Luminee\Validator\Console\Commands\MakeRuleCommand;
use Luminee\Validator\Validation\Factory;

class ValidatorServiceProvider extends IlluminateValidationServiceProvider
{
    public function register()
    {
        parent::register();

        $this->commands([
            MakeRequestCommand::class,
            MakeRuleCommand::class,
        ]);
    }

    /**
     * Register the validation factory.
     *
     * @return void
     */
    protected function registerValidationFactory()
    {
        $this->app->singleton('validator', function ($app) {
            $validator = new Factory($app['translator'], $app);

            // The validation presence verifier is responsible for determining the existence of
            // values in a given data collection which is typically a relational database or
            // other persistent data stores. It is used to check for "uniqueness" as well.
            if (isset($app['db'], $app['validation.presence'])) {
                $validator->setPresenceVerifier($app['validation.presence']);
            }

            return $validator;
        });
    }
}
