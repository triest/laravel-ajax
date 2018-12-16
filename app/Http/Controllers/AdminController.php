<?php

namespace App\Http\Controllers;

use App\A;
use App\User;
use Illuminate\Http\Request;
use App\B;
use App\Education;
use Illuminate\Support\Facades\Input;
use File;
use Response;
use App\Image;
use App\Main;

class AdminController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function b()
    {
        return view("admin/index");
    }

    public function showB($id)
    {

        if ($id == null) {
            return abort(404);
        }
        $did = B::select('id',
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
        $content = $did->Content()->get();
        return view("admin/bDetail")->with(['item' => $did, 'content' => $content]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showA($id)
    {
        if ($id == null) {
            return abort(404);
        }
        $did = A::select('id',
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
        $content = $did->Content()->get();
        return view("admin/aDetail")->with(['item' => $did, 'content' => $content]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function deleteDid($id)
    {
        if ($id == null) {
            return abort(404);
        }
        $did = B::find($id);
        if ($did == null) {
            return abort(404);
        }
        $did->delete();
        return redirect('admin');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function deleteRand($id)
    {
        if ($id == null) {
            return abort(404);
        }
        $rand = A::select('id',
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


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function didIndex(Request $request)
    {
        $dids = B::select('id',
            'name',
            'phone',
            'email',
            'education_id',
            'femili',
            'description',
            'created_at',
            'updated_at')->simplePaginate(20);
        return view("admin/b")->with(['dids' => $dids]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function randIndex(Request $request)
    {
        $rand = A::select('id',
            'name',
            'phone',
            'email',
            'education_id',
            'femili',
            'description',
            'created_at',
            'updated_at')->simplePaginate(20);
        return view("admin/a")->with(['rands' => $rand]);
    }

    //назначить организаторов

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Organizer(Request $request)
    {
        $users = User::all();
        return view('admin/makeOrganizer')->with(['users' => $users]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    public function getUsers(Request $request)
    {
        $users = User::all();

        return Response::json($users);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function makeB(Request $request)
    {
        $user = User::find($request->id)->first();
        $user->aOrganizer = 1;
        $user->save();
        return Response::json(['result' => '200']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    public function makeA(Request $request)
    {
        $user = User::find($request->id)->first();
        $user->bOrganizer = 1;
        $user->save();
        return Response::json(['result' => '200']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function deleteUserB(Request $request)
    {
        $user = User::find($request->id)->first();
        $user->aOrganizer = 0;
        $user->save();
        return Response::json(['result' => '200']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function deleteUserA(Request $request)
    {
        $user = User::find($request->id)->first();
        $user->bOrganizer = 0;
        $user->save();
        return Response::json(['result' => '200']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getImages(Request $request)
    {
        $main = Main::select([
            'id',
            'title',
            'description',
            'created_at',
            'updated_at'
        ])->first();
        if ($main != null) {
            $images = $main->images()->get();
        }

        return Response::json($images);
    }

}
