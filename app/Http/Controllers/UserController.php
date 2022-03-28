<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index(Request $request){

        $searchbox = $request->query('searchbox');

        if ($searchbox == ''){
            $users=User::all();
        }else
        $users=User::where('name','like', '%'.$searchbox. '%')->get();

          return view('users.index', ['user'=> $users]);

    }

    public function create(){
        return view('users.create');
    }



 /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // var_dump ($request->input());
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        // var_dump([$name, $email]);


        $user = new User;

        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = Hash::make($password);

        $user->save();


        return Redirect::route('users.index') ;
        // die();
        // $name = $request->input('name');

        //
    }

    public function show($id, Request $request){
        // var_dump('id');
        $user = User::where('id', $id) ->first();
        // var_dump($user);

    return view('users.show', ['user'=>$user]);


}

public function update($id, Request $request){
    // var_dump($id);
    // var_dump ($request->input());

    $user = User::find($id);
    $user->name = $request->input('name');
    $user->role = $request->input('role');
    $user->email = $request->input('email');
    if('' != $request->input('password')){
        $user->password = Hash::make ($request->input('password'));
    }

    $user->save();

    // die;

    return Redirect::route('users.index') ;

}

public function destroy($id, Request $request){

    // var_dump($id);
    User::destroy($id);
    // die;
    return Redirect::route('users.index') ;
}
// API ALL

public function apiGetAll(){

    $users = User::all();

    return response()->json($users,200);
}

// API ONE

public function apiGetOne($id){

    try{
        $users = User::where('id',$id)->firstOrFail();
    } catch (\Throwable $th) {
        return response()->json('User Not Found',404);
    }

    return response()->json($users,200);
}

    // API CREATE USER

    public function apiCreateUser(Request $request){

        $validators = Validator::make($request->all(),[
            'email' => 'required | email | max:200 | unique:users,email',
            'name' => 'required | max:100',
            'role' => 'required | in:member,admin',
            'password' => 'required | max:50'
        ]);

        if($validators ->fails()){
            $errors = $validators->errors();
            return response()->json($errors, 400);
        }

        $data = $request->only([
            'name',
            'email',
            'password',
            'role'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if($user){

            $responseData = [
                'status' => 'sucess',
                'message' => 'User Created'
            ];

            return response()->json($responseData,200);
        }else{
            return response()->json('Unable to Create',400);
        }

        return response()->json('',200);
// SAVE DB
}

    public function apiUpdateUser(Request $request,$id)
            {

               try{
                        $user=User::find($id);
                        $user->update($request->all());


                        $responseData = [
                            'status' => 'sucess',
                            'message' => 'Update sucessefuly'
                        ];

                        return $responseData;
             } catch (\Throwable $th) {

                        return response()->json('User Not Updated',404);
                }
            }



    public function apiDeleteUser($id)
            {
                try{

                    $user=User::destroy($id);

                    $responseData = [
                        'status' => 'sucess',
                        'message' => 'delete sucessefuly'
                    ];
                    return $responseData ;

                } catch (\Throwable $th) {

                    return response()->json('User Not Updated',404);
                }
            }

            public function profile(Request $request){

                return $request->user();
            }

    }
