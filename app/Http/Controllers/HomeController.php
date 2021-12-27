<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Project;
use App\Services\CategoryService;

class HomeController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function index()
    {
//        $assign['projectCategories'] = $this->categoryService->homeList();
        $assign['projects'] = Project::active()->get();
        $assign['banners'] = Banner::active()->get();
        return view('public.home.index', $assign);
    }
}
