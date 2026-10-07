<?php

declare(strict_types=1);

namespace Denosys\Validation\Tests;

use Denosys\Validation\Rules\Confirmed;
use Denosys\Validation\Rules\Regex;
use Denosys\Validation\Validator;
use PHPUnit\Framework\TestCase;

final class RuleContractsTest extends TestCase
{
    protected function setUp(): void
    {
        Validator::extend('confirmed', Confirmed::class);
        Validator::extend('regex', Regex::class);
    }

    protected function tearDown(): void
    {
        Validator::reset();
    }

    public function testMissingConfirmationProducesAFieldError(): void
    {
        $validator = Validator::make(
            ['password' => 'example-secret'],
            ['password' => 'confirmed'],
        );

        self::assertFalse($validator->validate());
        self::assertTrue($validator->errors()->has('password'));

        $custom = Validator::make(
            ['password' => 'example-secret'],
            ['password' => 'confirmed:repeat_password'],
        );

        self::assertFalse($custom->validate());
        self::assertTrue($custom->errors()->has('password'));
    }

    public function testConfirmationStillAcceptsMatchingDefaultAndCustomFields(): void
    {
        self::assertTrue(Validator::make(
            ['password' => 'example-secret', 'password_confirmation' => 'example-secret'],
            ['password' => 'confirmed'],
        )->validate());

        self::assertTrue(Validator::make(
            ['password' => 'example-secret', 'repeat_password' => 'example-secret'],
            ['password' => 'confirmed:repeat_password'],
        )->validate());
    }

    public function testParameterizedRegexReceivesPatternThroughValidator(): void
    {
        self::assertTrue(Validator::make(
            ['date' => '2026-10-07'],
            ['date' => 'regex:/^\\d{4}-\\d{2}-\\d{2}$/'],
        )->validate());

        $invalid = Validator::make(
            ['date' => 'not-a-date'],
            ['date' => 'regex:/^\\d{4}-\\d{2}-\\d{2}$/'],
        );

        self::assertFalse($invalid->validate());
        self::assertTrue($invalid->errors()->has('date'));
    }

    public function testRegexStillAcceptsPositionalPatternWhenCalledDirectly(): void
    {
        self::assertTrue((new Regex())->validate('code', 'ABC-123', ['/^ABC-\\d{3}$/']));
    }
}
