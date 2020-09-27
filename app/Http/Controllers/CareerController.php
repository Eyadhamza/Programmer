<?php

namespace App\Http\Controllers;

use App\Http\Resources\CareerResource;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        return CareerResource::collection(Career::all());
    }
    public function show(Career $career)
    {
        return new CareerResource($career);
    }
}
