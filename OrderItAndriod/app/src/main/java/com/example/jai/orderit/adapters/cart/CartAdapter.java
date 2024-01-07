package com.example.jai.orderit.adapters.cart;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.andremion.counterfab.CounterFab;
import com.example.jai.orderit.R;

import java.util.List;

/**
 * Created by KEERTHI on 06-03-2018.
 */

public class CartAdapter extends RecyclerView.Adapter<CartViewHolder> {

    List<CartItem> arrayList;
    TextView tv_total;
    CounterFab fab;

    public CartAdapter(@NonNull List<CartItem> objects,TextView tv_total) {
        this.arrayList = objects;
        this.tv_total=tv_total;
    }

    @Override
    public CartViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.cart_item, parent, false);

        return new CartViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(CartViewHolder holder, int position) {
        holder.onBind(arrayList, position,tv_total,this);
    }

    @Override
    public int getItemCount() {
        return arrayList.size();
    }
    public void removeAt(int position) {
        arrayList.remove(position);
        notifyItemRemoved(position);
        notifyItemRangeChanged(position, arrayList.size());
    }

}

