<?php

namespace App\Constants;
class AppConstants
{
    const ADMIN_DEFAULT_LANGUAGE = 'vi';
    const PUBLIC_DEFAULT_LANGUAGE = 'vi';
    const PERMISSION_VIEW = '.view';
    const PERMISSION_CREATE = '.create';
    const PERMISSION_DELETE = '.delete';
    const PERMISSION_EDIT = '.edit';

    const CATEGORY_TYPE_OTHER = 'other';
    const CATEGORY_TYPE_PROJECT = 'project';
    const CATEGORY_TYPE_BUG = 'bug';
    const CATEGORY_TYPES = [
        self::CATEGORY_TYPE_PROJECT => 'Danh mục dự án',
        self::CATEGORY_TYPE_OTHER => 'Danh mục khác',
        self::CATEGORY_TYPE_BUG => 'Danh mục lỗi'
    ];
    const CATEGORY_TYPE_DEFAULT = self::CATEGORY_TYPE_BUG;

    const UPLOAD_FILE_ACCEPT = 'image/gif, image/jpeg, image/png,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    const UPLOAD_FILE_RULES = 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,doc,pdf,ppx';
}
