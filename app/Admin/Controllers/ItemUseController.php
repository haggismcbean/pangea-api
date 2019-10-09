<?php

namespace App\Admin\Controllers;

use App\ItemUse;
use App\Item;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ItemUseController extends Controller
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
        $grid = new Grid(new ItemUse);

        $grid->id('Id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->item_id('Item id');
        $grid->activity('Activity');

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
        $show = new Show(ItemUse::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->item_id('Item id');
        $show->activity('Activity');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ItemUse);

        $items = Item::where('item_type', '!=', 'plant')
            ->where('item_type', '=', 'made_item')
            ->get();

        $form->select('item_id', 'Item')
            ->options($this->getAsOptions($items, 'item_type'))
            ->rules('required');

        $form->select('activity', 'Activity')->options([
            //gathering
            'lumberjacking' => 'lumberjacking',
            'harvesting' => 'harvesting',
            'fishing' => 'fishing',
            'hunting' => 'hunting',
            'farming' => 'farming',
            'gathering' => 'gathering',
            'mining' => 'mining',
            //craftin
            'crafting' => 'crafting',
            //combat
            'fighting' => 'fighting',
            'defending' => 'defending',
            //zone based uses
            'storage' => 'storage',
            'transporting' => 'transporting',
            //structures
            'lockable' => 'lockable',
            'wall' => 'wall',
            'key' => 'key',
            //passive uses
            'readable' => 'readable',
            'wearable' => 'wearable',
            'edible' => 'edible',
        ])->rules('required');

        return $form;
    }

    private function getAsOptions($options, $additionalInfo="") {
        $madeItemOptions = [];

        foreach ($options as $item) {
            $madeItemOptions[$item->id] = $item->name . " " . $item->$additionalInfo;
        }

        return $madeItemOptions;
    }
}
