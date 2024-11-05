<?php


namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadManager
{
    private $request;
    public $disk;

    public function __construct(Request $request, $disk = null)
    {
        $this->request = $request;
        $this->disk = $disk;
        if ($disk == null) {
            $this->disk = Config('filesystems.default');
        }
    }

    public function upload($inputname, $folder, $visibility = 'public')
    {
        set_time_limit(0);
        $file = $this->request->file($inputname);
        $name = $this->generateName($folder, File::extension($file->getClientOriginalName()));
        $filePath = $folder . '/' . $name;
        $output = Storage::disk($this->disk)->put($filePath, fopen($file, 'r+'), $visibility);
        set_time_limit(60);
        if (!$output) {
            return false;
        }
        return $filePath;
    }

    public function uploadFile($file, $folder)
    {
        set_time_limit(0);
        $name = $this->generateName($folder, File::extension($file->getClientOriginalName()));
        $filePath = $folder . '/' . $name;
        $output = Storage::disk($this->disk)->put($filePath, fopen($file, 'r+'), 'public');
        set_time_limit(60);
        if (!$output) {
            return false;
        }
        return $filePath;
    }

    public function uploadBase64($inputname, $folder)
    {
        set_time_limit(0);
        //$file = $this->request->file($inputname);
        $name = $this->generateName($folder, 'jpg');
        $filePath = $folder . '/' . $name;
        $binary_data = base64_decode($this->request->$inputname);
        $output = Storage::disk($this->disk)->put($filePath, $binary_data, 'public');
        set_time_limit(60);
        if (!$output) {
            return false;
        }
        return $filePath;
    }

    public function update($inputname, $folder)
    {
        if (!$this->request->hasFile($inputname)) {
            return false;
        }
        set_time_limit(0);
        $file = $this->request->file($inputname);
        $name = $this->generateName($folder, File::extension($file->getClientOriginalName()));
        $filePath = $folder . '/' . $name;
        $output = Storage::disk($this->disk)->put($filePath, fopen($file, 'r+'), 'public');
        set_time_limit(60);
        if (!$output) {
            return false;
        } else {
            return $filePath;
        }
    }

    private function generateName($path, $extension)
    {
        do {
            $name = md5(time() . rand() . '.' . $extension) . '.' . $extension;
        } while (Storage::disk($this->disk)->exists($path . '/' . $name));
        return $name;
    }
}
