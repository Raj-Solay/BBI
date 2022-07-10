<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Authorization;
use App\Transformers\Profile\AuthTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    
    public function __construct(Authorization $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->authorization;
        return fractal($bankDetails, new AuthTransformer())->respond();
    }
    public function store(Request $request)
    {

        $pr =  new Authorization();
        $pr->user_id = Auth::user()->id;
        $pr->authorization = $request->authorization;      
        $pr->ip_address= $request->ip_address;
        $pr->save();
        
        return fractal($pr, new AuthTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new AuthTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
       
        $this->validate($request, [
            'authorization' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        
        $pr->authorization = $request->authorization;      
        $pr->ip_address= $request->ip_address;
        $pr->save();
       
        return fractal($pr, new AuthTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
