<?php

interface UsersAccessInterface
{
    const DATABASE = 'USERS';

    public function create(array $A_values = null):bool;

    public function getByEmail(string $S_email = null):?User;

    public function getByEmailAndPassword(string $email, string $password):?User;

    public function update(array $A_values = null):bool;

    public function getLeaderboard():?array;
}