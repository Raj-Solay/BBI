<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\ReferralDetail;
use App\Transformers\Profile\ReferralTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    //
    public function __construct(ReferralDetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->Staff;
        return fractal($bankDetails, new ReferralTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {

        $pr =  new ReferralDetail;
        $pr->user_id = Auth::user()->id;
        
        $pr->epm_code = $request->epm_code;
        $pr->designation = $request->designation;
        $pr->department = $request->department;
        $pr->company = $request->company;
        $pr->period_of_work = $request->period_of_work;
        $pr->reporting_to = $request->reporting_to;
        $pr->work_location = $request->work_location;
        $pr->how_do_youknow = $request->how_do_youknow;
        $pr->contact_no = $request->contact_no;
        $pr->mail_id = $request->mail_id;

        $pr->save();
        
        return fractal($pr, new ReferralTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new ReferralTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'first_name' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->epm_code = $request->epm_code;
        $pr->designation = $request->designation;
        $pr->department = $request->department;
        $pr->company = $request->company;
        $pr->period_of_work = $request->period_of_work;
        $pr->reporting_to = $request->reporting_to;
        $pr->work_location = $request->work_location;
        $pr->how_do_youknow = $request->how_do_youknow;
        $pr->contact_no = $request->contact_no;
        $pr->mail_id = $request->mail_id;

        
        $pr->save();

        return fractal($pr, new ReferralTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
