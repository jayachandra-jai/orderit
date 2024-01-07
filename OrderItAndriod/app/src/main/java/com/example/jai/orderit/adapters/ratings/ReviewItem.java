package com.example.jai.orderit.adapters.ratings;

import java.util.ArrayList;

/**
 * Created by KEERTHI on 05-03-2018.
 */

public class ReviewItem {
    String item_id,title,price;
    public static ArrayList<MyRating> rates =new ArrayList<>();
    public String getItem_id() {
        return item_id;
    }

    public void setItem_id(String item_id) {
        this.item_id = item_id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public ReviewItem(String item_id, String title, String price) {

        this.item_id = item_id;
        this.title = title;
        this.price = price;
    }


}
