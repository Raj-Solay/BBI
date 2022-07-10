<?php

namespace App\Http\Controllers\Api\Users;

use App\Exceptions\StoreResourceFailedException;
use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use App\Transformers\Users\UserTransformer;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return fractal(Auth::user(), new UserTransformer())->respond();
    }

    public function profileLink()
    {
        
       // return fractal(ProfileLink::get(), new UserTransformer())->respond();
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];
        if ($request->method() == 'PATCH') {
            $rules = [
                'name' => 'sometimes|required',
                'email' => 'sometimes|required|email|unique:users,email,'.$user->id,
            ];
        }
        $this->validate($request, $rules);
        // Except password as we don't want to let the users change a password from this endpoint
        $user->update($request->except('_token', 'password'));

        return fractal($user->fresh(), new UserTransformer())->respond();
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        // verify the old password given is valid
        if (! app(Hasher::class)->check($request->get('current_password'), $user->password)) {
            throw new StoreResourceFailedException('Validation Issue', [
                'old_password' => 'The current password is incorrect',
            ]);
        }
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return fractal($user->fresh(), new UserTransformer())->respond();
    
    }


    public function createORder(Request $request){


        $this->validate($request, [
            'order_amount' => 'required',
            'customer_email' => 'required',
            'customer_phone' =>'required',
            'customer_name' => 'required',
        ]);

        $order_id=$this->generateRandomString();
        $arrayVar = [
            "order_amount" => $request->order_amount,
            "order_id" =>$order_id,
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => 'customer'.Auth::user()->id,
                "customer_name" => $request->customer_name,
                "customer_email" => $request->customer_email,
                "customer_phone" => $request->customer_phone,
            ],
            "order_meta" => ["notify_url" => "https://test.cashfree.com"],
            "order_note" => "some order note here",
        ];
        

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.cashfree.com/pg/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($arrayVar),
          CURLOPT_HTTPHEADER => array(
            'x-client-id: 17379882387f69dc00563b3e38897371',
            'x-client-secret: cfbceff4e59f28583f9b97b08cf17363b659c700',
            'x-api-version: 2022-01-01',
            'x-request-id: rahul',
            'Content-Type: application/json'
          ),
        ));

        $response =curl_exec($curl);
        
        $pr =  new UserOrder();
        $pr->user_id = Auth::user()->id;
        $pr->order_id= $order_id;
        $pr->order_amount= $request->order_amount;
        $pr->order_currency= "INR";
      //  $pr->customer_id= Auth::user()->id;

        $pr->customer_name= $request->customer_name;

        $pr->customer_email= $request->customer_email;

        $pr->customer_phone= $request->customer_phone;
        $pr->status="pending";
        $pr->response=$response;
        $pr->save();

       // print_r($pr->toArray());

        echo json_encode(["response"=>$pr->toArray(),'pg'=>json_decode($response)]);
die("");
        



        
    }



   protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

public function updatePayment(Request $request){

    $this->validate($request, [
        'order_id' => 'required',
        'status' => 'required'
    ]);

    $pr =  new UserOrder ; 
    $pr=$pr->where("order_id",'=',$request->order_id)->firstOrFail();
    
    $pr->status=$request->status;
    $pr->save();
    echo json_encode(["response"=>"success"]);
die("");
    

}



public function dates(){
    $a=[];
array_push($a,date('d.m.Y', strtotime('+1 day', time())),date('d.m.Y', strtotime('+2 day', time())),date('d.m.Y', strtotime('+3 day', time())));
echo json_encode(["statis"=>"1","dates"=>$a]);
}

}
