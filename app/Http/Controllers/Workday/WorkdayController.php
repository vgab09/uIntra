<?php
/**
 * Created by PhpStorm.
 * User: g09
 * Date: 2019.02.03.
 * Time: 16:14
 */

namespace App\Http\Controllers\Workday;



use App\Http\Components\FormHelper\FormDropDownFieldHelper;
use App\Http\Components\FormHelper\FormHelper;
use App\Http\Components\FormHelper\FormInputFieldHelper;
use App\Http\Components\ListHelper\ListFieldHelper;
use App\Http\Components\ListHelper\ListHelper;
use App\Http\Controllers\BREADController;
use App\Persistence\Models\Workday;
use Illuminate\Database\Eloquent\Model;

class WorkdayController extends BREADController
{

    public function __construct()
    {
        $this->modelClass = Workday::class;
    }

    /**
     * @param Model|null $model
     * @return FormHelper
     */
    protected function buildFormHelper($model)
    {
        return FormHelper::to('workday',$model,[
            FormInputFieldHelper::toText('name','Név')->setRequired(),
            FormInputFieldHelper::toDate('start','Kezdés')->setRequired(),
            FormInputFieldHelper::toDate('end','Vége')->setRequired(),
            FormInputFieldHelper::toTextarea('description','Megjegyzés'),
        ]);
    }

    protected function getFormHelperToUpdate($model)
    {
        return parent::getFormHelperToUpdate($model)->setTitle('Plusz munkanapok szerkesztése');
    }

    protected function getFormHelperToInsert($model)
    {
        return parent::getFormHelperToInsert($model)->setTitle('Új munkanap hozzáadása');
    }


    /**
     * Create a new ListHelper instance, and fill up.
     * @return ListHelper
     */
    protected function buildListHelper()
    {
        return ListHelper::to('workday',[
            ListFieldHelper::to('id_workday','#'),
            ListFieldHelper::to('name','Név'),
            ListFieldHelper::to('start','Kezdés'),
            ListFieldHelper::to('end','Vége'),
            ListFieldHelper::to('description','Megjegyzés')->setMaxLength(30),

        ])
            ->addTimeStamps()
            ->setTitle('Plusz munkanapok')
            ->addRowActions(function ($model) {
                return FormDropDownFieldHelper::to('action')
                    ->addActionLinkIfCan('update_workday', route('editWorkday', $model->getKey()), '<i class="fas fa-pencil-alt"></i> Szerkesztés')
                    ->addActionLinkIfCan('delete_workday', route('deleteWorkday', $model->getKey()), '<i class="fas fa-trash-alt"></i> Törlés')
                    ->renderTag();
            });
    }

    protected function collectListData()
    {
        return Workday::query();
    }
}