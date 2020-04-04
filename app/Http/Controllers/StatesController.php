<?php

namespace App\Http\Controllers;

use App\Http\Resources\Link;
use App\State;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function index()
    {
        return Link::collection(State::query()->paginate(10));
    }
}
