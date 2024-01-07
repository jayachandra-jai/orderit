package com.example.jai.orderit.myfragments.items;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
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

public class OffersFragment extends Fragment implements CustomItemAdapter.ItemClickListener {
    View view;
    TextView title;
    RecyclerView recyclerView;
    CustomItemAdapter adapter;

    List<ItemModel> list;
    CounterFab fab;
    private ProgressDialog pDialog;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
// Inflate the layout for this fragment
        view = inflater.inflate(R.layout.offers_fragment, container, false);
        return view;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        recyclerView=view.findViewById(R.id.offersview);
        getActivity().setTitle(new SessionManager(getActivity()).getCustomerName());
        title=view.findViewById(R.id.offer_title);
        pDialog = new ProgressDialog(getActivity());
        pDialog.setMessage("Please wait.....");
        recyclerView.setLayoutManager(new LinearLayoutManager(getActivity(), LinearLayoutManager.VERTICAL, false));
        list=new ArrayList<>();
        adapter=new CustomItemAdapter(list,this,fab);
        getallItems("Veg","Offers");
        recyclerView.setAdapter(adapter);
        adapter.notifyDataSetChanged();
        fab=getActivity().findViewById(R.id.fab);
//        recyclerView.addOnItemTouchListener(new RecyclerItemClickListener(getActivity(), new RecyclerItemClickListener.OnItemClickListener() {
//            @Override
//            public void onItemClick(View view, int position) {
//
//            }
//        }));
    }

    @Override
    public void onItemClick(View view, int position) {

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
                                JSONArray itemsJson=jsonresponse.getJSONArray("items_info");
                                Log.d("Array",itemsJson.toString());
                                if(jsonresponse.getInt("items_count")!=0) {
                                    GsonBuilder builder = new GsonBuilder();
                                    Gson mGson = builder.create();

                                    list = Arrays.asList(mGson.fromJson(itemsJson.toString(), ItemModel[].class));
                                    adapter = new CustomItemAdapter(list, OffersFragment.this, fab);
                                    recyclerView.setAdapter(adapter);
                                    adapter.notifyDataSetChanged();
                                    hidepDialog();
                                }
                                else {
                                    title.setText("No offers for Today");
                                    hidepDialog();
                                }
                            }
                            else{
                                hidepDialog();
                                Utils.setAlertMsg(getActivity(),message,"Try again",false,true);

                            }


                        } catch (JSONException e) {
                            hidepDialog();
                            e.printStackTrace();
                            Log.e("Error Req", "Error: " + e.getMessage());
                            Utils.setAlertMsg(getActivity(),"DB Error","Try again",false,true);

                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        hidepDialog();
                        VolleyLog.d("valley ", "Error: " + error.getMessage());
                        Utils.setAlertMsg(getActivity(),"DB not Connected","Try again",false,true);

                        Log.e("Error Req", "Error: " + error.getMessage());
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
    private void showpDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hidepDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }
}
