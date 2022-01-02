<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Project;
use App\Services\BannerService;
use App\Services\CategoryService;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $categoryService;
    protected $bannerService;
    protected $projectService;

    public function __construct(CategoryService $categoryService,BannerService $bannerService,ProjectService $projectService)
    {
        $this->categoryService = $categoryService;
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
    }


    public function index()
    {
        $assign['projects'] = $this->projectService->getAllActive();
        $assign['banners'] = $this->bannerService->homeList();
        $assign['other_category'] = $this->categoryService->otherCategory();
        return view('public.home.index', $assign);
    }
}
