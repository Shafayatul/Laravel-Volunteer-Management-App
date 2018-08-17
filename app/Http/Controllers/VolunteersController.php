<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Session;
use Image;
use App\Volunteer;
use Illuminate\Http\Request;
use \DataTables;

class VolunteersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/uploads');
    }

    public function index(Request $request)
    {
        return view('volunteers.index');
    }
    
    public function volunteers_list()
    {
        $volunteers = Volunteer::
                select(
                    'volunteers.id as id', 
                    'volunteers.user_id as user_id', 
                    'volunteers.phone_number as phone_number'
                );
        return Datatables::of($volunteers)
            ->addColumn('action', function($row){
                /*<a href="'.url("/volunteers/" . $row->id).'" title="View Volunteer"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>*/
                return '
                <a href="'.url("/volunteers/" . $row->id . "/edit").'" title="Edit Volunteer"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i></button></a>

                <button class="btn btn-danger btn-sm user-delete" title="Delete Volunteer" user-id="'.$row->user_id.'"><i class="material-icons">delete</i></button>
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
        return view('volunteers.create');
    }
    public function signup()
    {
        return view('volunteers.signup');
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


            $volunteer = new Volunteer;
            $volunteer->user_id             = $user->id;
            $volunteer->first_name          = $request->first_name;
            $volunteer->last_name           = $request->last_name;
            $volunteer->phone_number        = $request->phone_number;
            $volunteer->provide_detail      = $request->provide_detail;
            $volunteer->current_employer    = $request->current_employer;
            $volunteer->years_of_experience = $request->years_of_experience;
            $volunteer->linkedin            = $request->linkedin;
            $volunteer->instagram           = $request->instagram;
            $volunteer->facebook            = $request->facebook;
            $volunteer->twitter             = $request->twitter;
            $volunteer->image               = $save_name;
            $volunteer->save();

            Session::flash('success','Volunteer has been successfully added.');
        }

       return redirect(route('volunteers.create'));
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


            $volunteer = new Volunteer;
            $volunteer->user_id             = $user->id;
            $volunteer->first_name          = $request->first_name;
            $volunteer->last_name           = $request->last_name;
            $volunteer->phone_number        = $request->phone_number;
            $volunteer->provide_detail      = $request->provide_detail;
            $volunteer->current_employer    = $request->current_employer;
            $volunteer->years_of_experience = $request->years_of_experience;
            $volunteer->linkedin            = $request->linkedin;
            $volunteer->instagram           = $request->instagram;
            $volunteer->facebook            = $request->facebook;
            $volunteer->twitter             = $request->twitter;
            $volunteer->image               = $save_name;
            $volunteer->save();

            if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                // Mail::to($user->email)->send(new Welcome());
                return redirect()->to('/home');
            }
        }

       return redirect(route('volunteers.create'));
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
        $volunteer = Volunteer::findOrFail($id);

        return view('volunteers.show', compact('volunteer'));
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
        $volunteer = Volunteer::findOrFail($id);

        return view('volunteers.edit', compact('volunteer'));
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


        $volunteer = Volunteer::findOrFail($id);
        $volunteer->first_name          = $request->first_name;
        $volunteer->last_name           = $request->last_name;
        $volunteer->phone_number        = $request->phone_number;
        $volunteer->provide_detail      = $request->provide_detail;
        $volunteer->current_employer    = $request->current_employer;
        $volunteer->years_of_experience = $request->years_of_experience;
        $volunteer->linkedin            = $request->linkedin;
        $volunteer->instagram           = $request->instagram;
        $volunteer->facebook            = $request->facebook;
        $volunteer->twitter             = $request->twitter;
        if ($save_name !="") {
            $volunteer->image               = $save_name;
        }
        $volunteer->save();
        //update name
        $name = $request->first_name.' '.$request->last_name;
        $user = User::find($volunteer->user_id);
        $user->name = $name;
        $user->save();

        return redirect('volunteers')->with('flash_message', 'Volunteer updated!');
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
        Volunteer::destroy($id);

        return redirect('volunteers')->with('flash_message', 'Volunteer deleted!');
    }
    public function ajax_delete_volunteer(Request $request)
    {
        $volunteer = Volunteer::where('user_id', $request->input('userId'))->first();
        Volunteer::destroy($volunteer->id);
        $user = User::destroy($request->input('userId'));
        return response()->json(array('msg'=> 'Success'), 200);
    }    
}
