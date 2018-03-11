<?php

namespace App\Contracts;

interface IMessagesRepository
{

    /**
     * Get all messages
     * @return mixed
     */
    public function all();

    /**
     * Get all versions of a message corresponding to the message's type
     * @param $type
     * @return mixed
     */
    public function get($type);

    /**
     * Add a new message, making it the newest version for its type
     * @param $input
     * @return mixed
     */
    public function create($input);

    /**
     * Update an existing message (this will probably never be used as the messages are versioned)
     * @param $input
     * @return mixed
     * @internal param $form
     */
    public function update($input);

    /**
     * Remove a specific message, making the previous version the current one being used
     * @param $id
     * @return mixed
     */
    public function delete($id);

}