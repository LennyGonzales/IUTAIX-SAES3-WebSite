<?php


use PHPUnit\Framework\TestCase;

include_once '../Core/AutoLoad.php';
class RandomTokenGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $randomTokenGenerator = new RandomTokenGenerator();
        $this->assertIsInt($randomTokenGenerator->generate());
    }

    public function testGenerateIsBetween100000And999999()
    {
        $randomTokenGenerator = new RandomTokenGenerator();
        $this->assertGreaterThanOrEqual(100000, $randomTokenGenerator->generate());
        $this->assertLessThanOrEqual(999999, $randomTokenGenerator->generate());
    }


}
