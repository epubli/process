<?php

namespace Epubli\Process;

use PHPUnit\Framework\TestCase;

class ProcessBuilderFactoryTest extends TestCase
{
    /** @var ProcessBuilderFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new ProcessBuilderFactory();
    }

    /**
     * @expectedException \Epubli\Process\Exception
     * @expectedExceptionMessage No process builder class registered for key footool.
     */
    public function testCreateThrowsExceptionWithUnknownKey()
    {
        $this->factory->create('footool');
    }

    /**
     * @expectedException \Epubli\Process\Exception
     * @expectedExceptionMessage Process builder class FooProcessBuilder does not exist.
     */
    public function testCreateThrowsExceptionWithBuilderClass()
    {
        $this->factory->register('footool', 'FooProcessBuilder');
        $this->factory->create('footool');
    }
}
