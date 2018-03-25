<?php

namespace App\Contracts;


interface ICalendarService
{
    /**
     * Updates calendar event with event properties
     * @param $event Object properties to updated
     * @param $calendarId calendar to be updated
     * @return calendar event
     */
    public function update($calendarId, $event);

    /**
     * Creates calendar event with event properties
     * @param $event Object properties to be created
     * @param $calendarId calendar to be updated
     * @return calendar event
     */
    public function create($calendarId, $event);

    /**
     * Changes event status calendar event with event properties
     * @param $eventId event whose status needs to be changed
     * @param $calendarId calendar to be updated
     * @param $status status to chenge event to
     * @return calendar event
     */
    public function patch($calendarId, $eventId, $status);
}