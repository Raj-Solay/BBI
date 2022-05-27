<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\FamilyDetail;
use App\Transformers\Profile\FamilyTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyDetailController extends Controller
{
    //
    private $validateFiled = [
        'name' => 'required',
        'relation' => 'required',
        'age' => 'required',
        'education' => 'required',
        'occupation' => 'required',
        'monthlyincome' => 'required',
        'contactno' => 'required',
        'address' => 'required'
    ];
    public function __construct(FamilyDetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $dataDetails = auth()->user()->familyDetail;
        return fractal($dataDetails, new FamilyTransformer())->respond();
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validateFiled);
        $data =  new FamilyDetail;
        $data->user_id = Auth::user()->id;;
        $data->name = $request->name;
        $data->relation = $request->relation;
        $data->age = $request->age;
        $data->education = $request->education;
        $data->monthlyincome = $request->monthlyincome;
        $data->occupation = $request->occupation;
        $data->monthlyincome = $request->monthlyincome;
        $data->contactno = $request->contactno;
        $data->address = $request->address;
        $data->save();
        //$data = $this->model->create($request->all());

        return fractal($data, new FamilyTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new FamilyTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $data = $this->model->byUuid($uuid)->firstOrFail();
        $this->validate($request, $this->validateFiled);
        $data->update($request->except('_token'));

        return fractal($data->fresh(), new FamilyTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $data = $this->model->byUuid($uuid)->firstOrFail();
        $data->delete();

        return response()->json(null, 204);
    }
}
