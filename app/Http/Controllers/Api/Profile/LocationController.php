<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Transformers\Profile\LocationTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    //
    public function __construct(Location $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->Location;
        return fractal($bankDetails, new LocationTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {


        $pr =  new Location;
        $pr->user_id = Auth::user()->id;
        $pr->location_name= $request->location_name;
        $pr->latitute= $request->latitute;
        $pr->longitude= $request->longitude;
        $pr->office_measurement= $request->office_measurement;
        $pr->space_blue_print_file= $request->space_blue_print_file;
        $pr->images= $request->images;
        $pr->videos= $request->videos;
        $pr->save();
        
        return fractal($pr, new LocationTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new LocationTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'location_name' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->location_name= $request->location_name;
        $pr->latitute= $request->latitute;
        $pr->longitude= $request->longitude;
        $pr->office_measurement= $request->office_measurement;
        $pr->space_blue_print_file= $request->space_blue_print_file;
        $pr->images= $request->images;
        $pr->videos= $request->videos;
        $pr->save();

        return fractal($pr, new LocationTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
