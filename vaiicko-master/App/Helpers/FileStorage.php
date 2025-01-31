<?php

namespace App\Helpers;

use App\Core\HTTPException;

class FileStorage
{
    // Dir, where to store file
    const UPLOAD_DIR = "public" . DIRECTORY_SEPARATOR ."uploads";

    /**
     * Uploads file to given directory and returns new filename
     * @param array $fileData
     * @return string New unique filename
     * @throws HTTPException Throw exception if file move was unsuccessful
     */
    public static function saveFile($fileData) : string {
        // generating prefix
        $filePrefix = hrtime(true);
        // build storing file path
        $filePath = FileStorage::UPLOAD_DIR . DIRECTORY_SEPARATOR . $filePrefix . "-" .$fileData['name'];
        error_log("Trying to save file: " . $filePath);
        error_log("Temporary file path: " . $fileData['tmp_name']);
        // do the move
        if (move_uploaded_file($fileData['tmp_name'], $filePath)) {
            error_log("File successfully saved: " . $filePath);
            return $filePrefix . "-" .$fileData['name'];
        } else {
            error_log("File upload failed.");
            throw new HTTPException(503, 'File upload failed. Did you create upload directory?');
        }
    }

    /**
     * Deletes file from file storage
     * @param string $filename
     * @return void
     */
    public static function deleteFile(string $filename)
    {
        unlink(FileStorage::UPLOAD_DIR . DIRECTORY_SEPARATOR . $filename);
    }
}