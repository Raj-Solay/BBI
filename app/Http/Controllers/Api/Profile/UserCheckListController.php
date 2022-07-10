<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\UserChecklist;
use App\Transformers\Profile\ChecklistTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCheckListController extends Controller
{
    //
    public function __construct(UserChecklist $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->checklist;
        return fractal($bankDetails, new ChecklistTransformer())->respond();
    }
    public function store(Request $request)
    {

        $pr =  new UserChecklist;
        $pr->user_id = Auth::user()->id;
        $pr->meet_eligibility_criteria = $request->meet_eligibility_criteria;      
        $pr->business_registration_support= $request->business_registration_support;
        $pr->business_loan_support= $request->business_loan_support;
        $pr->accept_undergo_business_training= $request->accept_undergo_business_training;
        $pr->accept_company_referred_setup= $request->accept_company_referred_setup;
        $pr->understood_terms_conditions= $request->understood_terms_conditions;
        $pr->authorized_keep_contact= $request->authorized_keep_contact;
        $pr->no_relation_clients= $request->no_relation_clients;
        $pr->your_responsibility= $request->your_responsibility;
          
        $pr->save();
        
        return fractal($pr, new ChecklistTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new ChecklistTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'fathersname' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();

        $pr->business_registration_support= $request->business_registration_support;
        $pr->business_loan_support= $request->business_loan_support;
        $pr->accept_undergo_business_training= $request->accept_undergo_business_training;
        $pr->accept_company_referred_setup= $request->accept_company_referred_setup;
        $pr->understood_terms_conditions= $request->understood_terms_conditions;
        $pr->authorized_keep_contact= $request->authorized_keep_contact;
        $pr->no_relation_clients= $request->no_relation_clients;
        $pr->your_responsibility= $request->your_responsibility;
        $pr->save();

        return fractal($pr, new ChecklistTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
