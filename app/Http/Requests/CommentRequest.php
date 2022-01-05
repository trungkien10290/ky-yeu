<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bug_id' => 'required',
            'content' => 'required',
            'files' => [
                'nullable',
            ],
            'files.*' => [
                'nullable',
                'mimes:png,jpg,jpeg,csv,txt,xlx,xls,doc,pdf,ppx,mp4',
                'max:10000'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'content' => __('public.feedback'),
            'files.*' => 'File'
        ];
    }
}
