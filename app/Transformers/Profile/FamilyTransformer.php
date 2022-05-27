<?php

namespace App\Transformers\Profile;

use App\Models\FamilyDetail;
use League\Fractal\TransformerAbstract;

class FamilyTransformer extends TransformerAbstract
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
    public function transform(FamilyDetail $model)
    {
        return [
            'id' => $model->uuid,
            'name' => $model->name,
            'relation' => $model->relation,
            'age' => $model->age,
            'education' => $model->education,
            'occupation' => $model->occupation,
            'monthlyincome' => $model->monthlyincome,
            'contactno' => $model->contactno,
            'address' => $model->address,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
