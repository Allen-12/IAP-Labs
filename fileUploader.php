<?php

class FileUploader
{
    private static $targetDirectory = "uploads/";
    private static $sizeLimit = 50000;
    private $uploadOk = false;
    private $fileOriginalName;
    private $fileTemp;
    private $fileType;
    private $fileSize;
    private $finalFileName;

    /**
     * FileUploader constructor.
     * @param $fileOriginalName
     * @param $fileTemp
     * @param $fileSize
     * @param $fileType
     */
    public function __construct($fileOriginalName,$fileTemp,$fileSize,$fileType)
    {
        $this->fileOriginalName = $fileOriginalName;
        $this->fileSize = $fileSize;
        $this->fileType = $fileType;
        $this->fileTemp = $fileTemp;
    }

    /**
     * @return string
     */
    public static function getTargetDirectory()
    {
        return self::$targetDirectory;
    }

    /**
     * @return mixed
     */
    public function getFileOriginalName()
    {
        return $this->fileOriginalName;
    }

    /**
     * @param mixed $fileOriginalName
     */
    public function setFileOriginalName($fileOriginalName)
    {
        $this->fileOriginalName = $fileOriginalName;
    }

    /**
     * @return mixed
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * @param mixed $fileType
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return mixed
     */
    public function getFinalFileName()
    {
        return $this->finalFileName;
    }

    /**
     * @param mixed $finalFileName
     */
    public function setFinalFileName($finalFileName)
    {
        $this->finalFileName = $finalFileName;
    }

    public function uploadFile()
    {
        $errors = array();
        $imageTypes = array('image/jpg','image/jpeg','image/png','image/gif');
        $targetImagePath = self::$targetDirectory.$this->fileOriginalName;

        if ($this->fileSize > self::$sizeLimit)
        {
            $errors[] = "Your file is too large! It should not be larger than 50KB";
        }

        if (!in_array($this->fileType,$imageTypes))
        {
            $errors[] = "Invalid File Type. File should be an image.";
        }

        if(empty($errors))
        {
            move_uploaded_file($this->fileTemp,$targetImagePath);
            return true;
        }
        else
        {
            print_r($errors);
            return false;
        }
    }
}