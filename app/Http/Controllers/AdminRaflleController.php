<?php
class AdminController extends Controller{

    public function index()
{
    $raffles = Raffle::all();
    return view('admin.raffles.index', compact('raffles'));
}
}


