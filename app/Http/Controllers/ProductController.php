<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $product = Product::all()->where('status','public');
        foreach($product as $p) {
            $p['category'] = $p->category()->pluck('name')->first();
            $p['avg_price'] = number_format(floor($p->productVariant->avg('price')),0,'.',',');
            $p['total_stock'] = $p->productVariant->sum('stock');
        }

        $category = Category::all();

        return view('admin.product', compact(['product','category']));
    }

    protected function archive()
    {
        $product = Product::all()->where('status','draft');
        foreach($product as $p) {
            $p['category'] = $p->category()->pluck('name')->first();
            $p['total_variant'] = count($p->productVariant);
        }

        return view('admin.product-archive', compact('product'));
    }

    protected function publishing($id)
    {
        $product = Product::find($id);
        $product->status = 'public';
        $product->save();

        return redirect()->route('admin.product-archive');
    }

    protected function archiving($id)
    {
        $product = Product::find($id);
        $product->status = 'draft';
        $product->save();

        return redirect()->route('admin.product');
    }


    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'category_code' => ['required'],
        ], [
            'name' => 'Nama produk tidak sesuai',
            'category_code' => 'Harus diisi',
        ]);
        $product = Product::create([
            'name' => $request['name'],
            'category_code' => $request['category_code'],
            'status' => 'draft'
        ]);

        return redirect()->route('admin.product-edit', $product->id);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $productVariant = array();
        $i = 0;
        $productVariantRaw = $product->productVariant;
        $productVariantCol = Schema::getColumnListing('product_variants');
        array_shift($productVariantCol);
        $productVariantCol[count($productVariantCol)] = 'product_variant_code';
        $category = Category::all();
        foreach($productVariantRaw as $v) {
            for($index = 0; $index<count($productVariantCol); $index++) {
                for($id = 0; $id<count($productVariant); $id++) {
                    if($productVariant[$id]['product_id'] == $v['product_id']) {
                        if(isset($productVariant[$id]['size(cm)']) && $productVariant[$id]['size(cm)'] == $v['size(cm)']) {
                            if(isset($productVariant[$id]['color']) && $productVariant[$id]['color'] == $v['color']) {
                                if(!isset($productVariant[$i]['product_variant_code'])) {
                                    $productVariant[$i]['product_variant_code'] = $v->product_variant_code;
                                } else {
                                    $productVariant[$i]['product_variant_code'] .= ','.$v->product_variant_code;
                                }
                                $productVariant[$i]['size'] = explode(".", $v['size(cm)'])[0];
                                $productVariant[$i]['h'] = explode("-", explode(".", $v['size(cm)'])[1])[0];
                                $productVariant[$i]['w'] = explode("-", explode(".", $v['size(cm)'])[1])[1];
                                $productVariant[$i]['t'] = explode("-", explode(".", $v['size(cm)'])[1])[2];
                                $productVariant[$i]['total_stock'] = $productVariantRaw->where('size(cm)', $v['size(cm)'])->sum('stock');
                                if(!isset($productVariant[$i]['color_stock'])) {
                                    $productVariant[$i]['color_stock'] = $v->color.'.'.$v->stock;
                                } else {
                                    $productVariant[$i]['color_stock'] .= ','.$v->color.'.'.$v->stock;
                                }
                                continue 3;
                            }
                        }
                    }
                }
                $productVariant[$i][$productVariantCol[$index]] = $v[$productVariantCol[$index]];
            }
            $productVariant[$i]['size'] = explode(".", $v['size(cm)'])[0];
            $productVariant[$i]['h'] = explode("-", explode(".", $v['size(cm)'])[1])[0];
            $productVariant[$i]['w'] = explode("-", explode(".", $v['size(cm)'])[1])[1];
            $productVariant[$i]['t'] = explode("-", explode(".", $v['size(cm)'])[1])[2];
            $productVariant[$i]['total_stock'] = $productVariantRaw->where('size(cm)', $v['size(cm)'])->sum('stock');
            if(!isset($productVariant[$i]['color_stock'])) {
                $productVariant[$i]['color_stock'] = "";
            }
            $productVariant[$i]['color_stock'] .= $v->color.'.'.$v->stock;
            $i++;
        }

        return view('admin.product-edit', compact(['product','productVariant','category']));
    }

    public function update(Request $request, $id)
    {
        Product::find($id)->update($request->all());

        return redirect()->route('admin.product-edit', $id);
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->back();
    }
}
