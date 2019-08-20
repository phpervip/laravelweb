<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use App\Models\ChinaArea;
use App\Models\User;


class UsersController extends AdminController
{
    use HasResourceActions;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\User';


    public function index(Content $content)
    {
        return $content
            ->header('用户列表')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->id('ID');
        $grid->username('用户名');
        $grid->email('邮箱');
        $grid->email_verified_at('已验证邮箱')->display(function($value){
            return $value ? '是' : '否';
        });
        $grid->sex('性别');
        $grid->created_at('注册时间');

         $grid->filter(function (Grid\Filter $filter) {

            $filter->disableIdFilter();

            $filter->like('username','用户');

            $filter->equal('address.province_id', '省份')
                ->select(ChinaArea::province()->pluck('name','id'))
                ->load('address.city_id', '/admin/api/china/city');

            // 三级联动无法使用
            $filter->equal('address.city_id', '城市')->select()
                ->load('address.district_id', '/admin/api/china/district');

            $filter->equal('address.district_id', '地区')->select();

        });

        $grid->disableCreateButton();
        $grid->actions(function($actions){
            $actions->disableDelete();
            $actions->disableView();
        });
        $grid->tools(function($tools){
            $tools->batch(function($batch){
                $batch->disableDelete();
            });
        });
        return $grid;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header($this->title)
            ->description('查看')
            ->body($this->form()->edit($id));
    }

    public function form()
    {
        $form = new Form(new User);
        $form->tab('基本', function (Form $form) {
            $form->display('id');
            $form->text('username','用户名')/*->rules('required')*/;
            $form->email('email','Email')->rules('required');
            $form->display('created_at','创建时间');
            $form->display('updated_at','更新时间');
        })->tab('第三方信息', function (Form $form) {
            $form->text('sns.qq','QQ');
            $form->text('sns.wechat','微信号');
        })->tab('地址', function (Form $form) {
            $form->select('address.province_id','省份')->options(
                ChinaArea::province()->pluck('name', 'id')
            )->load('address.city_id', '/admin/api/china/city');

            $form->select('address.city_id','城市')->options(function ($id) {
                return ChinaArea::options($id);
            })->load('address.district_id', '/admin/api/china/district');

            $form->select('address.district_id','地区')->options(function ($id) {
                return ChinaArea::options($id);
            });

            $form->text('address.address','详细地址');

        });

        $form->tools(function(Form\tools $tools){
            $tools->disableView();
            // 去掉`删除`按钮
            $tools->disableDelete();
        });

        $form->footer(function ($footer) {

        // 去掉`重置`按钮
        $footer->disableReset();

        // 去掉`提交`按钮
        $footer->disableSubmit();

        // 去掉`查看`checkbox
        $footer->disableViewCheck();

        // 去掉`继续编辑`checkbox
        $footer->disableEditingCheck();

        // 去掉`继续创建`checkbox
        $footer->disableCreatingCheck();

});


        return $form;
    }
}
