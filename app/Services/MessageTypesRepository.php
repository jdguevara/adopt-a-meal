<?php

use App\Contracts\IMessageTypesRepository;

/**
 * Created by PhpStorm.
 * User: zacharymikel
 * Date: 3/11/18
 * Time: 1:12 AM
 */


class MessageTypesRepository implements IMessageTypesRepository {

    private $messageType;

    public function __construct(MessageType $type)
    {
        $this->messageType = $type;
    }

    public function all()
    {
        return $this->messageType->all();
    }

    public function get($id)
    {
        return $this->messageType->find($id);
    }
}