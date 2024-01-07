package com.example.jai.orderit.myfragments.items;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.GridView;

import com.example.jai.orderit.R;
import com.example.jai.orderit.adapters.itemadapters.SubCatAdapter;

public class NonVegFragment extends Fragment  {
    View view;
    GridView veggrid;
    String names[]={"Soups","Biryani Items","Starters","Main Courses","Staples","Restaurant Specials","Chinese Food","Tandoor se"};
    int imagesId[]={R.drawable.soupveg,R.drawable.bir,R.drawable.starters,R.drawable.mainnon,R.drawable.staples,R.drawable.special,R.drawable.chin,R.drawable.tandoor};
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
// Inflate the layout for this fragment
        view = inflater.inflate(R.layout.veg_fragment, container, false);
        return view;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        veggrid= view.findViewById(R.id.myveg);
        veggrid.setAdapter(new SubCatAdapter(names,getActivity(),imagesId));
        veggrid.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Bundle bundle = new Bundle();
                bundle.putString("type","Non-Veg"); // Put anything what you want
                bundle.putString("sub_cat",names[i]);
                SubCatViewFragment fragment = new SubCatViewFragment();
                fragment.setArguments(bundle);

                getFragmentManager()
                        .beginTransaction()
                        .replace(R.id.container, fragment)
                        .addToBackStack(null)
                        .commit();
            }
        });

    }


}
