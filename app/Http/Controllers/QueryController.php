<?php

namespace App\Http\Controllers;

use App\Olx\Query;
use App\State;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function index(State $state, Request $request)
    {
        return (new Query($state))
            ->search($request->q)
            ->toArray();
    }
}
