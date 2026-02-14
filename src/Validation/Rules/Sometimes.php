<?php

declare(strict_types=1);

namespace CFXP\Core\Validation\Rules;

use CFXP\Core\Validation\Rules\RuleInterface;

class Sometimes implements RuleInterface
{
    /**
     * @param array<int, string> $parameters
     * @param array<string, mixed> $data
     */
    public function validate(string $field, mixed $value, array $parameters = [], array $data = []): bool
    {
        return true; // Sometimes is handled specially
    }

    /**
     * @param array<int, string> $parameters
     */
    public function message(string $field, array $parameters = []): string
    {
        return '';
    }

    /**

     * @return array<int, string>

     */

public static function parameterNames(): array

    {
        return [];
    }

    public static function ruleName(): string
    {
        return 'sometimes';
    }
}
