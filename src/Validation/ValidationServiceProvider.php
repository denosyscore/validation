<?php

declare(strict_types=1);

namespace Denosys\Validation;

use Denosys\Container\ContainerInterface;
use Denosys\Database\Connection\Connection;
use Denosys\Contracts\ServiceProviderInterface;
use Denosys\Exceptions\ExceptionHandlerChain;
use Psr\EventDispatcher\EventDispatcherInterface;
use Denosys\Container\Exceptions\ContainerResolutionException;
use Denosys\Validation\Handlers\ValidationExceptionHandler;
use Throwable;

/**
 * Service provider for validation services
 */
class ValidationServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $ruleRegistrar = new RuleRegistrar(
            __DIR__ . DIRECTORY_SEPARATOR . 'Rules',
        );
        $ruleRegistrar->register();

        // Register validation exception handler
//        if ($container->has(ExceptionHandlerChain::class)) {
//            /** @var ExceptionHandlerChain $exceptionHandler */
//            $exceptionHandler = $container->get(ExceptionHandlerChain::class);
//
//            $logger = $container->has('logger') ? $container->get('logger') : null;
//            $debug = $container->has('config') ? $container->get('config')->get('app.debug', false) : false;
//            $environment = $container->has('config') ? $container->get('config')->get('app.env', 'production') : 'production';
//
//            $exceptionHandler->addHandler(
//                new ValidationExceptionHandler($logger, $debug, $environment)
//            );
//        }
    }

    public function boot(ContainerInterface $container, ?EventDispatcherInterface $dispatcher = null): void
    {
        // Register database-dependent rules with connection injection
        $this->registerDatabaseRules($container);
    }

    /**
     * Register validation rules that require database connection
     */
    private function registerDatabaseRules(ContainerInterface $container): void
    {
        // Register lazy factories to avoid resolving DB during application boot.
        Validator::extend('unique', function () use ($container) {
            $rule = new Rules\Unique();
            $this->attachConnectionIfAvailable($container, $rule);
            return $rule;
        });

        Validator::extend('exists', function () use ($container) {
            $rule = new Rules\Exists();
            $this->attachConnectionIfAvailable($container, $rule);
            return $rule;
        });
    }

    private function attachConnectionIfAvailable(ContainerInterface $container, Rules\Unique|Rules\Exists $rule): void
    {
        if (!$container->has('db')) {
            return;
        }

        try {
            $connection = $container->get('db');
        } catch (Throwable) {
            return;
        }

        if ($connection instanceof Connection) {
            $rule->setConnection($connection);
        }
    }

    /**
     * Register custom validation rules
     */
    private function registerCustomRules(): void
    {
        // Add any custom rules here
        // Validator::extend('custom_rule', CustomRule::class);
    }

    /**
     * Register view helpers for validation
     */
//    private function registerViewHelpers(ContainerInterface $container): void
//    {
//        $viewEngine = $container->get('view');
//
//        if (method_exists($viewEngine, 'directive')) {
//            // Register @error directive
//            $viewEngine->directive('error', function (string $expression): string {
/*                return "<?php if(isset(\$errors) && \$errors->has({$expression})): ?>";*/
//            });
//
//            $viewEngine->directive('enderror', function (): string {
/*                return "<?php endif; ?>";*/
//            });
//
//            // Register @errors directive for all errors
//            $viewEngine->directive('errors', function (): string {
/*                return "<?php if(isset(\$errors) && count(\$errors->all()) > 0): ?>";*/
//            });
//
//            $viewEngine->directive('enderrors', function (): string {
/*                return "<?php endif; ?>";*/
//            });
//        }
//    }
}
