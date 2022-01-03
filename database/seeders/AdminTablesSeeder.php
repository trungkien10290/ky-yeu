<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "Dashboard",
                    "icon" => "fa-bar-chart",
                    "uri" => "/",
                    "permission" => null
                ],
                [
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "Admin",
                    "icon" => "fa-tasks",
                    "uri" => "",
                    "permission" => null
                ],
                [
                    "parent_id" => 2,
                    "order" => 3,
                    "title" => "Quản trị viên",
                    "icon" => "fa-users",
                    "uri" => "auth/users",
                    "permission" => null
                ],
                [
                    "parent_id" => 2,
                    "order" => 4,
                    "title" => "Nhóm quyền",
                    "icon" => "fa-user",
                    "uri" => "auth/roles",
                    "permission" => null
                ],
            //                [
            //                    "parent_id" => 2,
            //                    "order" => 5,
            //                    "title" => "Permission",
            //                    "icon" => "fa-ban",
            //                    "uri" => "auth/permissions",
            //                    "permission" => NULL
            //                ],
                [
                    "parent_id" => 2,
                    "order" => 6,
                    "title" => "Menu",
                    "icon" => "fa-bars",
                    "uri" => "auth/menu",
                    "permission" => null
                ],
                [
                    "parent_id" => 2,
                    "order" => 7,
                    "title" => "Logs",
                    "icon" => "fa-history",
                    "uri" => "auth/logs",
                    "permission" => null
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "name" => "All permission",
                    "slug" => "*",
                    "http_method" => "",
                    "http_path" => "*"
                ],
                [
                    "name" => "Dashboard",
                    "slug" => "dashboard",
                    "http_method" => "GET",
                    "http_path" => "/"
                ],
                [
                    "name" => "Login",
                    "slug" => "auth.login",
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout"
                ],
                [
                    "name" => "User setting",
                    "slug" => "auth.setting",
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting"
                ],
                [
                    "name" => "Auth management",
                    "slug" => "auth.management",
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "Administrator",
                    "slug" => "administrator"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 2
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 1,
                    "permission_id" => 1
                ]
            ]
        );

        DB::table('admin_users')->truncate();
        DB::table('admin_users')->insert(
            [
                [
                    "username" => 'admin',
                    "password" => bcrypt('admin'),
                    'name' => 'admin',
                    'remember_token' => Str::random(10)
                ]
            ]
        );
        DB::table('admin_role_users')->truncate();
        DB::table('admin_role_users')->insert(
            [
                [
                    "role_id" => 1,
                    "user_id" => 1,
                ]
            ]
        );

        DB::table('admin_users')->insert(
            [
                [
                    "username" => 'editor',
                    "password" => bcrypt('123qwe'),
                    'name' => 'admin',
                    'remember_token' => Str::random(10)
                ]
            ]
        );
        DB::table('admin_role_users')->truncate();
        DB::table('admin_role_users')->insert(
            [
                [
                    "role_id" => 1,
                    "user_id" => 1,
                ]
            ]
        );


        // finish
    }
}
