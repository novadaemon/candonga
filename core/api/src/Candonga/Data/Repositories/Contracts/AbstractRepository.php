<?php

namespace App\Data\Repositories\Contracts;

use Candonga\Data\Entities\AbstractEntity;
use Candonga\Events\Event;

interface AbstractRepository
{
    /**
     * @param array $data
     * @param bool $fireEvent
     * @return mixed
     */
    function add(array $data, $fireEvent = false);

    /**
     * @return mixed
     */
    function all();

    /**
     * @param array $data
     * @param bool|false $fireEvent
     * @return mixed
     */
    function delete(array $data, $fireEvent = false);

    /**
     * @param array $data
     * @return mixed
     */
    function deleteIn(array $data);

    /**
     * @param array $where
     * @return mixed
     */
    function deleteWhere(array $where);

    /**
     * @param array $data
     * @param bool|false $fireEvent
     * @return mixed
     */
    function edit(array $data, $fireEvent = false);

    /**
     * @param array $search
     * @param array $data
     * @param bool|true $fireEvent
     * @return mixed
     */
    function editOrCreate(array $search, array $data, $fireEvent = false);

    /**
     * @param $id
     * @return mixed
     */
    function find($id);

    /**
     * @param array $ids
     * @param bool $orderBy
     * @param bool $take
     * @return mixed
     */
    function findIn(array $ids, $orderBy = false, $take = false);

    /**
     * @param $id
     * @return mixed
     */
    function findOrNew($id);

    /**
     * @param $where
     * @return mixed
     */
    function first($where);

    /**
     * @param $where
     * @return mixed
     */
    function firstOrNew($where);

    /**
     * @param array $values
     * @param bool $orderBy
     * @param bool $take
     * @return mixed
     */
    function getByFields(array $values, $orderBy = false, $take = false);

    /**
     * @param array $values
     * @param bool $orderBy
     * @param bool $take
     * @return mixed
     */
    function getByFieldsIn(array $values, $orderBy = false, $take = false);

    /**
     * @param array $value
     * @param bool|false $orderBy
     * @return mixed
     */
    function getFirstByFields(array $value, $orderBy = false);

    /**
     * @return AbstractEntity
     */
    function getEntity();

    /**
     * @param Event $event
     * @return mixed
     */
    function fire(Event $event);

    /**
     * @return mixed
     */
    function paginate();

    /**
     * @param $entityData
     * @return mixed
     */
    function resolveEntityFromVariable($entityData);

    /**
     * @param AbstractEntity $entity
     * @return mixed
     */
    function setEntity(AbstractEntity $entity);

    /**
     * @param string $whereRaw
     * @param bool|false $orderBy
     * @param bool|false $take
     * @return mixed
     */
    function getWhereRaw($whereRaw, $orderBy = false, $take = false);
}