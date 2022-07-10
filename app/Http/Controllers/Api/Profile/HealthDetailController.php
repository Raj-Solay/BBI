<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Healthdetail;
use App\Transformers\Profile\HealthTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthDetailController extends Controller
{
    //
    /* private $validateFiled = [
        'birthidentificationmarks' => 'required',
        'birthidentificationmarks2' => 'required',
        'handuse' => 'required',
        'weight' => 'required',
        'bloodgroup' => 'required',
        'willingtodonate' => 'required',
        'typeofph' => 'required',
        'surgelesstreatmentundergo' => 'required',
        'typeofsurgery' => 'required',
        'anyotherhealthissue' => 'required',
        'otherissuesdetail' => 'required',
        'anyunhealthyhabit' => 'required',
        'habbitdetails' => 'required'
    ];*/
    private $validateFiled = [
        'birthidentificationmarks' => 'required',
        'handuse' => 'required',
        'weight' => 'required',
        'bloodgroup' => 'required'

    ];
    public function __construct(Healthdetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        
        $dataDetails = auth()->user()->healthdetail;
        return fractal($dataDetails, new HealthTransformer())->respond();
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validateFiled);
        $data =  new Healthdetail;
        $data->user_id = Auth::user()->id;
        $data->birthidentificationmarks = $request->birthidentificationmarks;
        $data->birthidentificationmarks2 = $request->birthidentificationmarks2;
        $data->handuse = $request->handuse;
        $data->weight = $request->weight;
        $data->bloodgroup = $request->bloodgroup;
        $data->willingtodonate = $request->willingtodonate;
        $data->typeofph = $request->typeofph;
        $data->surgelesstreatmentundergo = $request->surgelesstreatmentundergo;
        $data->typeofsurgery = $request->typeofsurgery;
        $data->anyotherhealthissue = $request->anyotherhealthissue;
        $data->otherissuesdetail = $request->otherissuesdetail;
        $data->anyunhealthyhabit = $request->anyunhealthyhabit;
        $data->habbitdetails = $request->habbitdetails;
        $data->save();
        //$data = $this->model->create($request->all());

        return fractal($data, new HealthTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new HealthTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $data = $this->model->byUuid($uuid)->firstOrFail();
        $this->validate($request, $this->validateFiled);
        $data->update($request->except('_token'));

        return fractal($data->fresh(), new HealthTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $data = $this->model->byUuid($uuid)->firstOrFail();
        $data->delete();

        return response()->json(null, 204);
    }


public function refrance(){

    $jayParsedAry = [
        "fullname" => "43", 
        "relation" => "Father", 
        "sex" => "Male", 
        "age" => "33", 
        "occupation" => "22", 
        "location" => "22", 
        "contact_number" => "22", 
        "address" => "2" 
     ];      

     echo json_encode($jayParsedAry);
    
}

}
