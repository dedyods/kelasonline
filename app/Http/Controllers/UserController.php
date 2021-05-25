<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Storage;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKeyword  = $request->get('keyword');
        $filterLevel    = $request->get('level');
        $data['users']=User::paginate(5);
        if($filterKeyword){
            $data['users'] = User::where('name','LIKE',"%$filterKeyword%")
            ->where('level',$filterLevel)->paginate(5);
        }
        return view('users.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|min:6',
            'name'=>'required|max:255',
            'level'=>'required',
            'gender'=>'required',
            'phone'=>'required|digits_between:10,12',
            'avatar'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if($request->file('avatar')->isValid())
        {
            $avatarFile = $request->file('avatar');
            $extension  = $avatarFile->getClientOriginalExtension();
            $fileName   = "user-avatar/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/user-avatar";
            $request->file('avatar')->move($uploadPath,$fileName);
            $input['avatar'] = $fileName;
        }

        $input['password'] = \Hash::make($request->get('password'));
        User::create($input);
        return redirect()->route('users.index')->with('status','Users Successfully Create');

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
        $data['users'] = User::findOrFail($id);
        return view('users.edit',$data);
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
        $dataUsers  = User::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'level'=>'required',
            'gender'=>'required',
            'phone'=>'required|digits_between:10,15',
            'avatar'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                Storage::disk('upload')->delete($dataUsers->avatar);
                $avatarFile = $request->file('avatar');
                $extension  = $avatarFile->getClientOriginalExtension();
                $fileName   = "user-avatar/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/user-avatar";
                $request->file('avatar')->move($uploadPath,$fileName);
                $input['avatar'] = $fileName; 
            }
        }

        if($request->input('password'))
        {
            $input['password'] = \Hash::make($input['password']);
        }
        else
        {
            $input = Arr::except($input,['password']);                        
        }

        $dataUsers->update($input);
        return redirect()->route('users.index')->with('status','Users Successfully Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataUser   = User::findOrFail($id);
        $dataUser->delete();
        Storage::disk('upload')->delete($dataUser->avatar);
        return redirect()->back()->with('status','User SuccessFully Deleted');
    }
}
