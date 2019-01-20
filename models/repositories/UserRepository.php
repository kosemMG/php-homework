<?php

namespace app\models\repositories;


use app\models\User;

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
}