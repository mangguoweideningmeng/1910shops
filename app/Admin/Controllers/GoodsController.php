<?php

namespace App\Admin\Controllers;

use App\Model\Goods;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Model\Category;

class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Goods';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Goods());

        $grid->column('goods_id', __('商品 id'));
        $grid->column('goods_name', __('商品名称'));
        // $grid->column('goods_h', __(''));
        $grid->column('cate_id', __('分类id'));
        $grid->column('brand_id', __('品牌id'));
        $grid->column('goods_price', __('商品价格'));
        $grid->column('goods_num', __('商品库存'));
        $grid->column('is_up', __('是否上架'));
        $grid->column('is_new', __('是否热卖'));
        $grid->column('is_best', __('是否下架'));
        $grid->column('goods_img', __('商品图片'));
        // $grid->column('goods_imgs', __('Goods imgs'));
        $grid->column('goods_desc', __('商品积分'));
        // $grid->column('is_slide', __('Is slide'));

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
        $show = new Show(Goods::findOrFail($id));

        $show->field('goods_id', __('Goods id'));
        $show->field('goods_name', __('Goods name'));
        $show->field('goods_h', __('Goods h'));
        $show->field('cate_id', __('Cate id'));
        $show->field('brand_id', __('Brand id'));
        $show->field('goods_price', __('Goods price'));
        $show->field('goods_num', __('Goods num'));
        $show->field('is_up', __('Is up'));
        $show->field('is_new', __('Is new'));
        $show->field('is_best', __('Is best'));
        $show->field('goods_img', __('Goods img'));
        $show->field('goods_imgs', __('Goods imgs'));
        $show->field('goods_desc', __('Goods desc'));
        $show->field('is_slide', __('Is slide'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Goods());

        $form->text('goods_name', __('商品名称'));
        // $form->text('goods_h', __('Goods h'));
        $form->select('cate_id', __('分类'))->options(Category::selectOptions());
        // $form->number('brand_id', __('品牌'))->options(Category::selectOptions());
        $form->decimal('goods_price', __('商品价格'));
        $form->number('goods_num', __('商品库存'));
        $form->number('is_up', __('是否上架'));
        $form->number('is_new', __('热卖'));
        $form->number('is_best', __('是否下架'));
        $form->image('goods_img', __('商品图'))->dir('img');
        // $form->text('goods_imgs', __('Goods imgs'));
        $form->text('goods_desc', __('商品详情'));
        // $form->text('is_slide', __('Is slide'));

        return $form;
    }
}
