<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Opportunity;
use App\Teacher;
use App\Volunteer;
use App\OpportunityCommit;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use \DataTables;
use App\Mail\NewOpportunity;
use App\Mail\TeacherEmail;
use App\Mail\ApproveConfirmation;
use Illuminate\Support\Facades\Mail;
use Twilio;
use Twilio\Rest\Client;

class OpportunitiesController extends Controller
{

    private function send_sms($to, $message)
    {

        $sid    = env('TWILIO_ACCOUNT_SID');
        $token  = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
                          ->create($to,
                                   array("from" => env('TWILIO_NUMBER'), "body" => $message)
                          );

        return true;        
    }



    public function commited_volunteer($id)
    {
        $opportunity = Opportunity::where('id', $id)->first();
        $total_volunteer = OpportunityCommit::where('opportunity_id', $id)->count();
        if ((is_numeric($opportunity->number_of_volunteer)) || ($opportunity->number_of_volunteer!=0)) {
            $empty_position = $opportunity->number_of_volunteer-$total_volunteer;
        }else{
            $empty_position = "--";
            $total_volunteer = "--";
        }
         
        return view('opportunities.commited-volunteer',compact('opportunity', 'total_volunteer', 'empty_position', 'id'));
    }

    public function commited_volunteer_list($id)
    {
        $user_id_array = OpportunityCommit::where('opportunity_id', $id)->pluck('user_id');
        $created_at_array = OpportunityCommit::where('opportunity_id', $id)->pluck('created_at','user_id');
        $status_array = OpportunityCommit::where('opportunity_id', $id)->pluck('status','user_id');

        $volunteers = Volunteer::whereIn('user_id', $user_id_array);
        return Datatables::of($volunteers)
            ->addColumn('status', function($row) use($status_array){
                if ($status_array[$row->user_id] == "pending") {
                    $str = '<button type="button" class="btn btn-sm bg-orange waves-effect">
                                <i class="material-icons">loop</i>
                                <span>Pending</span>
                            </button>';
                }elseif ($status_array[$row->user_id] == "approved") {
                    $str = '<button type="button" class="btn btn-sm bg-blue waves-effect">
                                <i class="material-icons">how_to_reg</i>
                                <span>Approved</span>
                            </button>';
                }
                return $str;
            })
            
            ->addColumn('profile', function($row){
                return '
                <a target=”_blank” href="'.url("/admin/volunteers/profile").'/'.$row->user_id.'" title="Profile"><button class="btn btn-info btn-sm"><i class="material-icons">perm_identity</i></button></a>
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
            ->addColumn('commited', function($row) use($created_at_array){
                return $created_at_array[$row->user_id];
            })
            ->addColumn('checkbox', function($row){
                return '<input type="checkbox" id="'.$row->user_id.'" class="filled-in chk-col-red" ><label for="'.$row->user_id.'"></label>';
            })

            ->rawColumns(['status', 'name', 'email','commited', 'checkbox', 'profile'])
            ->make(true);

    }

    public function opportunities_list()
    {
        $id = Auth::id();
        $opportunities = Opportunity::where('user_id', $id)->get();
        return Datatables::of($opportunities)
            ->addColumn('action', function($row){
                if ($row->is_published==1) {
                    $status ='<button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="published">
                            <i class="material-icons">done_outline</i>
                        </button>';
                }else{
                    $status ='<button type="button" class="btn bg-grey btn-circle waves-effect waves-circle waves-float" title="saved">
                                <i class="material-icons">save</i>
                            </button>';
                }
                return $status.'
                <a href="'.url("/opportunities/commited-volunteer/" . $row->id).'" title="Commited Volunteer"><button class="btn btn-warning btn-sm"><i class="material-icons">group</i></button></a>   
                <a href="'.url("/opportunities/" . $row->id).'" title="Detail"><button class="btn btn-info btn-sm"><i class="material-icons">details</i></button></a>
                <a href="'.url("/opportunities/" . $row->id . "/edit").'" title="Edit Opportunity"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i></button></a>
                ';
            })
            ->addColumn('vol_requested', function($row){
                if ((is_numeric($row->number_of_volunteer)) || ($row->number_of_volunteer!=0)) {
                    return $row->number_of_volunteer;
                }else{
                    return "--";
                }
                
            })
            ->addColumn('vol_commited', function($row){
                return OpportunityCommit::where('opportunity_id', $row->id)->count();
            })
            ->rawColumns(['action', 'vol_requested', 'vol_commited'])
            ->make(true);
    }

    public function opportunities_all_list()
    {
        $opportunities = Opportunity::orderBy('id', 'desc')->get();
        return Datatables::of($opportunities)
            ->addColumn('action', function($row){
                return '
                <a href="'.url("/opportunities/commited-volunteer/" . $row->id).'" title="Commited Volunteer"><button class="btn btn-warning btn-sm"><i class="material-icons">group</i></button></a>                
                <a href="'.url("/opportunities/" . $row->id).'" title="Detail"><button class="btn btn-info btn-sm"><i class="material-icons">details</i></button></a>
                <a href="'.url("/opportunities/" . $row->id . "/edit").'" title="Edit Opportunity"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i></button></a>
                ';
            })            
            ->addColumn('vol_requested', function($row){
                if ((is_numeric($row->number_of_volunteer)) || ($row->number_of_volunteer!=0)) {
                    return $row->number_of_volunteer;
                }else{
                    return "--";
                }
                
            })
            ->addColumn('vol_commited', function($row){
                return OpportunityCommit::where('opportunity_id', $row->id)->count();
            })
            ->rawColumns(['action', 'vol_requested', 'vol_commited'])
            ->make(true);
    }

    public function opportunities_new_list()
    {
        $date = date("Y-m-d");
        $opportunities = Opportunity::where('date', '>=', $date)->orderBy('id', 'desc')->get();
        return Datatables::of($opportunities)
            ->addColumn('action', function($row){
                return '
                <a href="'.url("/opportunities/decision/" . $row->id).'" title="Take Decision"><button class="btn btn-primary btn-sm"><i class="material-icons">event_seat</i></button></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('opportunities.index');
    }

    public function all()
    {
        return view('opportunities.all');
    }


    public function new()
    {
        return view('opportunities.new');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('opportunities.create');
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
            'title' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $user = Auth::user();

        $requestData = $request->all();
        
        $opprotunity = Opportunity::create($requestData+['user_id'=>$user->id]);

        foreach ($request->tasks as $task) {
            if ($task !="") {
                Task::create(['opportunity_id'=>$opprotunity->id, 'description'=>$task]);
            }
        }

        if ($opprotunity->is_published==1) {
            $this->send_email_for_new_opportunity($opprotunity->id, $opprotunity);
        }
        

        Session::flash('success','Opportunity has been successfully added.');

        return redirect('opportunities')->with('flash_message', 'Opportunity added!');
    }

    /**
     * Send email to all volunteer
     *
     * @param  object  $opprotunity
     *
     * @return null
     */
    public function send_email_for_new_opportunity($id, $opportunity){
        //get teacher's name
        $teacher_name = User::where('id', $opportunity->user_id)->first()->name;

        // get teacher's school
        $school_name = Teacher::where('user_id', $opportunity->user_id)->first()->school_name;

        //get emails of the volunteer
        $volunteer_ids = Volunteer::pluck('user_id');
        $volunteer_emails = User::whereIn('id', $volunteer_ids)->pluck('email');
        // Send Email
        Mail::to($volunteer_emails)->send(new NewOpportunity($id, $opportunity, $teacher_name, $school_name));

        //Send SMS to all volunteer
        $to = Volunteer::pluck('phone_number')->toArray();
        $message = 'A new opportunity is active now. Title:'.$opportunity->title.', Date: '.$opportunity->date.'['.$opportunity->start_time.'-'.$opportunity->end_time.']. For detail visit: '.url('/opportunities/decision/'.$id);
        $this->send_sms($to, $message);
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
        $opportunity = Opportunity::findOrFail($id);
        $tasks = Task::where('opportunity_id', $id)->get();

        return view('opportunities.show', compact('opportunity', 'tasks'));
    }

    public function decision($id)
    {
        $opportunity = Opportunity::findOrFail($id);
        $tasks = Task::where('opportunity_id', $id)->get();

        $user_id = Auth::id();
        $is_commited = 0;
        $is_commited = OpportunityCommit::where('user_id', $user_id)->where('opportunity_id', $id)->count();

        if ($is_commited == 1) {
            if (OpportunityCommit::where('user_id', $user_id)->where('opportunity_id', $id)->where('status', 'approved')->count()==1) {
                Session::flash('success','Congratulation!!! You have been approved by the teacher.');
            }else{
                Session::flash('success','Congratulation!!! You have committed to this opportunity. The final decision will be taken by the teacher. The teacher will send you confirmation E-MAIL or SMS.');
            }
            
        }

        return view('opportunities.decision', compact('opportunity', 'tasks', 'id', 'is_commited'));
    }

    public function accept(Request $request)
    {
        $opportunity_id = $request->input('opportunityId');
        $user_id = Auth::id();
        
         $opportunity_commit = new OpportunityCommit;
         $opportunity_commit->user_id = $user_id;
         $opportunity_commit->opportunity_id = $opportunity_id;
         $opportunity_commit->save();

        return response()->json(array('msg'=> 'Success'), 200);
    }

    public function approve_volunteer(Request $request)
    {
        $opportunity_id = $request->input('opportunityId');
        $user_id = $request->input('userId');
        $message = $request->input('message');

        OpportunityCommit::whereIn('user_id', $user_id)->where('opportunity_id', $opportunity_id)->update(['status' => 'approved']);
        
        // sending email
        $this->send_email_for_volunteer_approval($opportunity_id, $user_id, $message);


        return response()->json(array('msg'=> 'Success'), 200);
    }

    public function sms_to_volunteer(Request $request)
    {
        $opportunity_id = $request->input('opportunityId');
        $user_id = $request->input('userId');
        $to = Volunteer::whereIn('user_id', $user_id)->pluck('phone_number')->toArray();;
        $message = $request->input('message');
        
        // sending email
        $this->send_sms($to, $message);

        return response()->json(array('msg'=> 'Success'), 200);
    }

    public function email_to_volunteer(Request $request)
    {
        $opportunity_id = $request->input('opportunityId');
        $user_id = $request->input('userId');
        $message = $request->input('message');
        
        // sending email
        $this->send_email_to_volunteer($opportunity_id, $user_id, $message);


        return response()->json(array('msg'=> 'Success'), 200);
    }

    public function send_email_to_volunteer($id, $volunteer_ids, $message){
        
        $opprotunity = Opportunity::where('id', $id)->first();
        //get emails of the volunteer
        $volunteer_emails = User::whereIn('id', $volunteer_ids)->pluck('email');

        // Send Email
        Mail::to($volunteer_emails)->send(new TeacherEmail($id, $opprotunity, $message));
    }

    public function send_email_for_volunteer_approval($id, $volunteer_ids, $message){
        
        $opportunity = Opportunity::where('id', $id)->first();
        //get emails of the volunteer
        $volunteer_emails = User::whereIn('id', $volunteer_ids)->pluck('email');

        // Send Email
        Mail::to($volunteer_emails)->send(new ApproveConfirmation($id, $opportunity, $message));

        //Send SMS to all volunteer
        $to = Volunteer::whereIn('user_id', $volunteer_ids)->pluck('phone_number')->toArray();
        $message = 'You are approved as a volunteer. Opportunity Title:'.$opportunity->title.', Date: '.$opportunity->date.'['.$opportunity->start_time.'-'.$opportunity->end_time.']. For detail visit: '.url('/opportunities/decision/'.$id);
        $this->send_sms($to, $message);

    }

    public function decline()
    {
        Session::flash('success','Thanks for your action. You can check other available opportunities below.');
        return view('/opportunities/new');
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


        $opportunity = Opportunity::findOrFail($id);
        $tasks = Task::where('opportunity_id', $id)->get();

        return view('opportunities.edit', compact('opportunity', 'tasks'));
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
        //get old $old_opprotunity status
        $old_opprotunity = Opportunity::where('id', $id)->value('is_published'); 
        
        $validatedData = $request->validate([
            'title' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $user = Auth::user();

        $requestData = $request->all();
        
        $opportunity = Opportunity::findOrFail($id);
        $opprotunity = $opportunity->update($requestData+['user_id'=>$user->id]);
        

        Task::where('opportunity_id', $id)->delete();

        foreach ($request->tasks as $task) {
            if ($task !="") {
                Task::create(['opportunity_id'=>$id, 'description'=>$task]);
            }
        }

        if (($request->is_published==1) && ($old_opprotunity==0)) {
            $this->send_email_for_new_opportunity($id, $request);
        }

        Session::flash('success','Opportunity has been successfully updated.');

        return redirect('opportunities');
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
        Opportunity::destroy($id);

        return redirect('opportunities');
    }
}
