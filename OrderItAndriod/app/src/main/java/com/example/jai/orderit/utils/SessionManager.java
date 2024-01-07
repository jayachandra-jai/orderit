package com.example.jai.orderit.utils;

/**
 * Created by KEERTHI on 02-03-2018.
 */


import java.util.HashMap;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;

import com.example.jai.orderit.HomeActivity;
import com.example.jai.orderit.LoginActivity;
import com.example.jai.orderit.SplashActivity;

public class SessionManager {
    // Shared Preferences
    SharedPreferences pref;

    // Editor for Shared preferences
    Editor editor;

    // Context
    Context _context;

    // Shared pref mode
    int PRIVATE_MODE = 0;

    // Sharedpref file name
    private static final String PREF_NAME = "pref";

    // All Shared Preferences Keys
    private static final String IS_LOGIN = "IsLoggedIn";

    private static final String IS_USER_LOGIN="IsUserLoggedIn";

    public static final String ORDER_ID="order_id";

    public static final String USER_NAME="customer_name";

    // User name (make variable public to access from outside)
    public static final String KEY_NAME = "tab_name";

    // Email address (make variable public to access from outside)
    public static final String KEY_ID = "tab_id";


    // Constructor
    public SessionManager(Context context){
        this._context = context;
        pref = _context.getSharedPreferences(PREF_NAME, PRIVATE_MODE);
        editor = pref.edit();
    }

    /**
     * Create login session
     * */
    public void createLoginSession(String id, String name){
        // Storing login value as TRUE
        editor.putBoolean(IS_LOGIN, true);

        // Storing name in pref
        editor.putString(KEY_NAME, name);

        // Storing email in pref
        editor.putString(KEY_ID, id);

        // commit changes
        editor.commit();
    }

    /**
     * Check login method wil check user login status
     * If false it will redirect user to login page
     * Else won't do anything
     * */
    public void checkLogin(){
        // Check login status
        if(!this.isLoggedIn()){
            // user is not logged in redirect him to Login Activity
            Intent i = new Intent(_context, SplashActivity.class);
            // Closing all the Activities
            i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

            // Add new Flag to start new Activity
            i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

            // Staring Login Activity
            _context.startActivity(i);
        }

    }



    /**
     * Get stored session data
     * */
    public HashMap<String, String> getUserDetails(){
        HashMap<String, String> user = new HashMap<String, String>();
        // user name
        user.put(KEY_NAME, pref.getString(KEY_NAME, ""));

        // user email id
        user.put(KEY_ID, pref.getString(KEY_ID, ""));

        // return user
        return user;
    }

    public  String getTableId(){
        return pref.getString(KEY_ID, "");
    }
    public  String getTableName(){
        return pref.getString(KEY_NAME, "");
    }


    /**
     * Clear session details
     * */
    public void logoutUser(){
        // Clearing all data from Shared Preferences
        editor.clear();
        editor.commit();

        // After logout redirect user to Loing Activity
        Intent i = new Intent(_context, LoginActivity.class);
        // Closing all the Activities
        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);

        // Staring Login Activity
        _context.startActivity(i);
    }

    /**
     * Quick check for login
     * **/
    // Get Login State
    public boolean isLoggedIn(){
        return pref.getBoolean(IS_LOGIN, false);
    }

    public void createCustomerLogin(String id, String name){
        // Storing login value as TRUE
        editor.putBoolean(IS_USER_LOGIN, true);

        // Storing name in pref
        editor.putString(USER_NAME, name);

        // Storing email in pref
        editor.putString(ORDER_ID, id);

        // commit changes
        editor.commit();
    }
    public  String getOrderId(){
        return pref.getString(ORDER_ID, "");
    }
    public  String getCustomerName(){
        return pref.getString(USER_NAME, "");
    }

    public boolean isCustomerLoggedIn(){
        return pref.getBoolean(IS_USER_LOGIN, false);
    }

    public void logoutCustomer(){
        // Clearing all data from Shared Preferences
        editor.remove(USER_NAME);
        editor.remove(ORDER_ID);
        editor.putBoolean(IS_USER_LOGIN, false);
        editor.commit();

        // After logout redirect user to Loing Activity
        Intent i = new Intent(_context, HomeActivity.class);
        // Closing all the Activities
        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

        // Add new Flag to start new Activity
        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

        // Staring Login Activity
        _context.startActivity(i);
    }
}
