<?php

namespace App\Transformers\Profile;

use App\Models\LeaveRequest;
use League\Fractal\TransformerAbstract;

class LeaveTransformer extends TransformerAbstract
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
    public function transform(LeaveRequest $model)
    {
        return [
            'id' => $model->uuid,
            'rotational_name' => $model->rotational_name,
            'occasion' => $model->occasion,
            'date_of_festival' => $model->date_of_festival,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
