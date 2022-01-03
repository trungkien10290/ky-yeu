<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\BugCateService;
use App\Services\CategoryService;
use App\Services\ProjectService;

class HomeController extends Controller
{
    protected $categoryService;
    protected $bannerService;
    protected $projectService;
    protected $bugCateService;

    public function __construct(CategoryService $categoryService, BannerService $bannerService, ProjectService $projectService, BugCateService $bugCateService)
    {
        $this->categoryService = $categoryService;
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
        $this->bugCateService = $bugCateService;
    }


    public function index()
    {
        url_change_lang();
        $assign['bugCates'] = $this->bugCateService->getCategroy();
        $assign['projects'] = $this->projectService->getAllActive();
        $assign['banners'] = $this->bannerService->homeList();
        $assign['otherCate'] = $this->categoryService->otherCategory();
        return view('public.home.index', $assign);
    }
}
