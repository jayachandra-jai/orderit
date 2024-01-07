package com.example.jai.orderit;

import android.app.ProgressDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.adapters.ratings.MyRating;
import com.example.jai.orderit.adapters.ratings.RateAdapter;
import com.example.jai.orderit.adapters.ratings.ReviewItem;
import com.example.jai.orderit.utils.AppController;
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

public class CheckOutActivity extends AppCompatActivity {
    RecyclerView rate_view;
    RateAdapter adapter;
    List<ReviewItem> list;
    Button check;
    SessionManager sessionManager;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_check_out);
        list=new ArrayList<>();
        adapter=new RateAdapter(list);
        pDialog = new ProgressDialog(CheckOutActivity.this);

        sessionManager=new SessionManager(CheckOutActivity.this);
        rate_view=findViewById(R.id.view_in_rate);
        rate_view.setLayoutManager(new LinearLayoutManager(CheckOutActivity.this, LinearLayoutManager.VERTICAL, false));
        rate_view.setAdapter(adapter);
        check=findViewById(R.id.but_check_out);
        rateitems();
        check.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                pDialog.setMessage("Checkout Processing.....");
                showpDialog();
                for (MyRating rate: ReviewItem.rates) {
                    updateRate(rate.getItem_id(),rate.getRatting());
                }

                checkOut();
                ReviewItem.rates.clear();
            }
        });
    }

    private void rateitems() {
        pDialog.setMessage("Loading.....");
        showpDialog();
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        hidepDialog();

                        Log.d("res", response.toString());

                        try {
                            JSONObject jsonresponse = new JSONObject(response);

                            if (!jsonresponse.getBoolean("error")){

                                JSONArray itemsJson=jsonresponse.getJSONArray("review_info");
                                Log.d("msg",jsonresponse.getString("message"));
                                GsonBuilder builder = new GsonBuilder();
                                Gson mGson = builder.create();

                                list = Arrays.asList(mGson.fromJson(itemsJson.toString(), ReviewItem[].class));
                                Log.d("list",""+list.size());
                                adapter = new RateAdapter(list);
                                rate_view.setAdapter(adapter);
                                adapter.notifyDataSetChanged();
                            }
                            else {
                                Log.d("msg",jsonresponse.getString("message"));
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
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
                        // hide the progress dialog

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("reviewItems", "true");
                params.put("order_id", sessionManager.getOrderId());
                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);
    }
    private void updateRate(final String item_id, final String rate) {
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        Log.d("res", response.toString());

                        try {
                            JSONObject jsonresponse = new JSONObject(response);

                            if (!jsonresponse.getBoolean("error")){

                                Log.d("msg",jsonresponse.getString("message"));
                            }
                            else {
                                Log.d("msg",jsonresponse.getString("message"));
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
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
                        // hide the progress dialog

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("updateReview", "true");
                params.put("item_id",item_id);
                params.put("review_value", rate);
                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);

    }
    private void checkOut() {
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                                    hidepDialog();
                        Log.d("res", response.toString());

                        try {
                            JSONObject jsonresponse = new JSONObject(response);

                            if (!jsonresponse.getBoolean("error")){
                                sessionManager.logoutCustomer();
                                //Utils.setAlertMsg(CheckOutActivity.this,"Thank you Visit Again","OK",true,true);
                                Toast.makeText(CheckOutActivity.this,"Thank you Visit Again",Toast.LENGTH_SHORT).show();
                                Log.d("msg",jsonresponse.getString("message"));

                            }
                            else {
                                Log.d("msg",jsonresponse.getString("message"));
                                Utils.setAlertMsg(CheckOutActivity.this,"DB error","Try again",false,true);

                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Log.e("Error Req", "Error: " + e.getMessage());
                            Utils.setAlertMsg(CheckOutActivity.this,"DB error","Try again",false,true);

                        }


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        hidepDialog();
                        VolleyLog.d("valley ", "Error: " + error.getMessage());
                        Log.e("Error Req", "Error: " + error.getMessage());
                        // hide the progress dialog
                        Utils.setAlertMsg(CheckOutActivity.this,"DB not Connected","Try again",false,true);

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("checkoutUser", "true");
                params.put("tab_id", sessionManager.getTableId());
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
