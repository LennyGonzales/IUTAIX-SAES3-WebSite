<?php

interface QuestionsAccessInterface
{
    const DATABASE = "STORIES";

    public function getAll():?array;

    public function getQuestion(Array $A_values = null):?Question;

    public function create(Array $A_values = null):bool;

    public function update(Array $A_values = null):bool;

}