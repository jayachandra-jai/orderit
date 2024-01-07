package com.example.jai.orderit.adapters.ratings;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import com.example.jai.orderit.R;

import java.util.List;

/**
 * Created by KEERTHI on 06-03-2018.
 */

public class RateViewHolder extends RecyclerView.ViewHolder {

    private View view;
    Context context;
    ImageView remove_item;
    TextView item_name, item_price;
   RatingBar ratingBar;

    public RateViewHolder(View view) {
        super(view);
        this.view = view;
        context = view.getContext();
        item_name = view.findViewById(R.id.rate_item_name);
        item_price = view.findViewById(R.id.rate_price);
        ratingBar=view.findViewById(R.id.rt_val);


    }

    public void onBind(List<ReviewItem> data, final int position) {
        final ReviewItem item = data.get(position);
        ReviewItem.rates.add(position,new MyRating(item.getItem_id(),ratingBar.getRating()+""));

        item_name.setText(item.getTitle());
        item_price.setText("Rs. " + item.getPrice()+"/-");
        ratingBar.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
            @Override
            public void onRatingChanged(RatingBar ratingBar, float v, boolean b) {
               ReviewItem.rates.get(position).setRatting(String.format("%1.1f", v));
            }
        });


    }
}