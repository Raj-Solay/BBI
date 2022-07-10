<?php

namespace App\Transformers\Profile;

use App\Models\Personal;
use League\Fractal\TransformerAbstract;

class PersonalTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Personal $model)
    {
        return [
            'id' => $model->uuid,
            'user_id' => $model->user_id,
            'present_acco_since'=> $model->present_acco_since,
            'fathersname'=> $model->fathersname,
            'permanent_emergency_no'=> $model->permanent_emergency_no,
            'present_emergency_no'=> $model->present_emergency_no,
            'dob'=> $model->dob,
            'mothersname'=>$model->mothersname,
            'permanent_acco_since'=>$model->permanent_acco_since,
            'state'=> $model->state,
            'gender'=>$model->gender,
            'permanent_acco_type'=>$model->permanent_acco_type,
            'mothertongue'=>$model->mothertongue,
            'present_acco_type'=> $model->present_acco_type,
            'maritalstatus'=>$model->maritalstatus ,
            'present_add'=>$model->present_add,
            'whatsappnumber'=>$model->whatsappnumber,
            'pob'=>$model->pob,
            'fathersname'=>$model->fathersname,
            'alternatenumber'=> $model->alternatenumber,
            'zip'=> $model->zip,
            'permanent_add'=> $model->permanent_add,
            'fullname'=>$model->fullname,
            'emailid'=>$model->emailid,
            'age'=>$model->age,
            'role_id'=>$model->role_id,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
