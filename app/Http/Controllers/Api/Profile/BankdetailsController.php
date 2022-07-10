<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Bankdetail;
use App\Transformers\Profile\BankTransformer;
use App\Transformers\Profile\InterestTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankdetailsController extends Controller
{
    //
    public function __construct(Bankdetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->bankDetails;
        return fractal($bankDetails, new BankTransformer())->respond();
    }

    public function intrest(Request $request)
    {
        $intrest = auth()->user()->interests;
        return fractal($intrest, new InterestTransformer())->respond(201);
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bankname' => 'required',
            'nameinaccount' => 'required',
            'accountnumber' => 'required',
            'branch' => 'required',
            'ifsccode' => 'required',
            'acctype' => 'required',
        ]);
        $bank =  new Bankdetail;
        $bank->user_id = Auth::user()->id;;
        $bank->bankname = $request->bankname;
        $bank->nameinaccount = $request->nameinaccount;
        $bank->branch = $request->branch;
        $bank->accountnumber = $request->accountnumber;
        $bank->ifsccode = $request->ifsccode;
        $bank->acctype = $request->acctype;
        $bank->save();
        //$bank = $this->model->create($request->all());

        return fractal($bank, new BankTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new BankTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $this->validate($request, [
            'bankname' => 'required',
            'nameinaccount' => 'required',
            'accountnumber' => 'required',
            'branch' => 'required',
            'ifsccode' => 'required',
            'acctype' => 'required',
        ]);
        $bank->update($request->except('_token'));

        return fractal($bank->fresh(), new BankTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
