<?php
namespace App\Models;
use CodeIgniter\Model;

class StationModel extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'destinations';
    protected $primaryKey = 'destination_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['destination_id','name','created','modified'];

    protected $useTimestamps = false;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    
    
}
?>