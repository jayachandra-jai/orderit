package com.example.jai.orderit.myfragments.items;


import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.andremion.counterfab.CounterFab;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.CustomerActivity;
import com.example.jai.orderit.ItemActivity;
import com.example.jai.orderit.R;
import com.example.jai.orderit.adapters.itemadapters.CustomItemAdapter;
import com.example.jai.orderit.adapters.itemadapters.ItemModel;
import com.example.jai.orderit.utils.AppController;
import com.example.jai.orderit.utils.RecyclerItemClickListener;
import com.example.jai.orderit.utils.SessionManager;
import com.example.jai.orderit.utils.Urls;
import com.example.jai.orderit.utils.Utils;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created by KEERTHI on 04-03-2018.
 */

public class SubCatViewFragment extends Fragment implements CustomItemAdapter.ItemClickListener {
    View view;
    String item_type,item_cat;
    TextView title;
    ImageView back;
    RecyclerView recyclerView;
    CustomItemAdapter adapter;
    List<ItemModel> list;
    CounterFab fab;
    private ProgressDialog pDialog;

    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
// Inflate the layout for this fragment
        view = inflater.inflate(R.layout.sub_cat_view, container, false);
        return view;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        Bundle bundle = this.getArguments();
        getActivity().setTitle(new SessionManager(getActivity()).getCustomerName());
        item_type=bundle.getString("type");
        item_cat=bundle.getString("sub_cat");
        title=view.findViewById(R.id.cat_title);
        back=view.findViewById(R.id.offer_back);
        pDialog = new ProgressDialog(getActivity());
        pDialog.setMessage("Please wait.....");
        title.setText(item_cat);
        recyclerView=view.findViewById(R.id.cat_view);
        recyclerView.setLayoutManager(new LinearLayoutManager(getActivity(), LinearLayoutManager.VERTICAL, false));
        list=new ArrayList<>();
        adapter=new CustomItemAdapter(list,this,fab);
        getallItems(item_type,item_cat);
        Log.e(""+item_type,""+item_cat);
        recyclerView.setAdapter(adapter);
        adapter.notifyDataSetChanged();
        fab=getActivity().findViewById(R.id.fab);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Fragment fragment;
                if(item_type.equals("Veg")){
                    fragment=new VegFragment();
                }
                else {
                    fragment=new NonVegFragment();
                }


                getFragmentManager()
                        .beginTransaction()
                        .replace(R.id.container, fragment)
                        .addToBackStack(null)
                        .commit();
            }
        });
//        recyclerView.addOnItemTouchListener(new RecyclerItemClickListener(getActivity(), new RecyclerItemClickListener.OnItemClickListener() {
//            @Override
//            public void onItemClick(View view, int position) {
//                Intent i=new Intent(getActivity(),ItemActivity.class);
//                ItemModel item=list.get(position);
//                i.putExtra("Item_Id",item.getItem_id());
//                i.putExtra("Item_Title",item.getTitle());
//                i.putExtra("Item_Description",item.getDescription());
//                i.putExtra("Item_Type",item.getItem_type());
//                i.putExtra("Item_Pic",item.getPic_url());
//                i.putExtra("Item_Price",item.getPrice());
//                i.putExtra("Item_Rating",item.getRating());
//                i.putExtra("Item_Views",item.getViews_no());
//                    getActivity().startActivity(i);
//            }
//        }));

    }
    private void getallItems(final String type, final String catg) {
            showpDialog();
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Log.d("res", response.toString());

                        try {
                            JSONObject jsonresponse = new JSONObject(response);
                            String message = jsonresponse.getString("message");
                            if (!jsonresponse.getBoolean("error")) {

                                if(jsonresponse.getInt("items_count")!=0) {
                                    JSONArray itemsJson=jsonresponse.getJSONArray("items_info");
                                    Log.d("Array",itemsJson.toString());
                                    GsonBuilder builder = new GsonBuilder();
                                    Gson mGson = builder.create();

                                    list = Arrays.asList(mGson.fromJson(itemsJson.toString(), ItemModel[].class));
                                    adapter = new CustomItemAdapter(list, SubCatViewFragment.this, fab);
                                    recyclerView.setAdapter(adapter);
                                    adapter.notifyDataSetChanged();
                                    hidepDialog();
                                }
                                else {
                                    title.setText("No Items in This section");
                                    hidepDialog();
                                }
                            }
                            else{
                                hidepDialog();
                                //Toast.makeText(getActivity(),message,Toast.LENGTH_SHORT).show();
                                Utils.setAlertMsg(getActivity(),message,"Try again",false,true);

                            }


                        } catch (JSONException e) {
                            hidepDialog();
                            e.printStackTrace();
                            Utils.setAlertMsg(getActivity(),"DB error","Try again",false,true);

                            Log.e("Error Req", "Error: " + e.getMessage());
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        hidepDialog();
                        VolleyLog.d("valley ", "Error: " + error.getMessage());
                        Log.e("Error Req", "Error: " + error.getMessage());
                        Utils.setAlertMsg(getActivity(),"DB not Connected","Try again",false,true);

                        // hide the progress dialog

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("viewItems", "true");
                params.put("food_type", type);
                params.put("food_category", catg);
                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);
    }

    @Override
    public void onItemClick(View view, int position) {

    }
    private void showpDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hidepDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }
}
