<?php

interface UsersAccessInterface
{
    const DATABASE = 'USERS';

    public static function create(array $A_values = null):bool;

    public static function getByEmail(string $S_email = null):?User;

    public static function getByEmailAndPassword(string $email, string $password):?User;
}