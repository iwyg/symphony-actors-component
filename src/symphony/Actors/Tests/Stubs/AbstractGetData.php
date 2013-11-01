<?php

namespace symphony\Actors\Tests\Stubs;

use \StdClass;
use symphony\Actors\Actor;
use symphony\Actors\Dom\DOMDocument;

abstract class AbstractGetData implements Actor
{
    protected $input;
    protected $output;

    public function __construct(StdClass $input, DOMDocument $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function executable()
    {
        return true;
    }

    public function ready($final = false)
    {
        return true;
    }
}
