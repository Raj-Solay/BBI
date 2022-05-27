<?php

namespace App\Transformers\Profile;

use App\Models\Bankdetail;
use League\Fractal\TransformerAbstract;

class BankTransformer extends TransformerAbstract
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
    public function transform(Bankdetail $model)
    {
        return [
            'id' => $model->uuid,
            'bankname' => $model->bankname,
            'nameinaccount' => $model->nameinaccount,
            'accountnumber' => $model->accountnumber,
            'branch' => $model->branch,
            'ifsccode' => $model->ifsccode,
            'acctype' => $model->acctype,
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
