package com.example.jai.orderit.adapters.cart;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.jai.orderit.R;
import com.example.jai.orderit.utils.DatabaseHandler;
import com.michaelmuenzer.android.scrollablennumberpicker.ScrollableNumberPicker;
import com.michaelmuenzer.android.scrollablennumberpicker.ScrollableNumberPickerListener;

import java.util.List;

/**
 * Created by KEERTHI on 06-03-2018.
 */

public class CartViewHolder extends RecyclerView.ViewHolder {

    private View view;
    Context context;
    ImageView remove_item;
    TextView item_name, item_price, item_total;
    ScrollableNumberPicker quantity;
    DatabaseHandler mycart;

    public CartViewHolder(View view) {
        super(view);
        this.view = view;
        context = view.getContext();
        item_name = view.findViewById(R.id.cart_item_name);
        item_price = view.findViewById(R.id.cart_item_price);
        item_total = view.findViewById(R.id.item_total);
        mycart = new DatabaseHandler(context);
        remove_item = view.findViewById(R.id.remove_item);
        quantity = view.findViewById(R.id.item_count);
        quantity.setMinValue(1);


    }

    public void onBind(List<CartItem> data, final int position, final TextView tv_total, final CartAdapter cartAdapter) {
        final CartItem item = data.get(position);
        item_name.setText(item.getItem_name());
        item_price.setText("Rs. " + String.format("%1.2f", item.getPrice()));
        item_total.setText(String.format("%1.2f", item.getPrice() * item.getQunatity()));
        quantity.setValue(item.getQunatity());
        quantity.setListener(new ScrollableNumberPickerListener() {
            @Override
            public void onNumberPicked(int value) {

                item.setQunatity(value);
                mycart.updateQuantity(value, item.getIndex());
                item_total.setText(String.format("%1.2f", item.getPrice() * item.getQunatity()));
                tv_total.setText(String.format("%1.2f", mycart.getCartTotal()));
            }
        });
        remove_item.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                cartAdapter.removeAt(position);
                mycart.deleteItem(item.getIndex());
                tv_total.setText(String.format("%1.2f", mycart.getCartTotal()));
            }
        });


    }
}