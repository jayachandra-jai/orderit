package com.example.jai.orderit.adapters.order;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.jai.orderit.R;

import java.util.List;

/**
 * Created by KEERTHI on 06-03-2018.
 */

public class OrderAdapter extends RecyclerView.Adapter<OrderViewHolder> {

    List<OrderModel> arrayList;

    public OrderAdapter(@NonNull List<OrderModel> objects) {
        this.arrayList = objects;

    }

    @Override
    public OrderViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.order_item, parent, false);

        return new OrderViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(OrderViewHolder holder, int position) {
        holder.onBind(arrayList, position);
    }

    @Override
    public int getItemCount() {
        return arrayList.size();
    }

}

