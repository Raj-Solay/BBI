<?php

namespace App\Transformers\Profile;

use App\Models\UserDocument;
use League\Fractal\TransformerAbstract;

class DocumentTransformer extends TransformerAbstract
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
    public function transform(UserDocument $model)
    {
        return [
            'id' => $model->uuid,
             "document_id"=> $model->document_id,
            "document_name"=> $model->document_name,
            "document_type"=> $model->document_type,
            
        ];
    }
}
