<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Helpers\Setting;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Encore\Admin\Form;
use Encore\Admin\Form\Field;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $title = 'Post';

    protected $model = 'Post::class';


    protected $description = [
        'index' => 'Index',
        'show' => 'Show',
        'edit' => 'Edit',
        'create' => 'Create',
    ];

    public function index(Content $content)
    {

        return $content
            ->title('Cấu hình')
            ->description(' ')
            ->body($this->form());
    }

    public function submit(Request $request)
    {
        $data = \request()->all();
        $form = $this->form();
        if ($validationMessages = $form->validationMessages($data)) {
            return back()->withInput()->withErrors($validationMessages);
        }

        \setting()->save($data);

        admin_toastr(trans('admin.save_succeeded'));

        return back()->withInput();
    }


    public function form()
    {
        $post = new Post();
        $form = new Form($post);

        $data = (new Setting())->data();
        $form->setAction(route('admin.settings.save'));
        $form->tab('Thông tin chung', function (Form $form) {
            $form->image('logo', 'Logo');
            $form->image('favicon', 'Favicon');
            $form->text('Copyright', 'Copyright');
        });

        $form->tab('Mạng xã hội', function (Form $form) {
            $form->text('facebook')->rules('url');
            $form->text('instagram')->rules('url');
            $form->text('twitter')->rules('url');
            $form->text('linkedin')->rules('url');
        });
        $form->tab('SEO', function (Form $form) {
            $form->text('seo_title_vi', 'Tiêu đề SEO (tiếng việt)');
            $form->text('seo_keyword_vi', 'Từ khóa SEO (tiếng việt)');
            $form->textarea('seo_desc_vi', 'Mô tả SEO (tiếng việt)');
            $form->html('<hr>');
            $form->text('seo_title_en', 'Tiêu đề SEO (tiếng anh)');
            $form->text('seo_keyword_en', 'Từ khóa SEO (tiếng anh)');
            $form->textarea('seo_desc_en', 'Mô tả SEO (tiếng anh)');
        });
        $form->tab('Mã nhúng', function (Form $form) {
            $form->textarea('script_header');
            $form->textarea('script_footer');
        });

        $form->fields()->each(function (Field $field) use ($data) {
            $field->fill($data);
        });

        return $form;
    }
}
