<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Institution
 */
class Institution extends Model
{    
    /**
     * filePath
     *
     * @var mixed
     */
    protected $filePath;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->filePath = storage_path('json/instituicoes.json');;
    }
    
    /**
     * getAll - return all institutions
     *
     * @return array|false
     */
    public function getAll()
    {
        if ($this->validateFile()) {
            return json_decode(file_get_contents($this->filePath), true);
        }

        return false;
    }
    
    /**
     * validateFile
     *
     * @return void
     */
    private function validateFile()
    {
        if (!file_exists($this->filePath)) {
            return false;
        }

        return true;
    }
}
