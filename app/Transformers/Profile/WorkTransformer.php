<?php

namespace App\Transformers\Profile;

use App\Models\WorkHistory;
use League\Fractal\TransformerAbstract;

class WorkTransformer extends TransformerAbstract
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
    public function transform(WorkHistory $model)
    {
        return [
            'id' => $model->uuid,
            'organization' => $model->organization,
            'field' => $model->field,
            'location' => $model->location,
            'date_of_joining' => $model->date_of_joining,
            'date_of_leaving' => $model->date_of_leaving,
            'product_service' => $model->product_service,
            'department' => $model->department,
            'reporting_to' => $model->reporting_to,
            'total_cost_to_company' => $model->total_cost_to_company,
            'business_targets' => $model->business_targets,
            'take_home_per_month' => $model->take_home_per_month,
            'pf_number' => $model->pf_number,
            'health_card_number'=> $model->health_card_number,
            'other_benefits' =>$model->other_benefits,
            'achievements'=>$model->achievements,
            'reasons_for_change'=>$model->reasons_for_change,
            'job_description' =>$model->job_description,
            'contact_board_number'=> $model->contact_board_number,
            'official_mail_id' => $model->official_mail_id,
            'web_site' => $model->web_site,


            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
