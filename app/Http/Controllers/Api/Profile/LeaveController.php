<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Transformers\Profile\LeaveTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    //
    public function __construct(LeaveRequest $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->Staff;
        return fractal($bankDetails, new LeaveTransformer())->respond();
    }
public function authorization(){

    
}

    public function store(Request $request)
    {


        foreach($request->leave_holidays as $key){
            $pr =  new LeaveRequest;
            $pr->user_id = Auth::user()->id;
    
            $pr->rotational_name = $request->rotational_name;
            $pr->occasion = $key['occasion'];
            $pr->date_of_festival = $key['date_of_festival'];

        }

        $pr->save();
        
        return fractal($pr, new LeaveTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new LeaveTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        
        $this->validate($request, [
            'rotational_name' => 'required',
            
        ]);

        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->rotational_name = $request->rotational_name;
        $pr->occasion = $request->occasion;
        $pr->date_of_festival = $request->date_of_festival;
        $pr->save();

        return fractal($pr, new LeaveTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
