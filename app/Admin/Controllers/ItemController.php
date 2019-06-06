<?php

namespace App\Admin\Controllers;

use App\MadeItem;
use App\Item;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ItemController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Item);

        $grid->id('Id')->sortable();
        $grid->name('Name');
        $grid->description('Description');
        $grid->item_type('Item type')->sortable();
        // $grid->type_id('Type id')->sortable();
        $grid->unit_weight('Unit weight');
        $grid->unit_volume('Unit volume');
        $grid->rot_rate('Rot rate');
        $grid->efficiency('Efficiency');

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
        $show = new Show(Item::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->item_type('Item type');
        $show->type_id('Type id');
        $show->unit_weight('Unit weight');
        $show->unit_volume('Unit volume');
        $show->rot_rate('Rot rate');
        $show->name('Name');
        $show->description('Description');
        $show->efficiency('Efficiency');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Item);

        $form->number('unit_weight', 'Unit weight');
        $form->number('unit_volume', 'Unit volume');
        $form->number('rot_rate', 'Rot rate');
        $form->text('name', 'Name');
        $form->text('description', 'Description');
        $form->number('efficiency', 'Efficiency');

        $form->saving(function(Form $form) {
            // echo $form->name;
            // exit;

            // create the madeItem!
            $madeItem = new MadeItem();
            $madeItem->name = $form->name;
            $madeItem->save();

            // For now we can only make made_items
            $form->model()->item_type = 'made_item';
            $form->model()->type_id = $madeItem->id;

            // then add the madeItem properties to the item!

            // boom!
        });

        return $form;
    }
}
