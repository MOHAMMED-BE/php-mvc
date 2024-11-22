<?php

class UploadHelper
{
    private $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private $uploadDir;

    public function __construct($uploadDir = __DIR__ . '/../uploads/')
    {
        $this->uploadDir = $uploadDir;

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function upload($file, $path)
    {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            if (!in_array($fileExtension, $this->allowedExtensions)) {
                throw new Exception("Upload failed. Allowed file types: " . implode(", ", $this->allowedExtensions));
            }

            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $this->uploadDir . $path . '/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                return $newFileName;
            } else {
                throw new Exception("Failed to move uploaded file.");
            }
        } else {
            throw new Exception("No file uploaded or there was an error uploading the file.");
        }
    }

    public function delete($fileName, $path)
    {
        $filePath = $this->uploadDir . $path . '/' . $fileName;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
