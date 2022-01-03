<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Services\BugService;
use App\Services\CategoryService;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class BugController extends Controller
{
    protected $categoryService;
    protected $projectService;
    protected $bugService;

    public function __construct(CategoryService $categoryService, ProjectService $projectService, BugService $bugService)
    {
        $this->categoryService = $categoryService;
        $this->projectService = $projectService;
        $this->bugService = $bugService;
    }

    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $assign['projects'] = $this->projectService->getAllActive();
        $assign['projectDetail'] = $this->projectService->find($request->project_id);
        $assign['bugCategories'] = $this->categoryService->bugCategory();
        $assign['listBugs'] = $this->bugService->paginate();
        return view('public.bug.index', $assign);
    }

    public function modal(Bug $bug)
    {
        $bug->load(['category', 'project', 'comments' => function ($query) {
            return $query->with('user')->orderByDesc('id');
        }]);
        return view('public.bug.modal', ['bug' => $bug]);
    }

    
}
