<?php


namespace App\Services;

use App\Contracts\IMessagesRepository;
use App\Message;

class MessagesRepository implements IMessagesRepository
{

    private $message;

    public function __construct(Message $m)
    {
        $this->message = $m;
    }

    /**
     * Get all messages
     * @return mixed
     */
    public function all()
    {
        return $this->message->all();
    }

    /**
     * Get all versions of a message corresponding to the message's type
     * @param $type
     * @return mixed
     */
    public function get($type)
    {
        return $this->message->where('type', $type);
    }

    /**
     * Add a new message, making it the newest version for its type
     * @param $input
     * @return mixed
     */
    public function create($input)
    {
        $this->message->fill([
            'type' => $input['type'],
            'content' => $input['content'],
            'user_id' => $input['user_id']
        ]);
        $this->message->save();

        // We will need to get the auto-generated ID and Version number for this message, so send back all of it.
        return $this->message;
    }

    /**
     * Update an existing message (this will probably never be used as the messages are versioned)
     * @param $input
     * @return mixed
     * @internal param $form
     */
    public function update($input)
    {
        $this->message
            ->find($input['id'])
            ->update(
                ['content' => $input['content'],
                 ['user_id' => $input['user_id']]
            ]);
    }

    /**
     * Remove a specific message, making the previous version the current one being used
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->message->find($id)->delete();
    }
}