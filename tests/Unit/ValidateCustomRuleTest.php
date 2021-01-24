<?php

namespace Tests\Unit;

use App\Rules\EmptyArray;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\TestCase;

class ValidateCustomRuleTest extends TestCase
{
    protected $rule;


    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new EmptyArray();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validation_fails_when_array_returns_null()
    {
        $data = [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ];
        $this->assertFalse($this->rule->passes('youtube', $data));
    }


    public function test_validation_fails_when_there_are_doubles_in_the_data()
    {
        $data = [
            'test',
            'test',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ];
        $this->assertFalse($this->rule->passes('youtube', $data));
    }

    public function test_validation_EmptyArray()
    {
        $data = [
            'test',
            'test0',
            'test1',
            'test2',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ];
        $this->assertTrue($this->rule->passes('youtube', $data));
    }
}
