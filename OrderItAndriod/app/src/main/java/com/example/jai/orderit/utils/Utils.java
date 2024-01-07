package com.example.jai.orderit.utils;

import android.app.Activity;
import android.content.Context;
import android.content.DialogInterface;
import android.net.ConnectivityManager;
import android.support.v7.app.AlertDialog;
import android.view.inputmethod.InputMethodManager;

/**
 * Created by KEERTHI on 07-03-2018.
 */

public class Utils {

    private static AlertDialog.Builder alertDialogBuilder = null;
    private static AlertDialog myAlertDialog;

    public static void hideKeyBoard(Activity activity) {
        if (activity != null) {
            try {
                ((InputMethodManager) activity.getSystemService(Context.INPUT_METHOD_SERVICE)).hideSoftInputFromWindow(activity.getCurrentFocus().getWindowToken(), 0);
            } catch (NullPointerException e) {
            }
        }
    }

    public static boolean isNetworkAvailable(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        return cm.getActiveNetworkInfo() != null;
    }

    public static void setAlertMsg(final Activity activity, String msg, String btnName, final boolean isActivityFinish,boolean isLogout) {

//        ImageView image = new ImageView(activity);
////        ViewGroup.LayoutParams lp = new ViewGroup.LayoutParams(ViewGroup.LayoutParams.WRAP_CONTENT, ViewGroup.LayoutParams.WRAP_CONTENT);
//        image.requestLayout();
//        image.getLayoutParams().height = 35;
//        image.getLayoutParams().width = 35;

//
//        image.setScaleType(ImageView.ScaleType.FIT_XY);
//        if(iserror){
//            image.setImageResource(R.drawable.error_disp);
//        }
//        else {
//            image.setImageResource(R.drawable.smile);
//        }
        if (myAlertDialog != null && myAlertDialog.isShowing()) {
            myAlertDialog.dismiss();
            myAlertDialog = null;
        }
        alertDialogBuilder = new AlertDialog.Builder(activity);
        alertDialogBuilder.setCancelable(false);
        alertDialogBuilder.setMessage(msg).setPositiveButton(btnName, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.dismiss();
                if (isActivityFinish) {
                    activity.finish();
                }

            }
        }).show();
    }
}
