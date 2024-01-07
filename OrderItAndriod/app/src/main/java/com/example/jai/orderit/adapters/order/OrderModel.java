package com.example.jai.orderit.adapters.order;

/**
 * Created by KEERTHI on 06-03-2018.
 */

public class OrderModel {
    String item_id,title,price,quantity,amount;

    public OrderModel(String item_id, String title, String price, String quantity, String amount) {
        this.item_id = item_id;
        this.title = title;
        this.price = price;
        this.quantity = quantity;
        this.amount = amount;
    }

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

    public String getQuantity() {
        return quantity;
    }

    public void setQuantity(String quantity) {
        this.quantity = quantity;
    }

    public String getAmount() {
        return amount;
    }

    public void setAmount(String amount) {
        this.amount = amount;
    }
}
