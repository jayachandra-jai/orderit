package com.example.jai.orderit.adapters.ratings;

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

public class RateAdapter extends RecyclerView.Adapter<RateViewHolder> {

    List<ReviewItem> arrayList;

    public RateAdapter(@NonNull List<ReviewItem> objects) {
        this.arrayList = objects;

    }

    @Override
    public RateViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.rate_item, parent, false);

        return new RateViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(RateViewHolder holder, int position) {
        holder.onBind(arrayList, position);
    }

    @Override
    public int getItemCount() {
        return arrayList.size();
    }

}

