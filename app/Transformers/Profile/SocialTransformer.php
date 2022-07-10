<?php

namespace App\Transformers\Profile;

use App\Models\UserSocialIdentityDetail;
use League\Fractal\TransformerAbstract;

class SocialTransformer extends TransformerAbstract
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
    public function transform(UserSocialIdentityDetail $model)
    {
        return [
            'id' => $model->uuid,
             "aadhaar_number"=> $model->aadhaar_number,
            "driving_licence_number"=> $model->driving_licence_number,
            "pancard_number"=> $model->pancard_number,
            "passport_number"=> $model->passport_number,
            "voter_card_number"=> $model->voter_card_number,
            "ration_card_number"=> $model->ration_card_number
        ];
    }
}
