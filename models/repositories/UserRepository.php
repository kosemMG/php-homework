<?php

namespace app\models\repositories;


use app\models\entities\Entity;
use app\models\entities\User;

/**
 * Class UserRepository contains methods for working with the 'users' database table.
 * @package app\models\repositories
 */
class UserRepository extends Repository
{
    /**
     * Returns 'users' - the name of a users table.
     * @return string
     */
    public function getTableName(): string
    {
        return 'users';
    }


    /**
     * Returns the User class name.
     * @return string
     */
    public function getEntityClass(): string
    {
        return User::class;
    }


    /**
     * Returns a user's name by id.
     * @param int $id
     * @return string
     */
    public function getUserName(int $id): string
    {
        return $this->getOne($id)->name;
    }


    /**
     * Returns a user's email by id.
     * @param int $id
     * @return string
     */
    public function getUserEmail(int $id): string
    {
        return $this->getOne($id)->email;
    }

    /**
     * Adds a new user record into a database.
     * @param string $login
     * @param string $password
     * @param string $name
     * @param string $email
     */
    public function signUp(string $login, string $password, string $name, string $email)
    {
        $user = new User();
        $user->login = $login;
        $user->password = $password;
        $user->name = $name;
        $user->email = $email;

        $this->commitChange($user);
    }
}
