<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class File
{
    /**
     * Delete file from server.
     *
     * @param string $path
     * @return void
     */
    public static function delete(string $path): void
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
