<?php

namespace StudyCli;

use StudyCli\Command\CommandCall;

interface ControllerInterface
{

    public function boot(App $app);

    public function run(CommandCall $input);

    public function tearDown();

}