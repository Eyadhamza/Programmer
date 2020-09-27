<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        return BlogResource::collection(Blog::all());
    }
    public function show(Blog $career)
    {
        return new BlogResource($career);
    }
}
