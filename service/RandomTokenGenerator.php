<?php

class RandomTokenGenerator
{
    public function generate():int {
        return rand(100000, 999999);
    }
}