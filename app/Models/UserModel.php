<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Libraries\MongoDBLibrary;

class UserModel extends Model
{
    protected $database         = 'users';
    protected $collection       = 'credentials';
    protected $primaryKey       = '_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected array $privilages = [
        'view'        => 0b00000001, // 1
        'edit'        => 0b00000010, // 2
        'delete'      => 0b00000100, // 4
        'create'      => 0b00001000, // 8
        'publish'     => 0b00010000, // 16
        'admin'       => 0b00100000, // 32
        'super-admin' => 0b01000000, // 64
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected $mongoDB;

    public function __construct()
    {
        parent::__construct();
        $this->mongoDB = new MongoDBLibrary();
    }

    public function createUser($data)
    {
        // Insert user data into MongoDB
        $result = $this->mongoDB->createDocument($this->database, $this->collection, $data);
        return $result;
    }
    public function updateUser($id, $data)
    {
        // Update user data in MongoDB
        $result = $this->mongoDB->updateDocument($this->database, $this->collection, ['_id' => $id], $data);
        return $result;
    }
    public function deleteUser($id)
    {
        // Delete user data from MongoDB
        $result = $this->mongoDB->deleteDocument($this->database, $this->collection, ['_id' => $id]);
        return $result;
    }
    public function getUser($id)
    {
        // Get user data from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['_id' => $id]);
        return $result;
    }
    public function getAllUsers()
    {
        // Get all user data from MongoDB
        $result = $this->mongoDB->getallDocuments($this->database, $this->collection);
        return $result;
    }
    public function getUserByEmail($email)
    {
        // Get user data by email from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['email' => $email]);
        return $result;
    }
    public function getUserByUsername($username)
    {
        // Get user data by username from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['username' => $username]);
        return $result;
    }
    public function getUserById($id)
    {
        // Get user data by ID from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['_id' => $id]);
        return $result;
    }
    public function getUserByEmailAndPassword($email, $password)
    {
        // Get user data by email and password from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['email' => $email, 'password' => $password]);
        return $result;
    }
    public function getUserByUsernameAndPassword($username, $password)
    {
        // Get user data by username and password from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['username' => $username, 'password' => $password]);
        return $result;
    }
    public function getUserByIdAndPassword($id, $password)
    {
        // Get user data by ID and password from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['_id' => $id, 'password' => $password]);
        return $result;
    }

    public function getUserByEmailOrUsername($email, $username)
    {
        // Get user data by email or username from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['$or' => [['email' => $email], ['username' => $username]]]);
        return $result;
    }
    public function getUserByEmailAndUsername($email, $username)
    {
        // Get user data by email and username from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['$and' => [['email' => $email], ['username' => $username]]]);
        return $result;
    }
    public function getUserByEmailOrUsernameAndPassword($email, $username, $password)
    {
        // Get user data by email or username and password from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['$or' => [['email' => $email], ['username' => $username]], 'password' => $password]);
        return $result;
    }
    public function getUserByEmailAndUsernameAndPassword($email, $username, $password)
    {
        // Get user data by email and username and password from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['$and' => [['email' => $email], ['username' => $username]], 'password' => $password]);
        return $result;
    }
    public function getUserByIdAndEmail($id, $email)
    {
        // Get user data by ID and email from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['$and' => [['_id' => $id], ['email' => $email]]]);
        return $result;
    }
    public function getUserByIdAndUsername($id, $username)
    {
        // Get user data by ID and username from MongoDB
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, ['$and' => [['_id' => $id], ['username' => $username]]]);
        return $result;
    }

    public function deleteMultipleUsers($ids)
    {
        // Delete multiple user data from MongoDB
        $result = $this->mongoDB->deleteDocuments($this->database, $this->collection, ['_id' => ['$in' => $ids]]);
        return $result;
    }
    public function updateMultipleUsers($ids, $data)
    {
        // Update multiple user data in MongoDB
        $result = $this->mongoDB->updateDocuments($this->database, $this->collection, ['_id' => ['$in' => $ids]], $data);
        return $result;
    }
    public function getAllUsersWithPagination($page, $limit)
    {
        // Get all user data from MongoDB with pagination
        $result = $this->mongoDB->findDocuments($this->database, $this->collection, [], ['skip' => ($page - 1) * $limit, 'limit' => $limit]);
        return $result;
    }
    public function getUserCount()
    {
        // Get user count from MongoDB
        $result = $this->mongoDB->countDocuments($this->database, $this->collection);
        return $result;
    }

    public function setaAccountPermissions ($userId, $role) {
        
        switch ($role) {

            case 'admin':
                $permissions = $this->privilages['admin'];
                break;

            case 'super-admin':
                $permissions = $this->privilages['super-admin'];
                break;

            case 'editor':
                $permissions = array(
                    $this->privilages['edit'], 
                    $this->privilages['view'], 
                    $this->privilages['create'], 
                    $this->privilages['delete']);
                break;	

            case 'publisher':
                $permissions = array($this->privilages['publish'], 
                    $this->privilages['view'], 
                    $this->privilages['create'], 
                    $this->privilages['edit'], 
                    $this->privilages['delete']);
                break;

            case 'reader':
                $permissions = $this->privilages['view'];
                break;

            default:
                $permissions = 0;
        }

        $result = $this->mongoDB->updateDocument($this->database, $this->collection, ['_id' => $userId], ['permissions' => $permissions]);
        return $result;
    }

    public function getAccountPermissions ($userId) {

        $result = $this->mongoDB->getSpecificDetailInDocument($this->database, $this->collection, ['_id' => $userId], 'permissions');
        if (isset($result[0]['permissions'])) {
            $permissions = $result[0]['permissions'];
        } else {
            $permissions = null;
        }
        return $permissions;
    }
}
