<?php

namespace App\Http\Controllers;

use App\Did;
use App\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;

class DidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dids = Did::select('id',
            'name',
            'phone',
            'email',
            'edication_id',
            'femili',
            'description',
            'created_at',
            'updated_at')->simplePaginate(20);
        dump($dids);
        return view("did/index")->with(['dids' => $dids]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $educations = Education::all();

        return view('did.create')->with(['educations' => $educations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dump($request);
        $did=new Did();
        $did->name=$request->name;
        $did->femili=$request->femili;
        $did->email=$request->email;
        $did->phone=$request->phone;
        $did->descrption=$request->description;
        dump($did);
        $did->save();
     //   $education=Education::find($request->education)->first();
      //  dump($education);
    //    die();

       // dump($education);
        $did->education()->save($education);
        $did->save();
        return Response::json(['result' => '200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Did $did
     * @return \Illuminate\Http\Response
     */
    public function show(Did $did)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Did $did
     * @return \Illuminate\Http\Response
     */
    public function edit(Did $did)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Did $did
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Did $did)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Did $did
     * @return \Illuminate\Http\Response
     */
    public function destroy(Did $did)
    {
        //
    }
}
