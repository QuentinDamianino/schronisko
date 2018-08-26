<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 26.08.2018
 * Time: 18:08
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid() . '.' . $file->guessExtension());

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}