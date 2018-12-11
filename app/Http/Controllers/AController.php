<?php

namespace App\Http\Controllers;

use App\B;
use App\A;
use App\AContent;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Auth;

class AController extends Controller
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
        if ($user->aOrganizer == 1) {
            $rands = A::select('id',
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
            $rands = null;
        }
        return view("a/index")->with(['rands' => $rands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('a.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rand = new A();
        $rand->title = $request->title;
        $rand->description = $request->description;
        $rand->save();
        if (Input::hasFile('files')) {
            foreach ($request->files as $key) {
                foreach ($key as $key2) {
                    $image_extension = $key2->getClientOriginalExtension();
                    $type = $this->mime_content_type($image_extension);      //получпем тип загруженного файла
                    $image_new_name = md5(microtime(true));
                    $key2->move(public_path() . '/images/upload/',
                        strtolower($image_new_name . '.' . $image_extension));
                    $rand_content = new AContent();
                    $rand_content->file_name = $image_new_name . '.' . $image_extension;   //сохраняем и привязываем к обьекту A
                    $rand_content->content_type = $type;
                    $rand->randContent()->save($rand_content);
                    $rand->save();
                }
            }
        }
        return Response::json(['result' => '200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\A $rand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = Auth::user();
        if (Auth::user()->aOrganizer == 1) {
            $item = A::select([
                'id',
                'title',
                'description',
                'created_at',
                'updated_at'
            ])->where('id', $id)->first();
            if ($item == null) {
                return abort(404);
            }

        } else {
            return abort(404);
        }
        dump($item);
        return view('a/detail')->with(['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\A $rand
     * @return \Illuminate\Http\Response
     */
    public function edit(A $rand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\A $rand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, A $rand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\A $rand
     * @return \Illuminate\Http\Response
     */
    public function destroy(A $rand)
    {
        //
    }

    //
    function getFileMimeType($file)
    {
        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($finfo, $file);
            finfo_close($finfo);
        } else {
            require_once 'upgradephp/ext/mime.php';
            $type = mime_content_type($file);
        }

        if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
            $secondOpinion = exec('file -b --mime-type ' . escapeshellarg($file), $foo, $returnCode);
            if ($returnCode === 0 && $secondOpinion) {
                $type = $secondOpinion;
            }
        }

        if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
            require_once 'upgradephp/ext/mime.php';
            $exifImageType = exif_imagetype($file);
            if ($exifImageType !== false) {
                $type = image_type_to_mime_type($exifImageType);
            }
        }

        return $type;
    }


    //возвращает тип полученного файла
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
