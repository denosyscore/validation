<?php

declare(strict_types=1);

namespace CFXP\Core\Validation\Rules;

use InvalidArgumentException;

class Confirmed implements RuleInterface
{
    /**
     * @param array<int, string> $parameters
     * @param array<string, mixed> $data
     */
    public function validate(string $field, mixed $value, array $parameters = [], array $data = []): bool
    {
        $confirmationField = $parameters['custom_field'] ?: $field . '_confirmation';

        if (!array_key_exists($confirmationField, $data)) {
            throw new InvalidArgumentException(
                "The confirmation field [{$confirmationField}] does not exist."
            );
        }

        return $value === $data[$confirmationField];
    }

    /**
     * @param array<int, string> $parameters
     */
    public function message(string $field, array $parameters = []): string
    {
        return "The :attribute confirmation does not match.";
    }

    /**

     * @return array<int, string>

     */

public static function parameterNames(): array

    {
        return ['custom_field'];
    }

    public static function ruleName(): string
    {
        return 'confirmed';
    }
}
