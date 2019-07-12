<?php

namespace App\Http\Controllers\Settings;

use App\Support\Event\Event;
use Illuminate\Http\Request;

class EventController
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

    public function store(Request $request)
    {
        return Event::create($request->all());
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

    public function moduleInstances(Event $event)
    {
        return $event->moduleInstances()->with(['moduleInstanceSettings', 'moduleInstancePermissions'])->get();
    }
}