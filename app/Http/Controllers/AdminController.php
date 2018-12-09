<?php

namespace App\Http\Controllers;

use App\Rand;
use App\User;
use Illuminate\Http\Request;
use App\Did;
use App\Education;
use Illuminate\Support\Facades\Input;
use File;
use Response;

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
        return view("admin/index");
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

    public function deleteRand($id)
    {
        if ($id == null) {
            return abort(404);
        }
        $rand = Rand::select('id',
            'title',
            'description',
            'created_at',
            'updated_at')->where('id', $id)->first();

        if ($rand == null) {
            return abort(404);
        }
        $content = $rand->randContent()->get();

        foreach ($content as $item) {
            try {
                $temp_file = base_path() . '\public\images\upload\\' . $item->file_name;
                dump($temp_file);
                //  die();
                File::Delete($temp_file);
            } catch (\Exception $e) {
                echo "delete errod";
            }
            $item->delete();
        }
        $rand->delete();
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

    //назначить организаторов
    public function Organizer(Request $request)
    {
        $users = User::all();
        dump($users);

        return view('admin/makeOrganizer')->with(['users' => $users]);
    }

    public function getUsers(Request $request)
    {

        $users = User::all();
        return Response::json($users);
    }

}
