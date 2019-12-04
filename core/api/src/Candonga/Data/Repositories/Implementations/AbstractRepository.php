<?php

namespace App\Data\Repositories\Implementations;

use Candonga\Data\Entities\AbstractEntity;
use App\Data\Repositories\Contracts\AbstractRepository as RepositoryInterface;
use Candonga\Events\Event;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @param array $data
     * @param bool|true $fireEvent
     * @return null
     */
    public function add(array $data, $fireEvent = false)
    {
        if( ! $newEntity = $this->getEntity()->create($data) )
            return null;

        if($fireEvent)
        {
            $eventName = $this->resolveEventName('AddedEvent');
            $this->fire(new $eventName($newEntity));
        }

        return $newEntity;
    }

    /**
     * @return mixed
     */
    function all()
    {
        return $this->getEntity()->all();
    }

    /**
     * @param array $data
     * @param bool|true $fireEvent
     * @return null
     */
    public function delete(array $data, $fireEvent = false)
    {
        $deleteEntity = $this->find($data['id']);

        if( ! $deleteEntity )
            return null;

        if(! $deleteEntity->delete())
            return 'Sorry, we could not delete the the record from the database.';

        if($fireEvent)
        {
            $eventName = $this->resolveEventName('DeletedEvent');
            $this->fire(new $eventName($deleteEntity));
        }

        return $deleteEntity;
    }

    /**
     * @param array $data
     * @return null
     */
    public function deleteIn(array $data)
    {
        $this->getEntity()->whereIn('id', $data['ids'])->delete();
    }

    /**
     * @param array $where
     * @return null
     */
    public function deleteWhere(array $where)
    {
        $entity = $this->getEntity();

        foreach($where as $field => $value)
        {
            if( ! is_array($value))
                $value = array($value);

            foreach($value as $val)
                $entity = $entity->where($field, $val);
        }

        return $entity->delete();
    }

    /**
     * @param array $data
     * @param bool|true $fireEvent
     * @return null
     */
    public function edit(array $data, $fireEvent = false)
    {
        $editedEntity = $this->find($data['id']);

        if( ! $editedEntity )
            return null;

        $editedEntity->fill($data);

        if(! $editedEntity->save())
            return 'Sorry, we could not save the data into the database.';

        if($fireEvent)
        {
            $eventName = $this->resolveEventName('EditedEvent');
            $this->fire(new $eventName($editedEntity));
        }

        return $editedEntity;
    }

    /**
     * @param array $search
     * @param array $data
     * @param bool|true $fireEvent
     * @return mixed|string
     */
    public function editOrCreate(array $search, array $data, $fireEvent = false)
    {
        $where = [];

        foreach($search as $column)
            $where[$column] = $data[$column];

        $entity = $this->getFirstByFields($where);

        $eventAppend = 'EditedEvent';

        if(empty($entity))
        {
            $eventAppend = 'AddedEvent';
            $entity = $this->getEntity();
        }

        $entity->fill($data);

        if(! $entity->save())
            return 'Sorry, we could not save the data into the database.';

        if($fireEvent)
        {
            $eventName = $this->resolveEventName($eventAppend);
            $this->fire(new $eventName($entity));
        }

        return $entity;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->getEntity()->find($id);
    }

    /**
     * @param array $ids
     * @param bool|false $orderBy
     * @param bool|false $take
     * @return mixed
     */
    public function findIn(array $ids, $orderBy = false, $take = false)
    {
        $entity = $this->getEntity();

        $entity = $entity->whereIn("id", $ids);

        if($orderBy)
            $entity = $entity->orderBy($orderBy[0], $orderBy[1]);

        if($take)
            $entity = $entity->take($take);

        return $entity->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrNew($id)
    {
        return $this->getEntity()->findOrNew($id);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function first($where)
    {
        return $this->getEntity()->where($where)->first();
    }

    /**
     * @param $where
     * @return mixed
     */
    public function firstOrNew($where)
    {
        return $this->getEntity()->firstOrNew($where);
    }

    /**
     * @param array $values
     * @param bool|false $orderBy
     * @param bool|false $take
     * @return mixed
     */
    public function getByFields(array $values, $orderBy = false, $take = false)
    {
        $entity = $this->getEntity();

        foreach($values as $field => $value)
        {
            if( ! is_array($value))
                $value = array($value);

            foreach($value as $val)
                $entity = $entity->where($field, $val);
        }

        if($orderBy)
            $this->addOrderByToEntity($entity, $orderBy);

        if($take)
            $entity = $entity->take($take);

        return $entity->get();
    }

    /**
     * @param array $values
     * @param bool|false $orderBy
     * @param bool|false $take
     * @return mixed
     */
    public function getByFieldsIn(array $values, $orderBy = false, $take = false)
    {
        $entity = $this->getEntity();

        foreach($values as $field => $value)
        {
            if( ! is_array($value))
                $value = array($value);

            $entity = $entity->whereIn($field, $value);
        }

        if($orderBy)
            $entity = $entity->orderBy($orderBy[0], $orderBy[1]);

        if($take)
            $entity = $entity->take($take);

        return $entity->get();
    }

    /**
     * @param array $values
     * @param bool|false $orderBy
     * @return mixed
     */
    public function getFirstByFields(array $values, $orderBy = false)
    {
        return $this->getByFields($values, $orderBy)->first();
    }

    /**
     * Get the Repository Entity
     *
     * @return mixed
     */
    abstract function getEntity();

    /**
     * @param string $whereRaw
     * @param bool|false $orderBy
     * @param bool|false $take
     * @return mixed
     */
    public function getWhereRaw($whereRaw, $orderBy = false, $take = false)
    {
        $entity = $this->getEntity()->whereRaw($whereRaw);

        if($orderBy)
            $entity = $entity->orderBy($orderBy[0], $orderBy[1]);

        if($take)
            $entity = $entity->take($take);

        return $entity->get();
    }

    /**
     * Fire an event
     *
     * @param Event $event
     * @return void
     */
    public function fire(Event $event)
    {
        $dispatcher = app()->make('events');

        $dispatcher->fire($event);
    }

    /**
     * Get a paginated entity data
     *
     * @return mixed
     */
    public function paginate()
    {
        return $this->getEntity()->paginate();
    }

    /**
     * Set the Repository Entity
     *
     * @param $entity
     * @return mixed
     */
    abstract function setEntity(AbstractEntity $entity);

    #region Helpers

    private function addOrderByToEntity($entity, $value)
    {
        if( ! is_array($value[0]) )
            $value[0] = array($value[0]);

        if( ! is_array($value[1]) )
            $value[1] = array($value[1]);

        foreach ($value[0] as $index => $field) {
            $entity->orderBy($field, $value[1][ $index ]);
        }
    }

    /**
     * @param $append
     * @return string
     */
    protected function resolveEventName($append)
    {
        $reflection = new \ReflectionClass( $this->getEntity() );
        $entityName = $reflection->getShortName();
        $entityPlural = str_plural($entityName);

        return "App\\Events\\".$entityPlural."\\".$entityName.$append;
    }

    /**
     * @param $ent
     * @return mixed
     */
    public function resolveEntityFromVariable($ent)
    {
        $entity = $ent;

        if(! $entity)
            throw new \InvalidArgumentException('Sorry, to resolve an entity we need a valid entity data.');
        else
        {
            if(is_integer($entity) || is_string($entity))
                $entity = $this->find($entity);

            $entityType = get_class($this->getEntity());

            if(! $entity instanceof $entityType)
                throw new \InvalidArgumentException('Sorry, to resolve an entity we need a valid entity data.');
        }

        return $entity;
    }

    #endregion


}