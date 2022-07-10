<?php

namespace App\Transformers\Profile;

use App\Models\Educationaldetail;
use League\Fractal\TransformerAbstract;

class EducationalTransformer extends TransformerAbstract
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
    public function transform(Educationaldetail $model)
    {
        return [
            'id' => $model->uuid,
            'qualication' => $model->qualication,
            'institutename' => $model->institutename,
            'board_uni' => $model->board_uni,
            'yearofpasing' => $model->yearofpasing,
            'percentage' => $model->percentage,
            'tc_course' => $model->tc_course,
            'tc_institution' => $model->tc_institution,
            'tc_year' => $model->tc_year,
            'tc_level' => $model->tc_level,
            'extra_co_activities' => $model->extra_co_activities,
            'curricular_achivements' => $model->curricular_achivements,
            'tc_hobbies' => $model->tc_hobbies,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
