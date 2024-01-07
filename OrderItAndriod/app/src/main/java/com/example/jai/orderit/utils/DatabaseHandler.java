package com.example.jai.orderit.utils;
import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.DatabaseUtils;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import com.example.jai.orderit.adapters.cart.CartItem;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Jai on 05-03-2018.
 */

public class DatabaseHandler extends SQLiteOpenHelper {

    // Database Version
    private static final int DATABASE_VERSION = 1;

    // Database Name
    private static final String DATABASE_NAME = "cartManager";

    // Contacts table name
    private static final String TABLE_CART = "cart";
    // Contacts Table Columns names
    private static final String KEY_INDEX = "id";
    private static final String KEY_ID = "itemid";
    private static final String KEY_ITEM_NAME = "name";
    private static final String KEY_PRICE = "price";
    private static final String KEY_QUANTITY = "quantity";


    public DatabaseHandler(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    //Create tables
    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_TABLE_CART="CREATE TABLE " + TABLE_CART + "("
                + KEY_INDEX +" INTEGER PRIMARY KEY AUTOINCREMENT, "
                + KEY_ID +" TEXT,"
                + KEY_ITEM_NAME +" TEXT,"
                + KEY_PRICE +" NUMBER,"
                + KEY_QUANTITY  +" INTEGER" + ")";
        Log.d("string",CREATE_TABLE_CART);
        db.execSQL(CREATE_TABLE_CART);
    }

    // Upgrading database
    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

        // Drop older table if existed
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_CART);

        // Create tables again
        onCreate(db);
    }

    /**
     * All CRUD(Create, Read, Update, Delete) Operations
     */

    //Insert values to the table contacts
    public void addItem(CartItem item){
        SQLiteDatabase db = this.getReadableDatabase();
        ContentValues values=new ContentValues();

        values.put(KEY_ID, item.getItem_id());
        values.put(KEY_ITEM_NAME, item.getItem_name());
        values.put(KEY_PRICE, item.getPrice());
        values.put(KEY_QUANTITY, item.getQunatity());


        db.insert(TABLE_CART, null, values);
        db.close();
    }


    /**
     *Getting All Contacts
     **/

    public List<CartItem> getAllCartItems() {
        List<CartItem> itemList = new ArrayList<CartItem>();
        // Select All Query
        String selectQuery = "SELECT  * FROM " + TABLE_CART;

        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);

        // looping through all rows and adding to list
        if (cursor.moveToFirst()) {
            do {
                CartItem item = new CartItem();
                item.setIndex(Integer.parseInt(cursor.getString(0)));
                item.setItem_id(cursor.getString(1));
                item.setItem_name(cursor.getString(2));
                item.setPrice(Double.parseDouble(cursor.getString(3)));
                item.setQunatity(Integer.parseInt(cursor.getString(4)));
                // Adding contact to list
                itemList.add(item);
            } while (cursor.moveToNext());
        }

        // return contact list
        return itemList;

    }

    public double getCartTotal() {
       double amount=0.0;
        // Select All Query
        String selectQuery = "SELECT  * FROM " + TABLE_CART;

        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);

        // looping through all rows and adding to list
        if (cursor.moveToFirst()) {
            do {

                amount+=( Double.parseDouble(cursor.getString(3)) * Integer.parseInt(cursor.getString(4) ));


            } while (cursor.moveToNext());
        }

        // return contact list
        return amount;

    }
    /**
     *Updating single contact
     **/

    public int updateQuantity(int val, int id) {
        SQLiteDatabase db = this.getWritableDatabase();

        ContentValues values=new ContentValues();

        values.put(KEY_QUANTITY, val);



        // updating row
        return db.update(TABLE_CART, values, KEY_INDEX + " = ?",
                new String[] { String.valueOf(id) });
    }

    /**
     *Deleting single contact
     **/

    public void deleteItem(int Id) {
        SQLiteDatabase db = this.getWritableDatabase();
        db.delete(TABLE_CART, KEY_INDEX + " = ?",
                new String[] { String.valueOf(Id) });
        db.close();
    }
    public void deleteAllItems()
    {
        SQLiteDatabase db = this.getWritableDatabase();
        db.execSQL("delete from "+ TABLE_CART);
        db.close();
    }
    public int getCartSize() {
        int numRows = (int) DatabaseUtils.queryNumEntries(this.getReadableDatabase(), TABLE_CART);
        return numRows;
    }

}
