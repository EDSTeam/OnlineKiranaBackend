<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserPost;
use App\User;
use Illuminate\Support\Facades\Validator;
use Response;
Use Exception;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result=User::all();
        return Response::json(
            array(
                'Success' =>  true ,
                'data' => $result,
                'message'   =>  "Data Fetched"
            ), 405);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$validated = $request->get();
        $validationStatus = $this->storeUserRules();
        if($validationStatus->getData()->Success == true)
        {
            try{
                $user =new User([
                    'user_id'=>NULL,
                    'firstname'=>  $request->get('firstname'),
                    'middlename'=> $request->get('middlename'),
                    'lastname'=>$request->get('lastname'),
                    'email'=>$request->get('email'),
                    'password'=>$request->get('password'),
                    'address_id'=>NULL,
                    'phone'=> $request->get('phone')
                ]);
                $user->save();
                return Response::json(
                    array(
                        'Success' =>  true,
                        'data' => [],
                        'message' =>  'User Created'
                    ), 200);
            }
            catch(Exception $e){
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => [],
                        'message'   =>  $e->getMessage()
                    ), 405);
            }
 
            
               
        }
        else if($validationStatus->getData()->Success == false)
        {
            return $validationStatus;
        }
    }
    public function storeUserRules()
    {
        try{
            $validator = Validator::make(request()->all(),[
                'firstname'=> 'required',
                'lastname'=>'required',
                'email'=>'required|unique:users,email',
                'password'=>'required',
                'phone'=>'required|unique:users,phone|regex:/[0-9]{10}/'
            ]);
            if ($validator->fails()){
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => [],
                        'message'   =>  $validator->messages()->toArray()
                    ), 400);    
            }
            else{
                return Response::json(
                    array(
                        'Success' =>  true,
                        'data' => [],
                        'message'   =>  'Fields Validated'
                    ), 200); 
            }
             }
             catch(Exception $e)
             {
                return Response::json(
                    array(
                        'Success' =>  false,
                        'data' => [],
                        'message'   =>  "SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it"
                    ), 405);
            }
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
