<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SaveBase64ToFileService
{
    private $data;
    private $ext;

    public function setData($data){

        list($type,$chartSet,$data) = explode(';', $data);
        list( , $data) = explode(',', $data);
        $this->data = base64_decode($data);
    }

    public function setExtension($ext){

        $this->ext = $ext;
    }

    public function save($path)
    {
        if($this->data == null || $this->ext == null)
        {
            throw new \Exception("Data or extension missing");
        }

        Storage::disk('public')->put($path.$this->ext,$this->data);
        return 'storage/'.$path;
    }

}