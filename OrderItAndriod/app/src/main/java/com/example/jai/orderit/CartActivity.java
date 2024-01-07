package com.example.jai.orderit;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.adapters.cart.CartAdapter;
import com.example.jai.orderit.adapters.cart.CartItem;
import com.example.jai.orderit.utils.AppController;
import com.example.jai.orderit.utils.DatabaseHandler;
import com.example.jai.orderit.utils.SessionManager;
import com.example.jai.orderit.utils.Urls;
import com.example.jai.orderit.utils.Utils;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class CartActivity extends AppCompatActivity {
    DatabaseHandler mycart;
    RecyclerView cart_view;
    TextView total;
    CartAdapter adapter;
    ImageView back;
    Button orderNow;
    SessionManager sessionManager;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);
        total=findViewById(R.id.tv_amount);
        mycart=new DatabaseHandler(CartActivity.this);
        pDialog = new ProgressDialog(CartActivity.this);

        sessionManager=new SessionManager(CartActivity.this);
        cart_view=findViewById(R.id.view_in_cart);
        back=findViewById(R.id.back_cart);
        orderNow=findViewById(R.id.but_order);
        cart_view.setLayoutManager(new LinearLayoutManager(CartActivity.this, LinearLayoutManager.VERTICAL, false));
        adapter=new CartAdapter(mycart.getAllCartItems(),total);
        cart_view.setAdapter(adapter);
        total.setText(String.format("%1.2f", mycart.getCartTotal()));
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                hidepDialog();
                finish();
            }
        });
        orderNow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                pDialog.setMessage("Loading.....");
                showpDialog();

                if(mycart.getCartSize()!=0){
                    checkStatus(sessionManager.getTableId());

                }else {
                    hidepDialog();
                    Utils.setAlertMsg(CartActivity.this,"No items in Cart","OK",false,true);

                }


            }
        });

    }

    private void insertIteminDB(final String item_id, final String order_id, final String quantity) {
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
                                    hidepDialog();
                                    Log.d("msg",jsonresponse.getString("message"));
                                    Utils.setAlertMsg(CartActivity.this,"DB error","OK",false,true);


                                }


                        } catch (JSONException e) {
                            hidepDialog();
                            e.printStackTrace();
                            Log.e("Error Req", "Error: " + e.getMessage());
                            Utils.setAlertMsg(CartActivity.this,"DB error","OK",false,true);

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
                        Utils.setAlertMsg(CartActivity.this,"DB not connected","OK",false,true);


                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("insertItem", "true");
                params.put("order_id", order_id);
                params.put("item_id", item_id);
                params.put("quantity", quantity);
                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);
    }
    private void orderNow( final String order_id, final String tab_id) {

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
                                Log.d("msg",jsonresponse.getString("message"));
                                Utils.setAlertMsg(CartActivity.this,jsonresponse.getString("message"),"OK",true,true);

                            }
                            else {
                                Utils.setAlertMsg(CartActivity.this,jsonresponse.getString("message"),"OK",false,true);

                                Log.d("msg",jsonresponse.getString("message"));
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Utils.setAlertMsg(CartActivity.this,"DB error","Try again",false,true);

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
                        Utils.setAlertMsg(CartActivity.this,"DB Not connected","Try again",false,true);


                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("orderNow", "true");
                params.put("order_id", order_id);
                params.put("tab_id", tab_id);
                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);
    }

    private void checkStatus(final String tab_id) {

        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        hidepDialog();
                        Log.d("sta res", response.toString());

                        try {
                            JSONObject jsonresponse = new JSONObject(response);
                            if (!jsonresponse.getBoolean("error")){
                                if(jsonresponse.getBoolean("isActive")){
                                    List<CartItem> items= mycart.getAllCartItems();
                                    for (CartItem item:items) {
                                        insertIteminDB(""+item.getItem_id(),sessionManager.getOrderId(),item.getQunatity()+"");
                                    }

                                    orderNow(sessionManager.getOrderId(),sessionManager.getTableId());
                                    mycart.deleteAllItems();
                                }
                                else {
                                    AlertDialog.Builder alertDialog = new AlertDialog.Builder(CartActivity.this);

                                    // Setting Dialog Title
                                    alertDialog.setTitle("Sorry...");

                                    // Setting Dialog Message
                                    alertDialog.setMessage(jsonresponse.getString("message"));
                                    alertDialog.setCancelable(false);
                                    // Setting Positive "Yes" Button
                                    alertDialog.setPositiveButton("YES", new DialogInterface.OnClickListener() {
                                        public void onClick(DialogInterface dialog,int which) {
                                            mycart.deleteAllItems();
                                            sessionManager.logoutCustomer();
                                            sessionManager.logoutUser();
                                        }
                                    });

                                    // Showing Alert Message
                                    alertDialog.show();
                                }

                            }
                            else {
                                Utils.setAlertMsg(CartActivity.this,jsonresponse.getString("message"),"OK",false,true);

                                Log.d("msg",jsonresponse.getString("message"));
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Utils.setAlertMsg(CartActivity.this,"DB error","Try again",false,true);

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
                        Utils.setAlertMsg(CartActivity.this,"DB Not connected","Try again",false,true);


                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("tableStatus", "true");
                params.put("tab_id", tab_id);
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
