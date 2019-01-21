<?php

namespace app\models\repositories;



use app\models\entities\Feedback;

/**
 * Class FeedbackRepository contains methods for working with the 'feebacks' database table.
 * @package app\models\repositories
 */
class FeedbackRepository extends Repository
{
    /**
     * Returns 'feedbacks' - the name of a feedbacks table.
     * @return string
     */
    public function getTableName(): string
    {
        return 'feedbacks';
    }

    /**
     * Returns the Feedback class name.
     * @return string
     */
    public function getEntityClass(): string
    {
        return Feedback::class;
    }
}