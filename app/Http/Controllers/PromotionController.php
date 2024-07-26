<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Promotions;
use Illuminate\Http\Request;
use function Symfony\Component\String\folded;

class PromotionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $promotions = Promotions::all();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function add() {
        $items = Items::all();
        return view('admin.promotions.add', compact('items'));
    }

    /**
     *
     */
    public function store(Request $request) {
        $code = rand();
        $name = $request->name;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $percent = $request->percent;
        $promotion = new Promotions();
        $item_id = $request->item_id;

        $data =[
            'name' => $name,
            'code' => $code,
            'percent' => $percent,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        $promotion->fill($data);
        $promotion->save();
        $promotion_id = $promotion->id;
        $promo = Promotions::find($promotion_id);
        $promo->item()->attach($item_id);

        return redirect()->route('promotion.index')->with('msg-add', 'Added successful promotion');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request) {
        $items = Items::all();
        $promotion = Promotions::find($request->id);

        return view('admin.promotions.edit', compact('promotion', 'items'));
    }

    /**
     * @param Request $request
     */
    public function update(Request $request) {
        $id = $request->id;
        $promotion = Promotions::find($id);
        $promotion->item()->attach($request->item_id);
        $code = rand();
        $name = $request->name;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $percent = $request->percent;
        $item_id = $request->item_id;

        $data =[
            'name' => $name,
            'code' => $code,
            'percent' => $percent,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
        $promotion->update($data);

        return redirect()->route('promotion.index')->with('msg-add', 'Update Successful Promotion');
    }

    public function itemList() {
        $items = Items::select('name_item')->pluck('name_item')->toArray();
        return response()->json($items);
    }
}
