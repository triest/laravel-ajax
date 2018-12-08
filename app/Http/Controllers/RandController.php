<?php

namespace App\Http\Controllers;

use App\Rand;
use Illuminate\Http\Request;
use Response;
use Auth;

class RandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rands = Rand::select('id',
            'description',
            'created_at',
            'updated_at')->simplePaginate(20);

        return view("rand/index")->with(['dids' => $rands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rand.create');
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
        return Response::json(['result' => '200']);
        //return  Response::json(['result' => $request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rand $rand
     * @return \Illuminate\Http\Response
     */
    public function show(rand $rand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rand $rand
     * @return \Illuminate\Http\Response
     */
    public function edit(rand $rand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\rand $rand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rand $rand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rand $rand
     * @return \Illuminate\Http\Response
     */
    public function destroy(rand $rand)
    {
        //
    }
}
