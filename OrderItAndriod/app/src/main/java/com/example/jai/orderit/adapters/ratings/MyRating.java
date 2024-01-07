package com.example.jai.orderit.adapters.ratings;

/**
 * Created by KEERTHI on 07-03-2018.
 */


    public class MyRating {
        String item_id,ratting;

        public MyRating(String item_id, String ratting) {
            this.item_id = item_id;
            this.ratting = ratting;
        }

        public String getItem_id() {
            return item_id;
        }

        public void setItem_id(String item_id) {
            this.item_id = item_id;
        }

        public String getRatting() {
            return ratting;
        }

        public void setRatting(String ratting) {
            this.ratting = ratting;
        }
    }

