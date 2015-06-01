<?php

namespace Common;

class ImageHandler
{
    private $file;
    const ROOT = 'img/portrait/';

    public function __construct(array $file)
    {
        $this->file = $file;
    }


    public function sanitizeImageName()
    {
        return preg_replace("/[^A-Z0-9._-]/i", "_", $this->file["name"]);
    }

    public function moveImage($publicImage, $userName)
    {
        $hash = md5($userName.$publicImage);
        $this->fileName = substr($hash, 0, 2) . '/' . substr($hash, 2) . $this->getExtencion();
        if (!file_exists(self::ROOT.substr($hash, 0, 2))) {
            mkdir(self::ROOT.substr($hash, 0, 2), 0644, true);
        }
        move_uploaded_file($this->file["tmp_name"], self::ROOT . $this->fileName);
        chmod(self::ROOT . $this->fileName, 0644);

        return $this->fileName;
    }

    public function sanitizeImage()
    {
        if ($this->verifyFileType()){
            return true;
        }

        return false;
    }

    private function verifyFileType()
    {
        $this->fileType = exif_imagetype($this->file["tmp_name"]);
        $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

        return !in_array($this->fileType, $allowed);
    }

    private function getExtencion()
    {
        $this->fileType = exif_imagetype($this->file["tmp_name"]);
        $extencion = array(IMAGETYPE_GIF => '.gif', IMAGETYPE_JPEG => '.jpeg', IMAGETYPE_PNG => '.png');

        return $extencion[$this->fileType];
    }


    private function verifyIfFileIsInfected()
    {
        $out = ""; $return = "";
        exec("clamscan --stdout ".$this->file["tmp_name"], $out, $return);

        return $return;
    }
}
