<?php

declare(strict_types=1);

namespace Tests\Unit;

class UnitTest extends AbstractUnitTest
{
    protected function setUp(): void
    {
        parent::setUp();

        //some setup mocks
    }

    public function testTestCase(): void
    {
        $this->assertEquals(
            "roman",
            "roman",
            "This will pass"
        );

        $this->assertEquals(
            "hope",
            "ava",
            "This will fail"
        );
    }
}