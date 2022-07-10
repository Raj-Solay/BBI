<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\PersonalReference;
use App\Transformers\Profile\PersonalReferenceTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalReferenceController extends Controller
{
    //
    public function __construct(PersonalReference $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->PersonalReference;
        return fractal($bankDetails, new PersonalReferenceTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {

        $pr =  new PersonalReference;
        $pr->user_id = Auth::user()->id;
        $pr->fullname= $request->fullname;
        $pr->relation= $request->relation;
        $pr->sex= $request->sex;
        $pr->age= $request->age;
        $pr->occupation= $request->occupation;
        $pr->location= $request->location;
        $pr->contact_number= $request->contact_number;
        $pr->address= $request->address;
        $pr->save();
        
        return fractal($pr, new PersonalReferenceTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new PersonalReferenceTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'fullname' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->fullname= $request->fullname;
        $pr->relation= $request->relation;
        $pr->sex= $request->sex;
        $pr->age= $request->age;
        $pr->occupation= $request->occupation;
        $pr->location= $request->location;
        $pr->contact_number= $request->contact_number;
        $pr->address= $request->address;
        $pr->save();

        return fractal($pr, new PersonalReferenceTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
