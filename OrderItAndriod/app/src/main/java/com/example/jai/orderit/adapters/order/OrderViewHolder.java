package com.example.jai.orderit.adapters.order;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.TextView;

import com.example.jai.orderit.R;

import java.util.List;

/**
 * Created by KEERTHI on 06-03-2018.
 */

public class OrderViewHolder extends RecyclerView.ViewHolder {

    private View view;
    Context context;
    TextView item_name, item_price,quantity ,item_total;

    public OrderViewHolder(View view) {
        super(view);
        this.view = view;
        context = view.getContext();
        item_name = view.findViewById(R.id.name);
        item_price = view.findViewById(R.id.price);
        item_total = view.findViewById(R.id.order_amount);
        quantity = view.findViewById(R.id.quantity);
    }

    public void onBind(List<OrderModel> data, final int position) {
        final OrderModel item = data.get(position);
        item_name.setText(item.getTitle());
        item_price.setText("Rs. " + String.format("%1.2f",Float.parseFloat(item.getPrice())));
        quantity.setText( item.getQuantity());
        item_total.setText("Rs. "+String.format("%1.2f",Float.parseFloat(item.getAmount())));
    }
}