<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Models\Project;
use App\Services\BugService;
use App\Services\CategoryService;
use App\Services\ProjectService;

class ProjectController extends Controller
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

    public function show($slug, $id)
    {
        $assign['project'] = $project = Project::findOrFail($id);
        $assign['otherProjects'] = $this->projectService->otherProjects($id);
        Seo::setting([
            'title' => $project->trans('title'),
            'description' => $project->trans('desc'),
            'thumbnail' => image($project->thumbnail),
        ]);
        $assign['urlLangChange'] = $project->slugLinkChange;
        return view('public.project.show', $assign);
    }
}
