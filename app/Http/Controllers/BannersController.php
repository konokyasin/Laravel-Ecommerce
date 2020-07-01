<?php

namespace App\Http\Controllers;

use App\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class BannersController extends Controller
{
    public function banners()
    {
        $banners = Banners::all();
        return view('admin.banner.banners', compact('banners'));
    }

    public function addBanner()
    {
        return view('admin.banner.add_banner');
    }

    public function storeBanner(Request $request)
    {
        $data = $request->all();
        $banner = new Banners;
        $banner->name = $data['banner_name'];
        $banner->text_style = $data['text_style'];
        $banner->sort_order = $data['sort_order'];
        $banner->content = $data['banner_content'];
        $banner->link = $data['link'];
        //upload image
        if ($request->hasFile('image')) {
            echo $img_tmp = Input::file('image');
            //image path
            $extension = $img_tmp->getClientOriginalExtension();
            $filename = rand(111, 9999) . '.' . $extension;
            $banner_path = 'uploads/banner/' . $filename;
            Image::make($img_tmp)->save($banner_path);
            $banner->image = $filename;
        }
        $banner->save();
        return redirect('/admin/banners')->with('working', 'Banner has been added Successfully!!');
    }

    public function editBanner($id=null)
    {
        $bannerDetails = Banners::where(['id'=>$id])->first();
        return view('admin.banner.edit_banner', compact('bannerDetails'));
    }

    public function updateBanner(Request $request,$id = null)
    {
        $data = $request->all();
        //upload image
        if ($request->hasFile('image')) {
            echo $img_tmp = Input::file('image');
            if ($img_tmp->isValid()) {
                //image path
                $extension = $img_tmp->getClientOriginalExtension();
                $filename = rand(111, 9999) . '.' . $extension;
                $banner_path = 'uploads/banner/' . $filename;
                Image::make($img_tmp)->save($banner_path);
            }
           
        } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
        } else {
            $filename = '';
        }

        Banners::where(['id' => $id])->update([
            'name' => $data['banner_name'],
            'text_style' => $data['text_style'],
            'content' => $data['banner_content'],
            'sort_order' => $data['sort_order'], 
            'image' => $filename
        ]);

        return redirect('/admin/banners')->with('working', 'Banner has been updated Successfully!!');
        
    }

    public function deleteBanner($id=null)
    {
        Banners::where(['id' => $id])->delete();
        Alert::success('Deleted Successfully', 'Banner Deleted!!');
        return redirect()->back();
    }

    public function bannerStatus(Request $request)
    {
        $data = $request->all();
        Banners::where('id', $data['id'])->update(['status' => $data['status']]);
    }
}
