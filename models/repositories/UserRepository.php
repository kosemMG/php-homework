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
     * Gets a user by login and password.
     * @param string $login
     * @param string $pass
     * @return object|bool
     */
    public function getUser(string $login, string $pass)
    {
        $table_name = $this->getTableName();
        $sql = "SELECT * FROM `{$table_name}` WHERE `login` = :login AND `password` = :pass";

        return $this->db->queryObject($sql, $this->getEntityClass(), [':login' => $login, ':pass' => $pass]);
    }


    /**
     * Returns a user's id.
     * @param Entity $user
     * @return string
     */
    public function getUserId(Entity $user): string
    {
        return $user->id;
    }


    /**
     * Returns a user's name.
     * @param Entity $user
     * @return string
     */
    public function getUserName(Entity $user): string
    {
        return $user->name;
    }


    /**
     * Returns a user's email.
     * @param Entity $user
     * @return string
     */
    public function getUserEmail(Entity $user): string
    {
        return $user->email;
    }

}
