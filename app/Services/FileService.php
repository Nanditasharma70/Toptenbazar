<?php

namespace App\Services;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function deleteExistingImage($files)
    {
        if(sizeof($files) > 0){
             foreach ($files as $file) {
            if (Storage::disk('customupload')->exists($file->path)) {
                        Storage::disk('customupload')->delete($file->path);
                    }
                }
            return true;
        }else{
            return false;
        }
      
           
    }
}
