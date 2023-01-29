<?php

final class HomeController
{
    public function defaultAction() {
        View::show("home/home");
    }
}