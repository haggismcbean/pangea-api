<?php

namespace App\Admin\Controllers;

use App\MadeItem;
use App\MadeItemRecipe;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MadeItemRecipeController extends Controller
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
        $grid = new Grid(new MadeItemRecipe);

        $grid->id('Id');
        $grid->column('item.name', 'Made Item');
        $grid->base_volume('Base volume');
        $grid->base_rot_rate('Base rot rate');
        $grid->base_efficiency('Base efficiency');
        $grid->skill_cost('Skill cost');

        // TODO - show ingredients (if we can add them in the create, that is!)

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
        $show = new Show(MadeItemRecipe::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->base_volume('Base volume');
        $show->base_rot_rate('Base rot rate');
        $show->base_efficiency('Base efficiency');
        $show->skill_cost('Skill cost');
        $show->made_item_id('Made item id');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MadeItemRecipe);

        $form->number('base_volume', 'Base volume');
        $form->number('base_rot_rate', 'Base rot rate');
        $form->number('base_efficiency', 'Base efficiency');
        $form->number('skill_cost', 'Skill cost');

        // Step one - turn this into a search thing.
        $madeItems = MadeItem::get();
        $selectOptions = [];

        foreach ($madeItems as $item) {
            $itemId = $item->id;
            $selectOptions[$item->id] = $item->name;
        }

        $form->select('made_item_id', 'Made Item')->options($selectOptions);

        return $form;
    }
}
