<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index(){
        return User::all();

    }
    public function userDetail($id){
        $user=User::where('id',$id)->first();
        return response($user);
    }
    public function addUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',

        ]);
        $user=new User();
       $user->userUpdateCreate($request);
       $response=[
        "status"=>true,
        "message"=>"User created successfully",
        "user" =>$user,
        ];
    return response($response,200);
    }

    public function login(Request $request){
        // user validate
        $request->validate(
            [
                "email"=>'required|string|email',
                "password"=>'required|string'

            ]);

            $user=User::where(
                "email",$request->email
            )->first();
                // hash::check encrypted pw check returns true or false
            if(!$user || !Hash::check($request->password,$user->password)){
                return response([
                    'status' => 'error',
                    'message'=> 'Bad credentials'
                ],401);
            }
            // to create token login and register garda ,matra create garxa
            $token= $user->createToken('LoginToken')->plainTextToken;
            $response=[
                "status"=>'success',
                "user" =>$user,
                "authentication"=>[
                    "token"=>$token,
                    "type"=>'bearer',
                ]
                ];
            return response($response,200);
    }
    public function update(Request $request,$id){

            $request->validate([
                "name"=>'required|string',
                "email"=>'required|string',
            ]);
        $user=User::find($id);
        $user->name= $request->name;
        if($request->email != $user->email){
            $user->email= $request->email;
        }
        $user->save();
        $response=[
            "status"=>true,
            "user"=>$user,

        ];
        return response($response,201);

    }
    public function delete($id){
        $user=User::find($id)->delete();
        $response=[
            "status"=>true,
            "message"=>'User deleted successfully',
            "user"=>$user,


        ];
        return response($response,201);

    }
    public function register(Request $request){

        $request->validate(
            [
                "name"=>'required|string',
                "email"=>'required|string|unique:users,email',
                "password"=>'required|string|confirmed'

            ]
            );
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();

        $token=$user->createToken('registerToken')->plainTextToken;
        $response=[
            "status"=>'success',
            "user"=>$user,
            "authentication"=>[
                "token"=>$token,
                "type"=>'bearer',
            ]
        ];
        return response($response,201);
    }

    public function tableData(){
        $user= User::all();
        $response=[
        'status'=>true,
        'user'=>$user
        ];
        return response($response,200);
    }

    public function userList(){
        // return 'saugat thapa';
       return  User::all();

        // return response($user,200);
    }

    public function userEdit($id){
        return User::where('id',$id)->first();

    }
}
