<?php

interface UsersAccessInterface
{
    const DATABASE = 'USERS';

    public static function checkIfExistsByEmail(string $S_email = null):bool;

    public static function create(array $A_values = null):bool;

    public static function createAccount(Array $A_parameters):array;

    public static function selectByEmail(array $A_parameters = null):array;

    public static function getUser(string $email, string $password):?User;
}