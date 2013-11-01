<?php

/**
 * This File is part of the src\symphony\Tests\Actors package
 *
 * (c) Thomas Appel <mail@thomas-appel.com>
 *
 * For full copyright and license information, please refer to the LICENSE file
 * that was distributed with this package.
 */

namespace symphony\Actors\Tests;

use \StdClass;
use symphony\Actors\Dom\DOMDocument;
use symphony\Actors\ExecutionIterator;
use symphony\Actors\Tests\Stubs\GetImages;
use symphony\Actors\Tests\Stubs\GetArticles;
use symphony\Actors\Tests\Stubs\AbstractGetData;

class ActorsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassName
     */
    protected $output;

    protected $input;

    protected function setUp()
    {
        $this->input = json_decode(file_get_contents(__DIR__.'/Stubs/data/xpath-based.json'));
        $this->output = new DOMDocument;
        $this->output->load(__DIR__.'/Stubs/data/xpath-based.xml');
    }

    /**
     * @test
     */
    public function testIteratorGenerateXml()
    {
        $actors = new ExecutionIterator(
            [
                new GetImages($this->input, $this->output),
                new GetArticles($this->input, $this->output)
            ]
        );

        while ($actors->execute()) {
            // Just wait for it... or run additional tests.
        }

        $this->assertXmlStringEqualsXmlString(
            file_get_contents(__DIR__.'/Stubs/data/expected.data.xml'),
            $this->output->saveXML()
        );
    }

    protected function tearDown()
    {

    }
}
