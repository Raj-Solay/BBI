<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Educationaldetail;
use App\Transformers\Profile\EducationalTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationaldetailController extends Controller
{
    private $validateFiled = [
        'qualication' => 'required',
        'institutename' => 'required',
        'board_uni' => 'required',
        'yearofpasing' => 'required',
        'percentage' => 'required'

    ];
    public function __construct(Educationaldetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $dataDetails = auth()->user()->eductionalDetails;
        return fractal($dataDetails, new EducationalTransformer())->respond();
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validateFiled);
        $data =  new Educationaldetail;
        $data->user_id = Auth::user()->id;;
        $data->qualication = $request->qualication;
        $data->institutename = $request->institutename;
        $data->board_uni = $request->board_uni;
        $data->yearofpasing = $request->yearofpasing;
        $data->percentage = $request->percentage;

        $data->tc_course=$request->tc_course;
        $data->tc_institution= $request->tc_institution;
        $data->tc_year= $request->tc_year;
        $data->tc_level=$request->tc_level;
        $data->extra_co_activities=$request->extra_co_activities;
        $data->curricular_achivements=$request->curricular_achivements;
        $data->tc_hobbies=$request->tc_hobbies;
        $data->save();

        

        //$data = $this->model->create($request->all());

        return fractal($data, new EducationalTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new EducationalTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $data = $this->model->byUuid($uuid)->firstOrFail();
        $this->validate($request, $this->validateFiled);
        $data->update($request->except('_token'));

        return fractal($data->fresh(), new EducationalTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $data = $this->model->byUuid($uuid)->firstOrFail();
        $data->delete();

        return response()->json(null, 204);
    }
}
