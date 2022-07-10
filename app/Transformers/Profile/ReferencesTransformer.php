<?php

namespace App\Transformers\Profile;

use App\Models\UserReferences;
use League\Fractal\TransformerAbstract;

class ReferencesTransformer extends TransformerAbstract
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
    public function transform(UserReferences $model)
    {
        return [
            'id' => $model->uuid,
            "fullname"=> $model->fullname,
            "relation"=> $model->relation,
            "sex"=> $model->sex,
            "age"=> $model->age,
            "occupation"=> $model->occupation,
            "location"=> $model->location,
            "contact_number"=> $model->contact_number,
            "address"=> $model->address
        ];
    }
}
