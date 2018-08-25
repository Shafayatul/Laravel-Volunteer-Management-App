<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Opportunity;
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
                <a href="'.url("/opportunities/" . $row->id).'" title="Detail"><button class="btn btn-primary btn-sm"><i class="material-icons">details</i></button></a>
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
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $opportunities = Opportunity::where('title', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->orWhere('start_time', 'LIKE', "%$keyword%")
                ->orWhere('end_time', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('contact_number', 'LIKE', "%$keyword%")
                ->orWhere('contact_name', 'LIKE', "%$keyword%")
                ->orWhere('contact_email', 'LIKE', "%$keyword%")
                ->orWhere('is_volunteer_limit', 'LIKE', "%$keyword%")
                ->orWhere('number_of_volunteer', 'LIKE', "%$keyword%")
                ->orWhere('detail', 'LIKE', "%$keyword%")
                ->orWhere('number_of_student', 'LIKE', "%$keyword%")
                ->orWhere('is_call', 'LIKE', "%$keyword%")
                ->orWhere('subject1', 'LIKE', "%$keyword%")
                ->orWhere('subject2', 'LIKE', "%$keyword%")
                ->orWhere('subject3', 'LIKE', "%$keyword%")
                ->orWhere('subject4', 'LIKE', "%$keyword%")
                ->orWhere('subject5', 'LIKE', "%$keyword%")
                ->orWhere('subject6', 'LIKE', "%$keyword%")
                ->orWhere('subject7', 'LIKE', "%$keyword%")
                ->orWhere('subject8', 'LIKE', "%$keyword%")
                ->orWhere('is_published', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $opportunities = Opportunity::latest()->paginate($perPage);
        }

        return view('opportunities.index', compact('opportunities'));
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

        return view('opportunities.edit', compact('opportunity'));
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
        
        $opportunity = Opportunity::findOrFail($id);
        $opportunity->update($requestData);

        return redirect('opportunities')->with('flash_message', 'Opportunity updated!');
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

        return redirect('opportunities')->with('flash_message', 'Opportunity deleted!');
    }
}
