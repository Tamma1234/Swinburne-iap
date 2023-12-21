<?php

namespace App\Http\Controllers;

use App\Models\Queries;
use Illuminate\Http\Request;
use App\Models\QuerisCommunicate;

class QueryController extends Controller
{
    public function Queries() {
        $queries = Queries::all();
        return view('admin.queries.index', compact('queries'));
    }

    public function Search(Request $request) {
        $queries_type = $request->queries_type;
        $queries_status = $request->queries_status;
        if ($queries_type == "All" && $queries_status == "All") {
            $queries = Queries::all();
            return response()->json($queries);
        } elseif ($queries_type != "All" && $queries_status != "All") {
            $queries = Queries::where('queries_type', $queries_type)->where('querries_status', $queries_status)->get();
            return response()->json($queries);
        } elseif ($queries_type == "All" && $queries_status != "All") {
            $queries = Queries::where('querries_status', $queries_status)->get();
            return response()->json($queries);
        } else {
            $queries = Queries::where('queries_type', $queries_type)->get();
            return response()->json($queries);
        }
    }

    public function detail(Request $request) {
        $id = $request->id;
        $detail = Queries::find($id);
        $query = QuerisCommunicate::where('queries_id', $id)->get();
        return view('admin.queries.detail', compact('detail', 'query', 'id'));
    }
}
