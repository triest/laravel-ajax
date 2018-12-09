<?php

namespace App\Http\Controllers;

use App\Rand;
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
    public function did()
    {

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


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showRand($id)
    {

        if ($id == null) {
            return abort(404);
        }

        $rand = Rand::select('id',
            'id',
            'title',
            'description',
            'created_at',
            'updated_at')
            ->where('id', $id)->first();

        if ($rand == null) {
            return abort(404);
        }

        $content = $rand->randContent()->get();
        dump($content);

        return view("admin/randDetail")->with(['item' => $rand, 'content' => $content]);
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

    public function didIndex(Request $request)
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
        return view("admin/did")->with(['dids' => $dids]);
    }

    public function randIndex(Request $request)
    {
        $rand = Rand::select('id',
            'title',
            'description',
            'created_at',
            'updated_at')->simplePaginate(20);
        return view("admin/rand")->with(['rands' => $rand]);

    }

}
