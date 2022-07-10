<?php

namespace App\Transformers\Profile;

use App\Models\Authorization;
use League\Fractal\TransformerAbstract;

class AuthTransformer extends TransformerAbstract
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
    public function transform(Authorization $model)
    {
        return [
            'id' => $model->uuid,
            "authorization"=> $model->authorization,
            "ip_address"=> $model->ip_address,
        ];
    }
}
