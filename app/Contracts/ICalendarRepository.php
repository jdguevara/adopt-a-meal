<?php

namespace App\Contracts;


interface ICalendarRepository
{

    /**
     * Get all events from the desired calendar (open or accepted)
     * @param $eventType Open event or Accepted event
     * @return mixed
     */
    public function all($eventType);

    /**
     * Get a single event from the desired calendar (open or accepted)
     * @param $id google calendar event id
     * @param $eventType Open event or Accepted Event
     * @return mixed
     */
    public function get($id, $eventType);

    /**
     * Delete a single event from the desired calendar (open or accepted)
     * @param $id google calendar event id
     * @param $eventType Open event or Accepted Event
     * @return mixed
     */
    public function delete($id, $eventType);

    /**
     * Updated a single event from the desired calendar (open or accepted)
     * @param $eventType allows for updating on accepted or Open Event
     * @param $eventType Open event or Accepted Event
     * @return mixed
     */
    public function update($eventType, $details);

    /**
     * Create an event of the desired type (open or accepted)
     * @param $event event information
     * @param $eventType Open event or Accepted Event
     * @return mixed
     */
    public function create($event, $eventType);

}