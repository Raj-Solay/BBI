<?php

namespace App\Transformers\Profile;

use App\Models\Agreement;
use League\Fractal\TransformerAbstract;

class AgreementsTransformer extends TransformerAbstract
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
    public function transform(Agreement $model)
    {
        return [

            'id' => $model->uuid,
            "file_name"=> $model->file_name,
            "file_type"=> $model->file_type
            
           
        ];
    }
}
