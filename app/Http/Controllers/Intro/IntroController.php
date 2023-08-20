<?php

namespace App\Http\Controllers\Intro;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class IntroController extends Controller
{
    public function intro(): Renderable
    {
        return view('intro');
    }
}
