<?php
interface IModel
{
    public function getOne(int $id): Model;

    public function getAll(): array ;

    public function getTableName(): string ;
}