<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function index()
    {
        $columns = Column::all()->toArray();
        return array_reverse($columns);
    }

    public function store(Request $request)
    {
        $column = new Column([
            'name' => $request->input('name'),
            'detail' => $request->input('detail')
        ]);
        $column->save();

        return response()->json('Column created!');
    }

    public function show($id)
    {
        $column = Column::find($id);
        return response()->json($column);
    }

    public function update($id, Request $request)
    {
        $column = Column::find($id);
        $column->update($request->all());

        return response()->json('Column updated!');
    }

    public function destroy($id)
    {
        $column = Column::find($id);
        $column->delete();

        return response()->json('Column deleted!');
    }
}
