<?php

interface UsersNotVerifiedAccessInterface
{
    const DATABASE = 'USERS';

    public function create(array $A_values = null):bool;

    public function getByEmail(string $S_email = null):?UserNotVerified;

    public function deleteByEmail(string $S_email = null):bool;

    public function update(array $A_values = null):bool;


}