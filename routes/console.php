<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-site', function () {
    $this->comment('A simple Laravel pages starter.');
})->purpose('Display a short description of this website');
