<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\BannerService;
use App\Services\BugCateService;
use App\Services\CategoryService;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use App\Services\ProjectCategoryStatisticService;

class HomeController extends Controller
{
    protected $categoryService;
    protected $bannerService;
    protected $projectService;
    protected $bugCateService;
    protected $projectCategoryStatisticService;

    public function __construct(
        CategoryService $categoryService,
        BannerService $bannerService,
        ProjectService $projectService,
        BugCateService $bugCateService,
        ProjectCategoryStatisticService $projectCategoryStatisticService
    ) {
        $this->categoryService = $categoryService;
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
        $this->bugCateService = $bugCateService;
        $this->projectCategoryStatisticService = $projectCategoryStatisticService;
    }


    public function index()
    {
        url_change_lang();
        $assign['bugCates'] = $this->bugCateService->getCategroy();
        $assign['projects'] = $this->projectService->getAllActive();
        $assign['banners'] = $this->bannerService->homeList();
        $assign['otherCate'] = $this->categoryService->otherCategory();
        $assign['projectCategoryStatistic'] = $this->projectCategoryStatisticService;
        return view('public.home.index', $assign);
    }
}
