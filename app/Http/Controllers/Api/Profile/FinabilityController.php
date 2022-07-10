<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\UserFinability;
use App\Transformers\Profile\FinabilityTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinabilityController extends Controller
{
    //
    public function __construct(UserFinability $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->finability;
        return fractal($bankDetails, new FinabilityTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {

        $pr =  new UserFinability;
        $pr->user_id = Auth::user()->id;
        $pr->income = $request->income;
        $pr->income_type=$request->income_type;
        
        $pr->save();
        
        return fractal($pr, new FinabilityTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new FinabilityTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'income' => 'required',
            'income_type' => 'income_type',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        
        $pr->income = $request->income;
        $pr->income_type=$request->income_type;
        $pr->save();

        return fractal($pr, new FinabilityTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
