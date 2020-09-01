<?php

namespace App\Http\Controllers;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Upload extends Controller
{


    public function delete($id)
    {
        $file = File::find($id);
        if (!empty($file)) {
            Storage::delete($file->full_file);
            $file->delete();
        }
    }
    public function delete_files($product_id)
    {
        $files = File::where('file_type','product')->where('relation_id',$product_id)->get();
        if (count($files) > 0) {
            foreach($files as $file) 
            {
                $this->delete($file->id);
                Storage::deleteDirectory($file->path);
            }
        }
    }
    public function upload($data = [])
    {
        if (in_array('new_name',$data))
        {
            $new_name = $data['new_name'] === null ?time():$data['new_name'];
        }
        if (request()->hasFile($data['file']) && 'single' == $data['upload_type'])
        {
            Storage::has($data['delete_file'])?Storage::delete($data['delete_file']):'';
            return request()->file($data['file'])->store($data['path']);
        } elseif(request()->hasFile($data['file']) && 'files' == $data['upload_type']) 
        {
            $file       = request()->file($data['file']);
            $size       = $file->getMimeType();
            $mime_type  = $file->getMimeType();
            $name       = $file->getClientOriginalName();
            $hashname   = $file->hashName();
            
            $file->store($data['path']);

            $add  = File::create([
                'name'          =>$name,
                'size'          =>$size,
                'file'          =>$hashname,
                'path'          =>$data['path'],
                'full_file'     =>$data['path'] . '/' . $hashname,
                'mime_type'     =>$mime_type,
                'file_type'     =>$data['file_type'],
                'relation_id'   =>$data['relation_id'],
            ]);
            return $add->id;
        }
    }
}
