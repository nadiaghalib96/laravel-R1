<?php
namespace App\Traits;

Trait Common {
    public function uploadFile($file, $path){
        $file_extension = $file->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $file->move($path, $file_name);
        return "$path/$file_name";
    }
}
    
?>