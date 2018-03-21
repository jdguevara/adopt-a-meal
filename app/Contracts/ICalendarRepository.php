<?php

namespace App\Contracts;


interface ICalendarRepository
{
    /**
     * Get all events from the open events calendar
     * @param $eventType Open event or Accepted event
     * @return mixed
     */
    public function getVolunteerEvents();

    /**
     * Get all events from the confirmed events calendar
     * @param $eventType Open event or Accepted event
     * @return mixed
     */
    public function getConfirmedEvents();

    /**
     * Get all events from the desired calendar (open or accepted)
     * @param $eventType Open event or Accepted event
     * @return mixed
     */
    public function createConfirmedVolunteerEvent($event);

    /**
     * Get all events from the desired calendar (open or accepted)
     * @param $eventType Open event or Accepted event
     * @return mixed
     */
    public function updateVolunteerEvent($details);

    /**
     * Get all events from the desired calendar (open or accepted)
     * @param $eventType Open event or Accepted event
     * @return mixed
     */
    public function cancelVolunteerEvent($event);

    /**
     * Get all events from the desired calendar (open or accepted)
     * @param $eventType Open event or Accepted event
     * @return mixed
     */
    public function deleteOpenEvent($id);
}