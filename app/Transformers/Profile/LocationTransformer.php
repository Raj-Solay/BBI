<?php

namespace App\Transformers\Profile;

use App\Models\Location;
use League\Fractal\TransformerAbstract;

class LocationTransformer extends TransformerAbstract
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
    public function transform(Location $model)
    {
        return [

            'id' => $model->uuid,
            "location_name"=> $model->location_name,
            "latitute"=> $model->latitute,
            "longitude"=> $model->longitude,
            "office_measurement"=> $model->office_measurement, 
            "space_blue_print_file"=> $model->space_blue_print_file,
            "images"=> $model->images, 
            "videos"=> $model->videos,

          
           
        ];
    }
}
