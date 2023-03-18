<?php

interface RetrievePasswordAccessInterface
{
    const DATABASE = 'USERS';

    public function create(Array $A_values = null):bool;

    public function getByEmail(string $S_email = null):?RetrievePassword;

    public function update(Array $A_values = null):bool;

    public function delete(string $S_email = null):bool;
}