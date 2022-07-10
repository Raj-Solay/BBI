<?php

namespace App\Transformers\Profile;

use App\Models\StaffDetail;
use League\Fractal\TransformerAbstract;

class StaffTransformer extends TransformerAbstract
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
    public function transform(StaffDetail $model)
    {
        return [

            'id' => $model->uuid,
            "first_name"=> $model->first_name,
            "last_name"=> $model->last_name,
            "mobile"=> $model->mobile,
            "photo"=> $model->photo,
            "resume"=> $model->resume
           
        ];
    }
}
