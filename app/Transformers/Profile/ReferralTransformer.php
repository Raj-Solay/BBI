<?php

namespace App\Transformers\Profile;

use App\Models\ReferralDetail;
use League\Fractal\TransformerAbstract;

class ReferralTransformer extends TransformerAbstract
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
    public function transform(ReferralDetail $model)
    {
        return [
            'id' => $model->uuid,
            'name' => $model->name,
            'epm_code' => $model->epm_code,
            'designation' => $model->designation,
            'department' => $model->department,
            'company' => $model->company,
            'period_of_work' => $model->period_of_work,
            'reporting_to' => $model->reporting_to,
            'work_location' => $model->work_location,
            'how_do_youknow' => $model->how_do_youknow,
            'contact_no' => $model->contact_no,
            'mail_id' => $model->mail_id,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
