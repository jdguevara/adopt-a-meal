<?php


namespace App\Repositories;

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
        return $this->message->orderBy('type')->get();
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
     * Get a single message by its type
     * @param $type
     * @return mixed
     */
    public function getByType($type)
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

    /**
     * Get all messages by 'type' => 'content' (this is for views)
     * @return mixed
     */
    public function allContent()
    {
        // get all messages
        $messages = $this->message->all();
        $result = [];

        // store
        forEach($messages as $message) {
            $result[$message->type] = $message->content;
        }
        return $result;
    }
}