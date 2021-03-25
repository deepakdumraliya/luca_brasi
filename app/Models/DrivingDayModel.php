<?php



namespace App\Models;

use CodeIgniter\Model;

class DrivingDayModel extends Model
{
    protected $DBGroup = 'default';

    protected $table      = 'driving_day';

    protected $primaryKey = 'day_id';

    protected $returnType     = 'array';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['day_id','user_id','destincation_id','start_kilometer','end_kilometer','car_id ','start_fuel_level','end_fuel_level','start_timestamp','end_timestamp', 'accident_status', 'day_step_status','created','modified'];

    protected $useTimestamps = false;

    protected $createdField  = 'created_at';

    protected $updatedField  = 'updated_at';

    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];

    protected $validationMessages = [];

    protected $skipValidation     = false;

}

?>

