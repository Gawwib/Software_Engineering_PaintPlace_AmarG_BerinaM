<?php
class UserService
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    // Get all users
    public function getAllUsers()
    {
        return $this->userDao->getAllUsers();
    }

    // Create a new user
    public function addUser($data)
    {
        if (isset($data['password'])) {
            // Hash the password before saving
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->userDao->addUser($data);
    }

    // Update user role
    public function updateUserRole($userId, $role)
    {
        return $this->userDao->updateUserRole($userId, $role);
    }

    // Delete user role
    public function deleteUser($userId)
    {
        return $this->userDao->deleteUser($userId);
    }

     // get user by email
     public function getUserByEmail($email)
     {
         return $this->userDao->getUserByEmail($email);
     }

      // get user by id
      public function getUserById($userId)
      {
          return $this->userDao->getUserById($userId);
      }
}
