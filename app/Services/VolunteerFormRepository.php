<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 1/23/18
 * Time: 7:29 PM
 */

namespace App\Http\Services;

use App\VolunteerForm as Form;

class VolunteerFormRepository implements IVolunteerFormRepository
{

    private $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function all()
    {
        $this->form->all();
    }

    public function get($id)
    {
        $this->form->findOrFail($id);
    }

    public function create($input)
    {
        // TODO: Implement create() method.
    }

    public function update($input)
    {
        // TODO: Implement update() method.
    }

    public function delete($input)
    {
        // TODO: Implement delete() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }
}