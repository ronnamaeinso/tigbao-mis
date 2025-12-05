<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HelperController extends Controller
{
    public function viewFile(Request $request)
    {
        try {

            $raw_path = $request->path; // get path
            $path = urldecode($raw_path);

            // check if dir if exist if not then response 404
            if (!Storage::disk('local')->exists($path)) {

                if ($request->type == 'live') {
                    abort(404);
                } else if ($request->type == 'blob') {
                    return response(null, 404);
                }
            }

            // get file
            $file = Storage::disk('local')->get($path);

            // get mimetype
            $mimeType = Storage::disk('local')->mimeType($path);

            // return response file with header content-type its mimetype
            return response($file, 200)->header('Content-Type', $mimeType);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500 or abort 500
             */
            // dd($th->getMessage());
            Log::error($th->getMessage());
            if ($request->type == 'live') {
                abort(500);
            } else if ($request->type == 'blob') {
                return response(null, 500);
            }
        }
    }

    // upload file
    public static function uploadFile($file, string $dir, string $storeType = 'local', bool $keepOriginalFilename = false) : string {
        try {

            // if keep original filename is true
            if($keepOriginalFilename){

                // sanitized filename
                $sanitizedFilename = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $file->getClientOriginalFilename());

                // return result
                return Storage::disk($storeType)->putFileAs($dir, $file, $sanitizedFilename);
            }

            // else return result
            return Storage::disk($storeType)->putFile($dir, $file);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
