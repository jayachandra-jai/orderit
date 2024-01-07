package com.example.jai.orderit.myfragments.tables;

import android.app.Fragment;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;

import android.support.annotation.Nullable;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.CustomerActivity;
import com.example.jai.orderit.HomeActivity;
import com.example.jai.orderit.LoginActivity;
import com.example.jai.orderit.R;
import com.example.jai.orderit.utils.AppController;
import com.example.jai.orderit.utils.SessionManager;
import com.example.jai.orderit.utils.Urls;
import com.example.jai.orderit.utils.Utils;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by KEERTHI on 02-03-2018.
 */

public class HomeFragment extends Fragment {

    View view;
    EditText cust_name;
    Button cust_login;
    private ProgressDialog pDialog;
    SessionManager sessionManager;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
// Inflate the layout for this fragment
        view = inflater.inflate(R.layout.main_home, container, false);
        return view;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        cust_name = view.findViewById(R.id.customer_name);
        cust_login=view.findViewById(R.id.cust_login);
        pDialog = new ProgressDialog(getActivity());
        sessionManager = new SessionManager(getActivity());
        Utils.hideKeyBoard(getActivity());


        pDialog.setMessage("Please wait...");
        pDialog.setCancelable(false);
        cust_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loginCustomer();
            }
        });

    }

    private void loginCustomer() {
        showpDialog();
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        //Log.d("res", response.toString());
                        hidepDialog();
                        try {
                            JSONObject jsonresponse = new JSONObject(response);
                            String message = jsonresponse.getString("message");
                            if (!jsonresponse.getBoolean("error")) {

                                sessionManager.createCustomerLogin(jsonresponse.getString("order_id"),cust_name.getText()+"");
                                Toast.makeText(getContext(),message,Toast.LENGTH_SHORT).show();

                                startActivity(new Intent(getActivity(),CustomerActivity.class));
                                getActivity().finish();

                            }
                            else{
                                Utils.setAlertMsg(getActivity(),message,"Try again",false,true);
                            }



                        } catch (JSONException e) {
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
                        Utils.setAlertMsg(getActivity(),"DB Not Connected","Try again",false,true);

                        // hide the progress dialog

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("customerLogin", "true");
                params.put("tab_id", ""+sessionManager.getTableId());
                params.put("cust_name", ""+cust_name.getText());
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
