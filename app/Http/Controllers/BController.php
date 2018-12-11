<?php

namespace App\Http\Controllers;

use App\B;
use App\Education;
use App\BContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Auth;
use Mail;

class BController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->bOrganizer == 1) {
            $dids = B::select('id',
                'title',
                'name',
                'phone',
                'email',
                'education_id',
                'femili',
                'description',
                'created_at',
                'updated_at')->simplePaginate(20);
        } else {
            $dids = null;
        }
        return view("b/index")->with(['dids' => $dids]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $educations = Education::select('id',
            'name',
            'created_at',
            'updated_at')->get();

        return view('b.create')->with(['educations' => $educations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ip = $request->ip();
        $did = new B();
        $did->name = $request->name;
        $did->femili = $request->femili;
        $did->email = $request->email;
        $did->phone = $request->phone;
        $did->description = $request->description;
        $did->ip = $ip;
        $did->save();
        $education = Education::select('id',
            'name',
            'created_at',
            'updated_at')
            ->where('id', $request->education)
            ->first();
        $education->did()->save($did);
        $did->save();
        if (Input::hasFile('files')) {
            foreach ($request->files as $key) {
                foreach ($key as $key2) {
                    $image_extension = $key2->getClientOriginalExtension();
                    $type = $this->mime_content_type($image_extension);      //получпем тип загруженного файла
                    $image_new_name = md5(microtime(true));
                    $key2->move(public_path() . '/images/upload/',
                        strtolower($image_new_name . '.' . $image_extension));
                    $b_content = new BContent();
                    $b_content->file_name = $image_new_name . '.' . $image_extension;   //сохраняем и привязываем к обьекту A;
                    $b_content->content_type = $type;
                    $b_content->save();
                    $did->Content()->save($b_content);
                    $did->save();
                }
            }
        }
        //$user = Auth::user();
        //$this->sendMail($user->email);
        return Response::json(['result' => '200']);
    }

    public function sendMail($mail)
    {
        $testname = 'testname1';
        Mail::send('mail.test', ['name' => $testname], function ($message) use ($mail) {
            $message
                ->to($mail, 'some guy')
                ->from('sakura-testmail@sakura-city.info')
                ->subject('Спасибо что зарегистрировались');
        });
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\B $did
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        if (Auth::user()->randOrganizer == 1) {
            $item = B::select([
                'id',
                'name',
                'phone',
                'email',
                'education_id',
                'femili',
                'description',
                'created_at',
                'updated_at',
                'ip'
            ])->where('id', $id)->first();
            if ($item == null) {
                return abort(404);
            }

        } else {
            return abort(404);
        }
        return view('b/detail')->with(['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\B $did
     * @return \Illuminate\Http\Response
     */
    public function edit(B $did)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\B $did
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, B $did)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\B $did
     * @return \Illuminate\Http\Response
     */
    public function destroy(B $did)
    {
        //
    }

    public function getIp()
    {
        foreach (array(
                     'HTTP_CLIENT_IP',
                     'HTTP_X_FORWARDED_FOR',
                     'HTTP_X_FORWARDED',
                     'HTTP_X_CLUSTER_CLIENT_IP',
                     'HTTP_FORWARDED_FOR',
                     'HTTP_FORWARDED',
                     'REMOTE_ADDR'
                 ) as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP,
                            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    function mime_content_type($filename)
    {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'PNG' => 'image',
            'png' => 'image',
            'jpe' => 'image',
            'jpeg' => 'image',
            'jpg' => 'image',
            'gif' => 'image',
            'bmp' => 'image',
            'ico' => 'image',
            'tiff' => 'image',
            'tif' => 'image',
            'svg' => 'image',
            'svgz' => 'image',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'doc',
            'psd' => 'doc',
            'ai' => 'doc',
            'eps' => 'doc',
            'ps' => 'doc',

            // ms office
            'doc' => 'doc',
            'rtf' => 'doc',
            'xls' => 'doc',
            'ppt' => 'doc',

            // open office
            'odt' => 'doc',
            'ods' => 'doc',
        );

        //   $ext = strtolower(array_pop(explode('.', $filename)));
        $ext = $filename;
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        } else {
            return null;
        }
    }
}
