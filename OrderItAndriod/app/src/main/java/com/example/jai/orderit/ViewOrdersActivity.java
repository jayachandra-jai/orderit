package com.example.jai.orderit;

import android.app.ProgressDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.adapters.order.OrderAdapter;
import com.example.jai.orderit.adapters.order.OrderModel;
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

public class ViewOrdersActivity extends AppCompatActivity {
    RecyclerView order_view;
    TextView total,cust_name,cust_id,tab_name;
    OrderAdapter adapter;
    List<OrderModel> list;
    ImageView back;
    SessionManager sessionManager;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_orders);
        list=new ArrayList<>();
        adapter=new OrderAdapter(list);
        pDialog = new ProgressDialog(ViewOrdersActivity.this);
        cust_id=findViewById(R.id.cust_id);
        cust_name=findViewById(R.id.cust_name);
        tab_name=findViewById(R.id.tab_name);
        sessionManager=new SessionManager(ViewOrdersActivity.this);
        order_view=findViewById(R.id.view_in_order);
        order_view.setLayoutManager(new LinearLayoutManager(ViewOrdersActivity.this, LinearLayoutManager.VERTICAL, false));
        order_view.setAdapter(adapter);
        back=findViewById(R.id.back_order);
        total=findViewById(R.id.tv_all_amount);
        cust_id.setText(sessionManager.getOrderId());
        cust_name.setText(sessionManager.getCustomerName());
        tab_name.setText(sessionManager.getTableName());
        total.setText("Rs. 0/-");
        orderitems();
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }
    private void orderitems() {
        pDialog.setMessage("Generating....");
        showpDialog();
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        hidepDialog();

                        //Log.d("res", response.toString());

                        try {
                            JSONObject jsonresponse = new JSONObject(response);

                            if (!jsonresponse.getBoolean("error")){

                                JSONArray itemsJson=jsonresponse.getJSONArray("order_info");
                                Log.d("msg",jsonresponse.getString("message"));
                                GsonBuilder builder = new GsonBuilder();
                                Gson mGson = builder.create();

                                list = Arrays.asList(mGson.fromJson(itemsJson.toString(), OrderModel[].class));
                                Log.d("list",""+list.size());
                                adapter = new OrderAdapter(list);
                                order_view.setAdapter(adapter);
                                total.setText("Rs. "+jsonresponse.getString("total_bill")+"/-");
                                adapter.notifyDataSetChanged();
                            }
                            else {
                                Log.d("msg",jsonresponse.getString("message"));
                                Utils.setAlertMsg(ViewOrdersActivity.this,jsonresponse.getString("No Orders yet"),"Ok",false,true);

                            }


                        } catch (JSONException e) {
                            hidepDialog();
                            e.printStackTrace();
                            Utils.setAlertMsg(ViewOrdersActivity.this,"No Orders yet","Ok",false,true);

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
                        Utils.setAlertMsg(ViewOrdersActivity.this,"DB Not Connected","Try again",false,true);


                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("viewOrder", "true");
                params.put("order_id", sessionManager.getOrderId());
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
