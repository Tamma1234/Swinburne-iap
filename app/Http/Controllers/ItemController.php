<?php

namespace App\Http\Controllers;

use App\Models\GalleryProduct;
use App\Models\ItemCategories;
use App\Models\ItemGallery;
use App\Models\Items;
use App\Models\Sizes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class ItemController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function itemList()
    {
        $items = Items::all();
        return view('admin.items.index', compact('items'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $cates = ItemCategories::all();
        $sizes = Sizes::all();
        return view('admin.items.create', compact('cates', 'sizes'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $sizes = $request->size;

        if ($request->hasFile('image_url')) {

          $fileName = $request->file('image_url')->store("", "google");
          dd($fileName);
        }
        dd(21321312);
        $item = Items::create([
            'name_item' => $request->name_item,
            'description' => $request->description,
            'images' => $originalFileName,
            'gold' => $request->gold,
            'cate_id' => $request->cate_id,
            'status' => $request->status,
            'quantity' => $request->quantity
        ]);

        $item_id = $item->id;
        if ($sizes != null) {
            $item = Items::find($item_id);
            $item->size()->attach($sizes);
        }
        if ($request->hasFile('gallery')) {
            $files = $data['gallery'];
            foreach ($files as $file) {
                $originalFileName = $file->getClientOriginalName();
                Storage::disk("google")->putFileAs("12wqHv5uY9uvDMyhQQKqUmis591e-Uws3",$file, $originalFileName);

                ItemGallery::create([
                    'item_id' => $item_id,
                    'file_name' => $originalFileName
                ]);
            }
        }

        return redirect()->route('items.list')->with('msg-add', 'Create Items Successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request)
    {
        $item = Items::find($request->id);
        $sizes = Sizes::all();
        $cates = ItemCategories::all();
        return view('admin.items.edit', compact('item', 'sizes', 'cates'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $id = $request->id;
        $item = Items::find($id);
        $size = $request->size;
        $itemSize = $item->size;
        $data = $request->all();
        $image_path = public_path("item_images/$item->images");
        File::delete($image_path);
        if(count($itemSize) > 0) {
            $item->size()->detach($itemSize);
        }
        if ($request->hasFile('images')) {
            $originalFileName = $request->images->getClientOriginalName();
            $data['images'] = $request->file('images')->move('item_images', $originalFileName);
        }
        $item->fill($data);
        $item->save();
        $item->size()->attach($size);

        if ($request->hasFile('gallery')) {
            $files = $data['gallery'];
            $gallery = $item->showGallery;
            ItemGallery::destroy($gallery);
            foreach ($files as $file) {
                $originalFileName = $file->getClientOriginalName();
                $fileNameGallery = uniqid() . '_' . str_replace(' ', '_', $originalFileName);
                $fileGllery = $file->move('item_gallery', $fileNameGallery);
                ItemGallery::create([
                    'item_id' => $id,
                    'file_name' => $fileNameGallery
                ]);
            }
        }

        return redirect()->route('items.list')->with('msg-add', 'Update Items Successfully');
    }

    public function delete(Request $request) {
        $id = $request->id;
        $item = Items::find($id);
        $file = public_path("item_images/{$item->images}");
        File::delete($file);
        $item->delete();

        return redirect()->route('items.list')->with('msg-add', 'Delete Items Successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category()
    {
        $categories = ItemCategories::all();
        return view('admin.items.list-category', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createCategory()
    {
        return view('admin.items.create-cate');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCategory(Request $request)
    {
        ItemCategories::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('items.category')->with('msg-add', 'Create Categories Successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editCategory(Request $request)
    {
        $id = $request->id;
        $cate = ItemCategories::find($id);
        return view('admin.items.edit-cate', compact('cate'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCategory(Request $request)
    {
        $cate = ItemCategories::find($request->id);
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->save();

        return redirect()->route('items.category')->with('msg-add', 'Update Categories Successfully');
    }

    public function deleteCategory(Request $request)
    {
        $cate = ItemCategories::find($request->id);
        $cate->delete();

        return redirect()->route('items.category')->with('msg-delete', 'Delete Categories Successfully');
    }
}
