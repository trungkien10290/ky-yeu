<?php

namespace App\Constants;
class AppConstants
{
    const ADMIN_DEFAULT_LANGUAGE = 'vi';
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
        self::CATEGORY_TYPE_BUG => 'Danh mục bug'
    ];
    const CATEGORY_TYPE_DEFAULT = self::CATEGORY_TYPE_BUG;
}
