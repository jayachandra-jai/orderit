package com.example.jai.orderit.adapters.cart;

/**
 * Created by KEERTHI on 05-03-2018.
 */

public class CartItem {
    String item_id,item_name;
    double price;
    int qunatity,index;

    public int getIndex() {
        return index;
    }

    public void setIndex(int index) {
        this.index = index;
    }

    public CartItem(String item_id, String item_name, double price, int qunatity) {

        this.item_id = item_id;
        this.item_name = item_name;
        this.price = price;
        this.qunatity = qunatity;


    }

    public CartItem() {

    }

    public String getItem_id() {
        return item_id;
    }

    public void setItem_id(String item_id) {
        this.item_id = item_id;
    }

    public String getItem_name() {
        return item_name;
    }

    public void setItem_name(String item_name) {
        this.item_name = item_name;
    }

    public double getPrice() {
        return price;
    }

    public void setPrice(double price) {
        this.price = price;
    }

    public int getQunatity() {
        return qunatity;
    }

    public void setQunatity(int qunatity) {
        this.qunatity = qunatity;
    }


}
