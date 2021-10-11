<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['products_id', 'invoice_id', 'section_id'];

    protected $appends = ['asset_id', 'product_name', 'consumables', 'user_name', 'section_name', 'brand_name','last_updated'];


    protected $hidden = ['section', 'created_at', 'updated_at'];



    public function getCategoryAttribute()
    {
        return $this->products->sub_category->category->cat_name;
    }

    public function getSubCategoryAttribute()
    {
        return $this->products->sub_category->name;
    }

    public function getBrandNameAttribute()
    {
        return $this->products->brand->name;
    }

    public function getAssetIdAttribute()
    {
        return "DGADS/" . $this->products->sub_category->name . "/" . $this->asset_number;
    }

    public function getProductNameAttribute()
    {
        return $this->products->brand_name . " " . $this->products->model;
    }

    public function getConsumablesAttribute()
    {
        $consumables = [];
        foreach($this->products->consumables as $consumable)
        {
            array_push($consumables, $consumable->name);
        }

        return $consumables;
    }

    public function getUserNameAttribute()
    {
        if ($this->in_stock == 1)
            return 0;
        else
            return $this->user->name;
    }

    public function getSectionNameAttribute()
    {
        if ($this->in_stock == 1)
            return 0;
        else
            return $this->section->name;
    }



    public function getLastUpdatedAttribute()
    {
        return $this->updated_at->format('Y-m-d');
    }




    public static function getUserAssets($user_id)
    {
        return Asset::where('user_id', $user_id)->get();
    }

    public static function getSectionAssets($section_id)
    {
        return Asset::where('section_id', $section_id)->get()->load('products.consumables');
    }


    public function format()
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'asset_id' => $this->asset_id,
            'serial_no' => $this->serial_no,
            'products_id' => $this->products_id,
            'product_name' => $this->products->brand->name . " " . $this->products->model,
            'invoice_details' => $this->invoice->invoice_number . " " . $this->invoice->invoice_date,
            'item_price' => $this->invoice_item->rate,
            'in_stock' => $this->in_stock,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'section_name' => $this->section->section_name,
            'invoice_id' => $this->invoice_id,
            'last_updated' => $this->last_updated,
        ];
    }


    // list all assets authorised to user for example section user can access all assets in section while individual user will only access his/her own assets

    public static function listAssets($request)
    {
        $user = $request->user();

        if ($user->hasRole('SectionUser')) return Asset::getSectionAssets($user->section_id);

        else return Asset::getUserAssets($user->id);
    }

    public static function createWithAssetNumber($data)
    {
        $asset = Asset::create($data);
        $asset->asset_number = $data['asset_number'];
        $asset->invoice_id = $data['invoice_id'];

        $asset->save();

        return $asset;
    }

    public static function createWithItem($item, $serial_nos)
    {
        if ($item->products)

        $latest_serial_no = Asset::lastSerialNumber($item->products->sub_category->id, $item->invoice->invoice_date);

        for ($i = 0; $i < $item['quantity']; $i++)
        {
            $asset = Asset::create([
                'products_id' => $item->products_id,
                'invoice_id' => $item->invoice_id,
                ]);
            $asset->asset_number = ++$latest_serial_no;
            $asset->serial_no = $serial_nos[$i];

            $asset->save();
        }

        // foreach ($item['serial_no'] as $item)
        // {
        //     Asset::create($item);
        // }

        return "success";
    }

    public function createNewAssetNumber()
    {
        $sub_category = $this->product->sub_category;
    }

    public function products()
    {
        return $this->belongsTo('App\Products');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function invoice_item()
    {

    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function repairs()
    {
        return $this->hasMany('App\Repair');
    }




    public static function lastSerialNumber($sub_category_id, $invoice_date)
    {
        $var = Asset::whereHas('products.sub_category', function($query) use ($sub_category_id){
            $query->where('id', '=', $sub_category_id);
        })
        ->whereHas('invoice', function($query) use ($invoice_date){
            $date = now();
            $date->month(1)->day(1);

            $query->where('invoice_date', '<=', $invoice_date);
        })
        ->orderBy('asset_number', 'desc')
        ->first('asset_number');

        // $var = now();

        return $var['asset_number'];
    }
}
