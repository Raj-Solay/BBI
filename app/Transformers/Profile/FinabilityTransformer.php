<?php

namespace App\Transformers\Profile;

use App\Models\UserFinability;
use League\Fractal\TransformerAbstract;

class FinabilityTransformer extends TransformerAbstract
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
    public function transform(UserFinability $model)
    {
        return [

            'id' => $model->uuid,
            "income"=> $model->income,
            "income_type"=> $model->income_type
            
           
        ];
    }
}
