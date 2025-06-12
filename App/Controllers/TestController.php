<?php

namespace App\Controllers;

use App\Services\TestService;

class TestController
{
    public function __construct(TestService $service) {}
}
