<?php

namespace App\Transformers\Profile;

use App\Models\Childrendetail;
use League\Fractal\TransformerAbstract;

class ChildrenTransformer extends TransformerAbstract
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
    public function transform(Childrendetail $model)
    {
        return [
            'id' => $model->uuid,
            'name' => $model->name,
            'age' => $model->age,
            'gender' => $model->gender,
            'stayawith' => $model->stayawith,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
