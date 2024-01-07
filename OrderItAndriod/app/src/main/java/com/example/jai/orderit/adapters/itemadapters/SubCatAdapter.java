package com.example.jai.orderit.adapters.itemadapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.jai.orderit.R;

import de.hdodenhof.circleimageview.CircleImageView;


/**
 * Created by KEERTHI on 03-03-2018.
 */

public class SubCatAdapter extends BaseAdapter {
    String [] names;
    Context context;
    int [] imageId;
    private static LayoutInflater inflater=null;
    public SubCatAdapter(String[] names, Context context, int[] imageId) {
        this.names = names;
        this.context = context;
        this.imageId = imageId;
        inflater = ( LayoutInflater )context.
                getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public int getCount() {
        return names.length;

    }

    @Override
    public Object getItem(int i) {
        return i;
    }

    @Override
    public long getItemId(int i) {
        return i;
    }
    public class Holder
    {
        TextView tv;
        CircleImageView img;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {

        Holder holder=new Holder();
        View rowView;

        rowView = inflater.inflate(R.layout.sub_cat_item, null);
        holder.tv= rowView.findViewById(R.id.cat_name);
        holder.img= rowView.findViewById(R.id.cat_img);

        holder.tv.setText(names[i]);
        holder.img.setImageResource(imageId[i]);
        return rowView;
    }
}
