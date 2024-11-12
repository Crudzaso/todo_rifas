<?php

public function index()
{
    $raffles = Raffle::all();
    return view('admin.raffles.index', compact('raffles'));
}
