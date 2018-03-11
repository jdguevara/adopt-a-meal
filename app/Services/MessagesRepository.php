<?php


namespace App\Services;

use App\Contracts\IMessagesRepository;
use App\Message;
use App\MessageType;
use Illuminate\Support\Facades\DB;

class MessagesRepository implements IMessagesRepository
{

    private $message;
    private $messageType;

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
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->message->find($id);
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
        return $this->message->id;
    }

    /**
     * Update an existing message
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