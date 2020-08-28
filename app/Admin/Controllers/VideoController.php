<?php

namespace App\Admin\Controllers;

use App\Model\Video;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VideoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Video';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Video());

        $grid->column('id', __('Id'));
        $grid->column('goods_id', __('商品 id'));
        $grid->column('path', __('MP4'));
        $grid->column('m3u8', __('M3u8'));
        $grid->column('status', __('状态'));
        $grid->column('created_at', __('添加时间'));
        $grid->column('updated_at', __('修改时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Video::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('goods_id', __('Goods id'));
        $show->field('path', __('Path'));
        $show->field('m3u8', __('M3u8'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $goods_id = isset($_GET['id']) ? intval($_GET['id']) : null;
        $form = new Form(new Video());
        $form->text('goods_id', __('Goods id'))->value($goods_id);
        $form->file('path', __('视频'))->uniqueName()->move('video');
        return $form;
    }
}
