package com.example.jai.orderit.adapters.itemadapters;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RatingBar;
import android.widget.TextView;


import com.andremion.counterfab.CounterFab;
import com.bumptech.glide.Glide;
import com.example.jai.orderit.ItemActivity;
import com.example.jai.orderit.R;
import com.example.jai.orderit.adapters.cart.CartItem;
import com.example.jai.orderit.utils.DatabaseHandler;

import java.util.List;

/**
 * Created by KEERTHI on 06-02-2018.
 */

public class MyViewHolder extends RecyclerView.ViewHolder {

    private View view;
    Context context;
    ImageView item_pic,item_type,item_add;
    TextView item_name,item_price,item_ratting,item_ratting_views;
    RatingBar item_ratting_bar;
    DatabaseHandler mycart;
    LinearLayout total_item_view;


    public MyViewHolder(View view) {
        super(view);
        this.view=view;
        context=view.getContext();
        item_pic=view.findViewById(R.id.item_pic);
        item_type=view.findViewById(R.id.item_type);
        item_name=view.findViewById(R.id.item_name);
        item_price=view.findViewById(R.id.item_price);
        item_ratting=view.findViewById(R.id.item_ratting);
        item_ratting_views=view.findViewById(R.id.item_ratting_views);
        item_ratting_bar=view.findViewById(R.id.item_ratting_bar);
        item_add=view.findViewById(R.id.add_item);
        total_item_view=view.findViewById(R.id.total_item_view);
        mycart=new DatabaseHandler(context);


    }

    public void onBind(List<ItemModel> data, final int position, final CustomItemAdapter.ItemClickListener clickListener, final CounterFab counterFab) {
        final ItemModel item=data.get(position);
        Glide.with(context)
                .load(item.getPic_url())
                .placeholder(R.drawable.logo)
                .into(item_pic);
        if(item.getItem_type().equals("Veg")){
            item_type.setImageResource(R.drawable.veg);
        }
        else {
            item_type.setImageResource(R.drawable.nonveg);
        }
        item_name.setText(item.getTitle());
        item_price.setText("Rs."+String.format("%1.2f",Float.parseFloat(item.getPrice()))+"/-");
        item_ratting.setText(item.getRating());
        item_ratting_views.setText(item.getViews_no());
        item_ratting_bar.setRating( Float.parseFloat(item.getRating()));
        item_add.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mycart.addItem(new CartItem(item.getItem_id(),item.getTitle(),Double.parseDouble(item.getPrice()),1));
                counterFab.setCount(mycart.getCartSize());

            }
        });
        total_item_view.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(context,ItemActivity.class);
                i.putExtra("Item_Id",item.getItem_id());
                i.putExtra("Item_Title",item.getTitle());
                i.putExtra("Item_Description",item.getDescription());
                i.putExtra("Item_Type",item.getItem_type());
                i.putExtra("Item_Pic",item.getPic_url());
                i.putExtra("Item_Price",item.getPrice());
                i.putExtra("Item_Rating",item.getRating());
                i.putExtra("Item_Views",item.getViews_no());
               context.startActivity(i);
            }
        });


    }
}