<?php

declare(strict_types=1);

namespace CFXP\Core\Validation\Rules;

use InvalidArgumentException;

class Regex implements RuleInterface
{
    /**
     * @param array<int, string> $parameters
     * @param array<string, mixed> $data
     */
    public function validate(string $field, mixed $value, array $parameters = [], array $data = []): bool
    {
        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        if (!isset($parameters[0])) {
            throw new InvalidArgumentException('Regex rule requires a pattern parameter');
        }

        $pattern = $parameters[0];

        // Add delimiters if not present
        if (!preg_match('/^[\/#~]/', $pattern)) {
            $pattern = '/'.$pattern.'/';
        }

        return preg_match($pattern, (string) $value) === 1;
    }

    /**
     * @param array<int, string> $parameters
     */
    public function message(string $field, array $parameters = []): string
    {
        return 'The :attribute format is invalid.';
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
        return 'regex';
    }
}
