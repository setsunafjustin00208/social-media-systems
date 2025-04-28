<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Libraries\MongoDBLibrary;

class UserCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'App';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'user:manage';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Manage users in the MongoDB database (Create, Update, Delete, Login).';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'user:manage [create|update|delete|login]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'command' => 'The action to perform: create, update, delete, or login.',
    ];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */

     /** Userdata */
     private $collection = 'credentials';
     private $database = 'users';

    /**
     * Execute the command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        if (empty($params)) {
            CLI::write('No command provided. Use create, update, delete, or login.', 'red');
            return;
        }
    
        $command = strtolower($params[0]);
        $mongoDB = new MongoDBLibrary();
    
        switch ($command) {
            case 'create':
                $username = CLI::prompt('Enter username', null, 'required');
                $email = CLI::prompt('Enter email', null, 'required');
                $password = CLI::prompt('Enter password', null, 'required');
                $roles = CLI::prompt('Enter privilage type (reader, editor, publisher, admin, super-admin)', null, 'required');
    
                $result = $mongoDB->createDocument($this->database, $this->collection, [
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'role' => $roles, // Default privileges
                ]);
    
                if ($result) {
                    CLI::write('User created successfully.', 'green');
                } else {
                    CLI::write('Failed to create user.', 'red');
                }
                break;
    
            case 'update':
                $userId = CLI::prompt('Enter user ID to update', null, 'required');
                $updateData = [];
    
                $username = CLI::prompt('Enter new username (leave blank to skip)');
                if (!empty($username)) {
                    $updateData['username'] = $username;
                }
    
                $email = CLI::prompt('Enter new email (leave blank to skip)');
                if (!empty($email)) {
                    $updateData['email'] = $email;
                }
    
                $password = CLI::prompt('Enter new password (leave blank to skip)', null, 'hidden');
                if (!empty($password)) {
                    $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
                }
    
                if (empty($updateData)) {
                    CLI::write('No updates provided.', 'yellow');
                    return;
                }
    
                $result = $mongoDB->updateDocument($this->database, $this->collection, ['_id' => new \MongoDB\BSON\ObjectId($userId)], $updateData);
    
                if ($result) {
                    CLI::write('User updated successfully.', 'green');
                } else {
                    CLI::write('Failed to update user.', 'red');
                }
                break;
    
            case 'delete':
                $userId = CLI::prompt('Enter user ID to delete', null, 'required');
    
                $result = $mongoDB->deleteDocument($this->database, $this->collection, ['_id' => new \MongoDB\BSON\ObjectId($userId)]);
    
                if ($result) {
                    CLI::write('User deleted successfully.', 'green');
                } else {
                    CLI::write('Failed to delete user.', 'red');
                }
                break;
    
            case 'login':
                $username = CLI::prompt('Enter username', null, 'required');
                $password = CLI::prompt('Enter password', null, 'required', 'hidden');
    
                $user = $mongoDB->findDocument($this->database, $this->collection, ['username' => $username]);
    
                if ($user && password_verify($password, $user['password'])) {
                    CLI::write('Login successful. Welcome, ' . $user['username'] . '!', 'green');
                } else {
                    CLI::write('Invalid username or password.', 'red');
                }
                break;
            default:
                CLI::write('Invalid command. Use create, update, delete, or list.', 'red');
                break;
        }
    }
}