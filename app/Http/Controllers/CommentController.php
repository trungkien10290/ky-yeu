<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Encore\Admin\Form\Field\Id;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function create(Request $request)
    {
        $data['bug_id'] = $request->bugId;
        $data['content'] = $request->content;
        $data['user_id'] = auth()->user()->id;
        if (!empty($request->file('files'))) {
            $files = [];
            $images = [];
            $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
            foreach ($request->file('files') as $key => $file) {
                $filename = time().'-'.$file->getClientOriginalName();
                
                if (in_array($file->mimeType(), $allowedMimeTypes)) {
                    $file->move(storage_path('app/public/images'), $filename);
                    $images[] = storage_path('app/public/images/').$filename;
                } else {
                    $file->move(storage_path('app/public/files'), $filename);
                    $files[] = storage_path('app/public/files/').$filename;
                }
            }
            if ($images) {
                $data['images'] = json_encode($images);
            }
            if ($files) {
                $data['files'] = json_encode($files);
            }
        }
        $this->commentService->save($data);
        $assign['comment'] = $data;
        return view('public.bug.comment', $assign);
    }
}
