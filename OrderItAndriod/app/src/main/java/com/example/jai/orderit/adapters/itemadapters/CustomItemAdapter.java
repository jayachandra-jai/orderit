package com.example.jai.orderit.adapters.itemadapters;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.andremion.counterfab.CounterFab;
import com.example.jai.orderit.R;

import java.util.List;

/**
 * Created by KEERTHI on 06-02-2018.
 */

public class CustomItemAdapter extends RecyclerView.Adapter<MyViewHolder> {

    List<ItemModel> arrayList;
    ItemClickListener  clickListener;
    CounterFab fab;

    public CustomItemAdapter(@NonNull List<ItemModel> objects, ItemClickListener  clickListener, CounterFab fab) {
        this.arrayList = objects;
        this.clickListener = clickListener;
        this.fab=fab;
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.item_view, parent, false);

        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {
        holder.onBind(arrayList, position,clickListener,fab);
    }

    @Override
    public int getItemCount() {
        return arrayList.size();
    }

    public interface ItemClickListener {
        void onItemClick(View view, int position);
    }
}

