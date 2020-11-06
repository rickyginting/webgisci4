<?php
namespace app\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password'];
    protected $useTimestamps = true;

}
