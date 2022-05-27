<?php

namespace App\Transformers\Profile;

use App\Models\Healthdetail;
use League\Fractal\TransformerAbstract;

class HealthTransformer extends TransformerAbstract
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
    public function transform(Healthdetail $model)
    {
        return [
            'id' => $model->uuid,
            'birthidentificationmarks' => $model->birthidentificationmarks,
            'birthidentificationmarks2' => $model->birthidentificationmarks2,
            'handuse' => $model->handuse,
            'weight' => $model->weight,
            'bloodgroup' => $model->bloodgroup,
            'willingtodonate' => $model->willingtodonate,
            'typeofph' => $model->acctype,
            'surgelesstreatmentundergo' => $model->surgelesstreatmentundergo,
            'typeofsurgery' => $model->typeofsurgery,
            'anyotherhealthissue' => $model->anyotherhealthissue,
            'otherissuesdetail' => $model->otherissuesdetail,
            'anyunhealthyhabit' => $model->anyunhealthyhabit,
            'habbitdetails' => $model->habbitdetails,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
