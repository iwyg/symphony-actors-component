<?php

namespace symphony\Actors\Tests\Stubs;

class GetImages extends AbstractGetData
{
    const QUERY = '//images/item/@id';

    public function ready($final = false)
    {
        return $this->output->getXpath()->evaluate('boolean(' . self::QUERY . ')');
    }

    public function execute($final = false)
    {
        $input = $this->input;
        $output = $this->output;

        $results = $output->createElement('get-images');
        $output->documentElement->appendChild($results);

        foreach ($this->output->xPath(self::QUERY) as $item) {

            if (isset($item->nodeValue) === false) {
                continue;
            }

            if (isset($input->images->{$item->nodeValue}) === false) {
                continue;
            }

            $entry = $output->createElement('entry');
            $entry->setAttribute('id', $item->nodeValue);
            $results->appendChild($entry);

            foreach ($input->images->{$item->nodeValue} as $name => $value) {
                $field = $output->createElement($name);
                $entry->appendChild($field);

                $text = $output->createTextNode($value);
                $field->appendChild($text);
            }
        }
    }
}
