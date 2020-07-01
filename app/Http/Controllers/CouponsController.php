<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use App\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function addCoupon()
    {
        return view('admin.coupons.add_coupon');
    }

    public function storeCoupon(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupons;
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_amount = $data['coupon_amount'];
        $coupon->amount_type = $data['amount_type'];
        $coupon->expire_date = $data['expire_date'];
        $coupon->save();
        return redirect('/admin/view-coupons')->with('working', 'Coupon added Successfully!!');
    }
    public function viewCoupons()
    {
        $coupons = Coupons::all();
        return view('admin.coupons.view_coupon', compact('coupons'));
    }

    public function couponStatus(Request $request)
    {
        $data = $request->all();
        Coupons::where('id', $data['id'])->update(['status' => $data['status']]);
    }

    public function editCoupon($id=null)
    {
        $couponDetails = Coupons::find($id);
        return view('admin.coupons.edit_coupon', compact('couponDetails'));
    }

    public function updateCoupon(Request $request, $id = null)
    {
            $data = $request->all();
            $coupon = Coupons::find($id);
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->coupon_amount = $data['coupon_amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expire_date = $data['expire_date'];
            $coupon->save();
            return redirect('/admin/view-coupons')->with('working', 'Coupon has been Updated Successfully!!');
    }
    public function deleteCoupon($id = null)
    {
        Coupons::where(['id' => $id])->delete();
        Alert::success('Deleted', 'Coupon Deleted!!');
        return redirect()->back();
    }
}
