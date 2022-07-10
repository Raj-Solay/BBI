<?php

namespace App\Transformers\Profile;

use App\Models\UserExpressionInterest;
use League\Fractal\TransformerAbstract;

class InterestTransformer extends TransformerAbstract
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
    public function transform(UserExpressionInterest $model)
    {
        return [
            'id' => $model->uuid,
            "project_name" =>$model->project_name,
  "industry"=>$model->industry,
  "location_interest"=>$model->location_interest,
  "financial_assistance"=>$model->financial_assistance,
  "registration_fee"=>$model->registration_fee,
  "franchisee_planning_for"=>$model->franchisee_planning_for,
  "franchisee_planning_as"=>$model->franchisee_planning_as,
  "business_place_type"=>$model->business_place_type,
  "business_place_size"=>$model->business_place_size,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
