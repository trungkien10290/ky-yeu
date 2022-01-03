<?php

namespace App\Http\Controllers;

use App\Services\BugService;
use App\Services\CategoryService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;
    protected $categoryService;
    protected $bugService;
    public function __construct(ProjectService $projectService,CategoryService $categoryService,BugService $bugService)
    {
        $this->projectService = $projectService;
        $this->categoryService = $categoryService;
        $this->bugService = $bugService;
    }
    public function show(Request $request)
    {
        $assign['projects'] = $this->projectService->getAllActive();
        $assign['projectDetail'] = $this->projectService->find($request->project_id);
        $assign['bugCategories'] = $this->categoryService->bugCategory();
        $assign['listBugs'] = $this->bugService->paginate();
        return view('public.bug.index',$assign);
    }
}
