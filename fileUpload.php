<?php

namespace Classes;

class fileUpload
{
    public $fileName;
    private $baseFile;
    private $directory;
    private $fileExtension;
    public $response = array();

    public function __construct($file_post, $dir)
    {
        $today = date('Y-m-d H:i:s');
        $this->baseFile = $file_post;
        $this->directory = $dir;
        $this->fileName = uniqid() . "-" . time() . basename($file_post['name']);
        $this->fileExtension = strtolower(pathinfo($this->fileName, PATHINFO_EXTENSION));
    }


    private function _validate()
    {
        $check = true;
        $attrib = getimagesize($this->baseFile['tmp_name']);
        if (!$attrib) {
            array_push($this->response, ['error' => 'File is not an image']);
            $check = false;
        }

        if ($this->fileExtension != 'jpg' && $this->fileExtension != 'png' && $this->fileExtension != 'jpeg' && $this->fileExtension != 'pdf') {
            array_push($this->response, ['error' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
            $check = false;
        }

        return $check;
    }

    public function upload()
    {
        $today = date('Y-m-d H:i:s');
        if (
            $this->_validate() && move_uploaded_file(
                $this->baseFile
                ['tmp_name'],
                $this->directory . $this->fileName
            )
        ) {
            $this->response = array('success' => 'Uploaded');
            return true;
        }
        $this->response = array('error' => 'File not uploaded, image file is too large');
        return false;
    }
}