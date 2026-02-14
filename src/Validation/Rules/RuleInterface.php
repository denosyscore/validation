<?php

declare(strict_types=1);

namespace Denosys\Validation\Rules;

/**
 * Interface for validation rules
 */
interface RuleInterface
{
    /**
     * Validate a value against this rule
     *
     * @param string $field
     * @param mixed $value
     * @param array<int, string> $parameters
     * @param array<string, mixed> $data
     *
     * @return bool
     */
    public function validate(string $field, mixed $value, array $parameters = [], array $data = []): bool;

    /**
     * Get the validation error message
     *
     * @param string $field
     * @param array<int, string> $parameters
     *
     * @return string
     */
    public function message(string $field, array $parameters = []): string;

    /**
     * Return the list of parameter names, in order.
     *
     * @return array<int, string>
     */
    public static function parameterNames(): array;

    public static function ruleName(): string;
}

