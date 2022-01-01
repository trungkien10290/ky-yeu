<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Project;
use App\Services\BannerService;
use App\Services\CategoryService;

class HomeController extends Controller
{
    protected $categoryService;
    protected $bannerService;

    public function __construct(CategoryService $categoryService,BannerService $bannerService)
    {
        $this->categoryService = $categoryService;
        $this->bannerService = $bannerService;
    }


    public function index()
    {
        // $assign['projectCategories'] = $this->categoryService->homeList();
        $assign['projects'] = Project::active()->get();
        $assign['banners'] = $this->bannerService->homeList();
        $assign['other_category'] = $this->categoryService->otherCategory();
        return view('public.home.index', $assign);
    }
}
