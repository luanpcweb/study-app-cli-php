<?php

namespace StudyCli;

class Input
{

    protected $input_history = [];

    protected $prompt;

    public function __construct($prompt = 'studycli$> ')
    {
        $this->setPrompt($prompt);
    }

    public function read()
    {
        $input = readline($this->getPrompt());
        $this->input_history[] = $input;

        return $input;
    }

    public function getInputHistory()
    {
        return $this->input_history;
    }

    public function getPrompt()
    {
        return $this->prompt;
    }

    public function setPrompt(string $prompt)
    {
        $this->prompt = $prompt;
    }

}