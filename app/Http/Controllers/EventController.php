<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class EventController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return Event::with('user')->get();
    }

    public function show($id)
    {
        return Event::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($event, 201);
    }

        public function update(Request $request, $id)
        {
            $event = Event::findOrFail($id);

            $this->authorize('update', $event);

            $validated = $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $event->update($validated);

            return response()->json($event);
        }


    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $this->authorize('delete', $event);

        $event->delete();

        return response()->json(['message' => 'Evento eliminado']);
    }
}
