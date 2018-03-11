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

    public function __construct(Message $m, MessageType $mt)
    {
        $this->message = $m;
        $this->messageType = $mt;
    }

    /**
     * Get all messages
     * @return mixed
     */
    public function all()
    {
        // come up with a list of all message types
        $messageTypes = $this->messageType->all();

        // find the newest message for each type and store it for result
        $result = [];
        forEach($messageTypes as $messageType) {

            $message = DB::table('messages')
                ->join('message_types', 'messages.type_id', '=', 'message_types.id')
                ->select('messages.*', 'message_types.type')
                ->where('messages.type_id', $messageType->id)
                ->orderBy('messages.version', 'DESC')
                ->take(1)
                ->get();

            if(count($message) > 0) {
                array_push($result, $message[0]);
            }

        }

        return $result;
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
            'type_id' => $input['type_id'],
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