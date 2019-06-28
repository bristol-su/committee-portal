<?php


namespace App\Http\Controllers\Settings;


use App\Support\Event\Event;

class EventSettingsController
{

    public function index()
    {
        return view('admin.settings.events.index')->with([
            'events' => Event::all()
        ]);
    }

    public function create()
    {
        return view('admin.settings.events.create');
    }

    public function store()
    {

    }

    public function show(Event $event)
    {
        return view('admin.settings.events.show')->with(['event' => $event]);
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}