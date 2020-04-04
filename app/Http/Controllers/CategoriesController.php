<?php

namespace App\Http\Controllers;

use App\Http\Resources\Link;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return Link::collection(Category::query()->paginate(10));
    }
}
