<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\DestroyRequest;
use App\Http\Requests\Todo\ShowRequest;
use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Grab page length otherwise use default
        $pageLength = $request->get('page_length') ?: 15;

        return Todo::owned($request->user()->getKey())
                   ->paginate($pageLength);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return TodoResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // Get only data described in request validation
        $data = $request->validated();

        $created = $request->user()
                           ->todos()
                           ->create($data);

        if(!empty($created)) {
            return new TodoResource($created);
        }

        return response("Une    xpected Server Error Occurred.", 500);
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param \App\Models\Todo $todo
     * @return TodoResource
     */
    public function show(ShowRequest $request, Todo $todo)
    {
        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param \App\Models\Todo $todo
     * @return TodoResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Todo $todo)
    {
        // Get only data described in request validation
        $data = $request->validated();

        $updated = $todo->update($data);

        // Return updated model if success
        if (!empty($updated)) {
            return new TodoResource($todo->fresh());
        }

        return response("Unexpected Server Error Occurred.", 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DestroyRequest $request, Todo $todo)
    {
        return response()->json([
            'success' => !!$todo->delete()
        ]);
    }
}
