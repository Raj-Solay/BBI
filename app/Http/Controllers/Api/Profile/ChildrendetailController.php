<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Childrendetail;
use App\Transformers\Profile\ChildrenTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildrendetailController extends Controller
{
    //
    private $validateFiled = [
        'name' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'stayawith' => 'required',
    ];
    public function __construct(Childrendetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->childrenDetails;
        return fractal($bankDetails, new ChildrenTransformer())->respond();
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validateFiled);
        $bank =  new Childrendetail;
        $bank->user_id = Auth::user()->id;;
        $bank->name = $request->name;
        $bank->age = $request->age;
        $bank->gender = $request->gender;
        $bank->stayawith = $request->stayawith;
        $bank->save();
        //$bank = $this->model->create($request->all());

        return fractal($bank, new ChildrenTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new ChildrenTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $this->validate($request, $this->validateFiled);
        $bank->update($request->except('_token'));

        return fractal($bank->fresh(), new ChildrenTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
