<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OpportunityCommit;
use Illuminate\Http\Request;

class OpportunityCommitsController extends Controller
{
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
            $opportunitycommits = OpportunityCommit::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('opportunity_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $opportunitycommits = OpportunityCommit::latest()->paginate($perPage);
        }

        return view('opportunity-commits.index', compact('opportunitycommits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('opportunity-commits.create');
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
        
        $requestData = $request->all();
        
        OpportunityCommit::create($requestData);

        return redirect('opportunity-commits')->with('flash_message', 'OpportunityCommit added!');
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
        $opportunitycommit = OpportunityCommit::findOrFail($id);

        return view('opportunity-commits.show', compact('opportunitycommit'));
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
        $opportunitycommit = OpportunityCommit::findOrFail($id);

        return view('opportunity-commits.edit', compact('opportunitycommit'));
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
        
        $opportunitycommit = OpportunityCommit::findOrFail($id);
        $opportunitycommit->update($requestData);

        return redirect('opportunity-commits')->with('flash_message', 'OpportunityCommit updated!');
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
        OpportunityCommit::destroy($id);

        return redirect('opportunity-commits')->with('flash_message', 'OpportunityCommit deleted!');
    }
}
