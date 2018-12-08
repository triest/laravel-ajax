<?php

namespace App\Http\Controllers;

use App\Image;
use App\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Filesystem\Exception\IOException;
use File;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Response;
use function Symfony\Component\VarDumper\Tests\Caster\reflectionParameterFixture;
//use Zend\InputFilter\Input;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Repositories\ImageRepository;
use Carbon\Carbon;
use Storage;
use DateTime;
use App\User;
use Mail;
use settype;
use Hash;

use App\Mail\Reminder;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $main = Main::select([
            'id',
            'title',
            'description',
            'created_at',
            'updated_at'
        ])->first();

        if ($main != null) {
            $images = $main->images();
        }

        return view('main.index')->with(['main' => $main]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('main.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:2',
            'description' => 'required|min:10',
        ]);
        $main = new Main();
        $main->title = $request->title;
        $main->description = $request->description;
        $main->save();
        dump($request);
        //die();
        if (Input::hasFile('files')) {
            foreach ($request->images as $key) {
                $image_extension = $key->getClientOriginalExtension();
                $image_new_name = md5(microtime(true));
                $key->move(public_path() . '/images/upload/', strtolower($image_new_name . '.' . $image_extension));
                $image = new Image();
                $image->image_name = $image_new_name . '.' . $image_extension;
                $main->images()->save($image);
                $image->save();
            }
        }

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Main $main
     * @return \Illuminate\Http\Response
     */
    public function show(Main $main)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Main $main
     * @return \Illuminate\Http\Response
     */
    public function edit(Main $main)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Main $main
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Main $main)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Main $main
     * @return \Illuminate\Http\Response
     */
    public function destroy(Main $main)
    {
        //
    }
}
