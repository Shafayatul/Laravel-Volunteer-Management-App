<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Image;
use Session;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use \DataTables;

class TeachersController extends Controller
{
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/uploads');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('teachers.index');
    }

    
    public function profile()
    {
      $user = Auth::user();
      $teacher = Teacher::where('user_id', $user->id)->first();
      return view('teachers.profile', compact('user', 'teacher'));
    }
    

    public function teachers_list()
    {
        $teachers = Teacher::
                select(
                    'teachers.id as id', 
                    'teachers.user_id as user_id', 
                    'teachers.school_name as school_name', 
                    'teachers.phone_number as phone_number'
                );
        return Datatables::of($teachers)
            ->addColumn('action', function($row){
                /*<a href="'.url("/teachers/" . $row->id).'" title="View Teacher"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>*/
                return '
                <a href="'.url("/teachers/" . $row->id . "/edit").'" title="Edit Teacher"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i></button></a>

                <button class="btn btn-danger btn-sm user-delete" title="Delete Teacher" user-id="'.$row->user_id.'"><i class="material-icons">delete</i></button>
                ';
            })
            ->addColumn('name', function($row){
                $user = User::where('id', $row->user_id)->first();
                return $user->name;
            })
            ->addColumn('email', function($row){
                $user = User::where('id', $row->user_id)->first();
                return $user->email;
            })

            ->rawColumns(['action', 'name', 'email'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('teachers.create');
    }
    public function signup()
    {
        return view('teachers.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
            'first_name' => 'required',
        ]);

        $name = $request->first_name.' '.$request->last_name;
        $user = User::create(
            [
             'name'             => $name,
             'email'            => $request->email,
             'password'         => bcrypt($request->password)
            ]);
        if($user){

            $user->syncRoles('Teacher');

            if ($request->hasFile('image')) {

              $photo = $request->file('image');


              $name = sha1(date('YmdHis') . str_random(30));
              $save_name = $name . '.' . $photo->getClientOriginalExtension();
              Image::make($photo)
                  ->resize(200, null, function ($constraints) {
                      $constraints->aspectRatio();
                  })
                  ->save($this->photos_path.'/thumbnail/'.$save_name);

              $photo->move($this->photos_path.'/', $save_name);
            }else{
                $save_name = "";
            }

            $teacher = new Teacher;
            $teacher->user_id = $user->id;
            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->phone_number = $request->phone_number;
            $teacher->school_name = $request->school_name;
            $teacher->class_one = $request->class_one;
            $teacher->class_two = $request->class_two;
            $teacher->class_three = $request->class_three;
            $teacher->image = $save_name;
            $teacher->save();

            Session::flash('success','Teacher has been successfully added.');
        }

       return redirect(route('teachers.create'));
        
    }
    public function signup_store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
            'first_name' => 'required',
        ]);

        $name = $request->first_name.' '.$request->last_name;
        $user = User::create(
            [
             'name'             => $name,
             'email'            => $request->email,
             'password'         => bcrypt($request->password)
            ]);
        if($user){

            $user->syncRoles('Teacher');

            if ($request->hasFile('image')) {

              $photo = $request->file('image');


              $name = sha1(date('YmdHis') . str_random(30));
              $save_name = $name . '.' . $photo->getClientOriginalExtension();
              Image::make($photo)
                  ->resize(200, null, function ($constraints) {
                      $constraints->aspectRatio();
                  })
                  ->save($this->photos_path.'/thumbnail/'.$save_name);

              $photo->move($this->photos_path.'/', $save_name);
            }else{
                $save_name = "";
            }

            $teacher = new Teacher;
            $teacher->user_id = $user->id;
            $teacher->first_name = $request->first_name;
            $teacher->last_name = $request->last_name;
            $teacher->phone_number = $request->phone_number;
            $teacher->school_name = $request->school_name;
            $teacher->class_one = $request->class_one;
            $teacher->class_two = $request->class_two;
            $teacher->class_three = $request->class_three;
            $teacher->image = $save_name;
            $teacher->save();

            if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                // Mail::to($user->email)->send(new Welcome());
                return redirect()->to('/home');
            }
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $teacher = Teacher::findOrFail($id);
        $teacher->update($requestData);

        //update name
        $name = $request->first_name.' '.$request->last_name;
        $user = User::find($teacher->user_id);
        $user->name = $name;
        $user->save();

        return redirect('teachers')->with('flash_message', 'Teacher updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Teacher::destroy($id);

        return redirect('teachers')->with('flash_message', 'Teacher deleted!');
    }    
    public function ajax_delete_teacher(Request $request)
    {
        $teacher = Teacher::where('user_id', $request->input('userId'))->first();
        Teacher::destroy($teacher->id);
        $user = User::destroy($request->input('userId'));
        return response()->json(array('msg'=> 'Success'), 200);
    }
}
