<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Opportunity;
use App\OpportunityCommit;
use App\Task;
use Illuminate\Http\Request;
use \DataTables;

class OpportunitiesController extends Controller
{


    public function opportunities_list()
    {
        $id = Auth::id();
        $opportunities = Opportunity::where('user_id', $id)->get();
        return Datatables::of($opportunities)
            ->addColumn('action', function($row){
                return '
                <a href="'.url("/opportunities/" . $row->id).'" title="Detail"><button class="btn btn-info btn-sm"><i class="material-icons">details</i></button></a>
                <a href="'.url("/opportunities/" . $row->id . "/edit").'" title="Edit Opportunity"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i></button></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function opportunities_all_list()
    {
        $opportunities = Opportunity::orderBy('id', 'desc')->get();
        return Datatables::of($opportunities)
            ->addColumn('action', function($row){
                return '
                <a href="'.url("/opportunities/" . $row->id).'" title="Detail"><button class="btn btn-info btn-sm"><i class="material-icons">details</i></button></a>
                <a href="'.url("/opportunities/" . $row->id . "/edit").'" title="Edit Opportunity"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i></button></a>
                ';
            })
            ->rawColumns(['action'])
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

        Session::flash('success','Opportunity has been successfully added.');

        return redirect('opportunities')->with('flash_message', 'Opportunity added!');
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
            Session::flash('success','Congratulation!!! You have commited to this opportunity.');
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
