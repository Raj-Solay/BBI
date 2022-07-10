<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\WorkHistory;
use App\Transformers\Profile\WorkTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    //
    public function __construct(WorkHistory $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->Staff;
        return fractal($bankDetails, new WorkTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {


    foreach($request->data as $key){
        $pr =  new WorkHistory;
        $pr->user_id = Auth::user()->id;


        $pr->organization = $key['organization'];
        $pr->field = $key['field'];
        $pr->location = $key['location'];
        $pr->date_of_joining = $key['date_of_joining'];
        $pr->date_of_leaving = $key['date_of_leaving'];
        $pr->product_service = $key['product_service'];
        $pr->department = $key['department'];
        $pr->reporting_to = $key['reporting_to'];
        $pr->total_cost_to_company = $key['total_cost_to_company'];
        $pr->business_targets =$key['business_targets'];
        $pr->take_home_per_month = $key['take_home_per_month'];
        $pr->pf_number = $key['pf_number'];
        $pr->health_card_number= $key['health_card_number'];
        $pr->other_benefits =$key['other_benefits'];
        $pr->achievements=$key['achievements'];
        $pr->reasons_for_change=$key['reasons_for_change'];
        $pr->job_description =$key['job_description'];
        $pr->contact_board_number= $key['contact_board_number'];
        $pr->official_mail_id = $key['official_mail_id'];
        $pr->web_site = $key['web_site'];
        $pr->save();
    }
        
        return fractal($pr, new WorkTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new WorkTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'rotational_name' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->organization = $request->organization;
        $pr->field = $request->field;
        $pr->location = $request->location;
        $pr->date_of_joining = $request->date_of_joining;
        $pr->date_of_leaving = $request->date_of_leaving;
        $pr->product_service = $request->product_service;
        $pr->department = $request->department;
        $pr->reporting_to = $request->reporting_to;
        $pr->total_cost_to_company = $request->total_cost_to_company;
        $pr->business_targets =$request->business_targets;
        $pr->take_home_per_month = $request->take_home_per_month;
        $pr->pf_number = $request->pf_number;
        $pr->health_card_number= $request->health_card_number;
        $pr->other_benefits =$request->other_benefits;
        $pr->achievements=$request->achievements;
        $pr->reasons_for_change=$request->reasons_for_change;
        $pr->job_description =$request->job_description;
        $pr->contact_board_number= $request->contact_board_number;
        $pr->official_mail_id = $request->official_mail_id;
        $pr->web_site = $request->web_site;
        $pr->save();
        return fractal($pr, new WorkTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
