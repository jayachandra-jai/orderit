package com.example.jai.orderit.adapters.itemadapters;

/**
 * Created by KEERTHI on 04-03-2018.
 */

public class ItemModel {
    String item_id,title,price,pic_url,views_no,rating,description,item_type;

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

    public String getPic_url() {
        return pic_url;
    }

    public void setPic_url(String pic_url) {
        this.pic_url = pic_url;
    }

    public String getViews_no() {
        return views_no;
    }

    public void setViews_no(String views_no) {
        this.views_no = views_no;
    }

    public String getRating() {
        return rating;
    }

    public void setRating(String rating) {
        this.rating = rating;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getItem_type() {
        return item_type;
    }

    public void setItem_type(String item_type) {
        this.item_type = item_type;
    }

    public ItemModel(String item_id, String title, String price, String pic_url, String views_no, String rating, String description, String item_type) {

        this.item_id = item_id;
        this.title = title;
        this.price = price;
        this.pic_url = pic_url;
        this.views_no = views_no;
        this.rating = rating;
        this.description = description;
        this.item_type=item_type;

    }
}
