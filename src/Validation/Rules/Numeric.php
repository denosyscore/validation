<?php

declare(strict_types=1);

namespace CFXP\Core\Validation\Rules;

/**
 * Numeric validation rule
 */
class Numeric implements RuleInterface
{
    /**
     * @param array<int, string> $parameters
     * @param array<string, mixed> $data
     */
    public function validate(string $field, mixed $value, array $parameters = [], array $data = []): bool
    {
        return is_numeric($value);
    }

    /**
     * @param array<int, string> $parameters
     */
    public function message(string $field, array $parameters = []): string
    {
        return "The :attribute must be a number.";
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
        return 'numeric';
    }
}
