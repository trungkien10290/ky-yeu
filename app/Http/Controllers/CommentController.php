<?php

namespace App\Http\Controllers;

use App\Constants\AppConstants;
use App\Services\BugService;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;
    protected $bugService;

    public function __construct(CommentService $commentService, BugService $bugService)
    {
        $this->commentService = $commentService;
        $this->bugService = $bugService;
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'bug_id' => 'required',
            'files' => [
                'nullable',
            ],
            'files.*' => AppConstants::UPLOAD_FILE_RULES
        ]);
        if (!$this->bugService->findOrFail($request->bug_id)) {
            return [
                'type' => 'warning',
                'message' => 'Không tìm thấy lỗi',
                'html' => ''
            ];
        }
        $data['bug_id'] = $request->bugId;
        $data['content'] = $request->content;
        if (!auth()->user()->id) {
            return [
                'type' => 'warning',
                'message' => 'Vui lòng đăng nhập để tiếp tục',
                'html' => ''
            ];
        }
        $data['user_id'] = auth()->user()->id;
        if (!empty($request->file('files'))) {
            $files = [];
            $images = [];
            $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
            foreach ($request->file('files') as $key => $file) {
                $filename = time() . '-' . $file->getClientOriginalName();

                if (in_array($file->mimeType(), $allowedMimeTypes)) {
                    $file->move(storage_path('app/public/images'), $filename);
                    $images[] = storage_path('app/public/images/') . $filename;
                } else {
                    $file->move(storage_path('app/public/files'), $filename);
                    $files[] = storage_path('app/public/files/') . $filename;
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

        return [
            'type' => 'success',
            'message' => '',
            'html' => view('comment.blade.php', $assign)->render()
        ];
    }
}
