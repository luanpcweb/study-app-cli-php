<?php

namespace StudyCli\Output;

interface OutputFilterInterface
{
    public function filter($message, $style = null);
}