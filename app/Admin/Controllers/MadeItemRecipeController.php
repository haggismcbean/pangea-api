<?php

namespace App\Admin\Controllers;

use App\Item;
use App\MadeItem;
use App\MadeItemRecipe;
use App\RecipeIngredient;
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

        $form->number('base_volume', 'Base volume')->rules('required');;
        $form->number('base_rot_rate', 'Base rot rate')->rules('required');;
        $form->number('base_efficiency', 'Base efficiency')->rules('required');;
        $form->number('skill_cost', 'Skill cost')->rules('required');;

        $form->select('made_item_id', 'Made Item')->options($this->getAsOptions(MadeItem::get()));

        $form->hasMany('ingredients', function(Form\NestedForm $form) {
            $form->number('quantity_min', 'Minimum Quantity')->rules('required');;
            $form->number('quantity_max', 'Maximum Quantity')->rules('required');;
            $form->select('skill_name', 'Skill Name')->options([
                'woodwork' => 'woodwork',
                'pottery' => 'pottery',
                'construction' => 'construction',
                'weaving' => 'weaving',
                'textiles' => 'textiles',
                'masonry' => 'masonry'
            ])->rules('required');;
            $form->radio('is_consumed', 'Is Consumed')->options([0 => 'False', 1 => 'True'])->default(1)->rules('required');;

            // TODO - user can only choose one of the below two (?)
            $form->select('item_id', 'Specific Item')->options($this->getAsOptions(Item::get()));

            $form->select('item_type', 'Generic Item Type')->options([
                // would be useful to have secondary items in here?
                // grass
                // wicker
                'seed' => 'seed',
                'flower' => 'flower',
                'leaf' => 'leaf',
                'bone' => 'bone',
                'wood' => 'wood',
                'stone' => 'stone'
            ]);
        });

        return $form;
    }

    private function getAsOptions($options) {
        $madeItemOptions = [];

        foreach ($options as $item) {
            $itemId = $item->id;
            $madeItemOptions[$item->id] = $item->name;
        }

        return $madeItemOptions;
    }
}
