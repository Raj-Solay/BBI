<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\StaffDetail;
use App\Transformers\Profile\StaffTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    //
    public function __construct(StaffDetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->Staff;
        return fractal($bankDetails, new StaffTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {

        $pr =  new StaffDetail;
        $pr->user_id = Auth::user()->id;
        $pr->first_name= $request->first_name;
        $pr->last_name= $request->last_name;
        $pr->email= $request->email;
        $pr->mobile= $request->mobile;
        $pr->photo= $request->photo;
        $pr->resume= $request->resume;
        $pr->save();
        
        return fractal($pr, new StaffTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new StaffTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'first_name' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->first_name=$request->first_name;
        $pr->last_name= $request->last_name;
        $pr->email= $request->email;
        $pr->mobile= $request->mobile;
        $pr->photo= $request->photo;
        $pr->resume= $request->resume;
        
        $pr->save();

        return fractal($pr, new StaffTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
