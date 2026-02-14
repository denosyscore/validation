<?php

declare(strict_types=1);

namespace CFXP\Core\Validation;

use Exception;
use Throwable;

/**
 * Exception thrown when validation fails
 */
class ValidationException extends Exception
{
    public function __construct(
        public readonly Validator $validator,
        int $code = 422,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            $this->summarizeErrorMessages($validator),
            $code,
            $previous
        );
    }

    /**
     * Get validation errors
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    /**
     * @return array<array<string>>
     */
    public function getErrors(): array
    {
        return $this->validator->errors()->all();
    }

    /**
     * Get the first error message for a field
     */
    public function getFirstError(?string $field = null): ?string
    {
        if ($field === null) {
            foreach ($this->getErrors() as $errors) {
                if (is_array($errors) && count($errors) > 0) {
                    return $errors[0];
                }
            }

            return null;
        }

        return $this->validator->first($field);
    }

    private function summarizeErrorMessages(Validator $validator): string
    {
        $messages = $validator->errors()->all();

        if (empty($messages) || !is_string($messages[0])) {
            return 'Validation failed.';
        }

        $total = count($messages);
        $first = array_shift($messages);
        $others = $total - 1;

        if ($others > 0) {
            $plural = $others === 1 ? 'error' : 'errors';
            $first .= " (and {$others} other {$plural})";
        }

        return $first;
    }
}
