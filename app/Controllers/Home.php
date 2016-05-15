<?php

class Home extends Controller
{
    public function index()
    {
        $data = 'hello, mvc!';
        $this->view('Home/Home', ['data' => $data]);
    }
}