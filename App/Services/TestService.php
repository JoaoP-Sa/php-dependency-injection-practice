<?php

namespace App\Services;

class Test {
    public function __construct() {}
}

class TestTwo {
    public function __construct(Test $test){}
}

class TestService
{
    public function __construct(TestTwo $testTwo) {}
}
