<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Personal;
use App\Transformers\Profile\PersonalTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    //
    public function __construct(Personal $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->Personal;
        return fractal($bankDetails, new PersonalTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {

        $pr =  new Personal;
        $pr->user_id = Auth::user()->id;
        $pr->present_acco_since = $request->present_acco_since;
        $pr->fathersname=$request->fathersname;
        $pr->permanent_emergency_no = $request->permanent_emergency_no;
        $pr->present_emergency_no= $request->present_emergency_no;
        $pr->dob = $request->dob;
        $pr->mothersname =$request->mothersname;
        $pr->permanent_acco_since =$request->permanent_acco_since;
        $pr->state    = $request->state;
        $pr->gender     =$request->gender;
        $pr->permanent_acco_type =$request->permanent_acco_type;
        $pr->mothertongue = $request->mothertongue;
        $pr->present_acco_type=  $request->present_acco_type;
        $pr->maritalstatus  =$request->maritalstatus ;
        $pr->present_add = $request->present_add;
        $pr->whatsappnumber =$request->whatsappnumber;
        $pr->pob=$request->pob;
        $pr->fathersname=$request->fathersname;
        $pr->alternatenumber = $request->alternatenumber;
        $pr->zip = $request->zip;
        $pr->permanent_add = $request->permanent_add;
        $pr->fullname =$request->fullname;
        $pr->emailid=$request->emailid;
        $pr->age=$request->age;
        $pr->role_id=$request->role_id;

        $pr->save();
        
        return fractal($pr, new PersonalTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new PersonalTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'fathersname' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        

        $pr->present_acco_since = $request->present_acco_since;
        $pr->fathersname=$request->fathersname;
        $pr->permanent_emergency_no = $request->permanent_emergency_no;
        $pr->present_emergency_no= $request->present_emergency_no;
        $pr->dob = $request->dob;
        $pr->mothersname =$request->mothersname;
        $pr->permanent_acco_since =$request->permanent_acco_since;
        $pr->state    = $request->state;
        $pr->gender     =$request->gender;
        $pr->permanent_acco_type =$request->permanent_acco_type;
        $pr->mothertongue = $request->mothertongue;
        $pr->present_acco_type=  $request->present_acco_type;
        $pr->maritalstatus  =$request->maritalstatus ;
        $pr->present_add = $request->present_add;
        $pr->whatsappnumber =$request->whatsappnumber;
        $pr->pob=$request->pob;
        $pr->fathersname=$request->fathersname;
        $pr->alternatenumber = $request->alternatenumber;
        $pr->zip = $request->zip;
        $pr->permanent_add = $request->permanent_add;
        $pr->fullname =$request->fullname;
        $pr->emailid=$request->emailid;
        $pr->age=$request->age;
        $pr->role_id=$request->role_id;
        $pr->save();

        return fractal($pr, new PersonalTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
