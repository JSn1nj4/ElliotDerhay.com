<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsApiController extends Controller
{
    public function index(int $count = 10)
    {
        return Project::take($count)->get();
    }
}