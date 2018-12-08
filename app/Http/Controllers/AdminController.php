<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Did;
use App\Education;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dids = Did::select('id',
            'name',
            'phone',
            'email',
            'education_id',
            'femili',
            'description',
            'created_at',
            'updated_at')->simplePaginate(20);
        return view("admin/index")->with(['dids' => $dids]);
    }

    public function showDid($id)
    {

        if ($id == null) {
            return abort(404);
        }

        $did = Did::select('id',
            'name',
            'phone',
            'email',
            'education_id',
            'femili',
            'description',
            'created_at',
            'updated_at',
            'ip')
            ->where('id', $id)->first();
        if ($did == null) {
            return abort(404);
        }

        return view("admin/detail")->with(['did' => $did]);
    }

    public function deleteDid($id)
    {
        if ($id == null) {
            return abort(404);
        }
        $did = Did::find($id);
        if ($did == null) {
            return abort(404);
        }
        $did->delete();
        return redirect('admin');
    }
}
