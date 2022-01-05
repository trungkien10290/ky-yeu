<?php

namespace App\Http\Controllers;

use App\Constants\AppConstants;
use App\Http\Requests\CommentRequest;
use App\Services\BugService;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    protected $commentService;
    protected $bugService;

    public function __construct(CommentService $commentService, BugService $bugService)
    {
        $this->commentService = $commentService;
        $this->bugService = $bugService;
    }

    public function create(CommentRequest $request)
    {
        $data = $request->validated();
        if (!$this->bugService->findOrFail($request->bug_id)) {
            return [
                'type' => 'warning',
                'message' => 'Không tìm thấy lỗi',
                'html' => ''
            ];
        }

        if (!auth()->user()->id) {
            return [
                'type' => 'warning',
                'message' => 'Vui lòng đăng nhập để tiếp tục',
                'html' => ''
            ];
        }
        $data['user_id'] = auth()->user()->id;
        $files = [];
        $images = [];
        if (!empty($request->file('files'))) {
            $imageTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
            $folder = 'user_uploads/' . auth()->user()->id;
            foreach ($request->file('files') as $file) {
                $uploaded = Storage::disk('public')->put($folder, $file);
                $publicFilePath = '/storage/' . $uploaded;
                if (in_array($file->getClientMimeType(), $imageTypes)) {
                    $images[] = $publicFilePath;
                } else {
                    $files[] = $publicFilePath;
                }
            }
        }
        $data['images'] = $images;
        $data['files'] = $files;
        $data['is_active'] = 1;
        $comment = $this->commentService->save($data);
        return [
            'type' => 'success',
            'message' => '',
            'html' => view('public.bug.comment', compact('comment'))->render()
        ];
    }
}
