<?php

namespace symphony\Actors\Tests\Stubs;

class GetArticles extends AbstractGetData
{
    public function execute($final = false)
    {
        $input = $this->input;
        $output = $this->output;

        $results = $output->createElement('get-articles');
        $output->documentElement->appendChild($results);

        foreach ($input->articles as $handle => $article) {
            $entry = $output->createElement('entry');
            $entry->setAttribute('handle', $handle);
            $results->appendChild($entry);

            foreach ($article as $name => $value) {
                $field = $output->createElement($name);
                $entry->appendChild($field);

                if (is_array($value) || is_object($value)) {
                    foreach ($value as $id) {
                        $item = $output->createElement('item');
                        $item->setAttribute('id', $id);
                        $field->appendChild($item);
                    }
                } else {
                    $text = $output->createTextNode($value);
                    $field->appendChild($text);
                }
            }
        }
    }
}
