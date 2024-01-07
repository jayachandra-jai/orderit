package com.example.jai.orderit;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.example.jai.orderit.adapters.cart.CartItem;
import com.example.jai.orderit.utils.DatabaseHandler;
import com.michaelmuenzer.android.scrollablennumberpicker.ScrollableNumberPicker;
import com.michaelmuenzer.android.scrollablennumberpicker.ScrollableNumberPickerListener;

public class ItemActivity extends AppCompatActivity {
    TextView item_title,item_price,item_total,item_description,item_ratings,item_views;
    ImageView item_pic,item_type,back;
    ScrollableNumberPicker item_count;
    RatingBar item_rattings_bar;
    Button add_to_cart;
    DatabaseHandler mycart;
    Bundle bundle;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item);
         bundle = getIntent().getExtras();
        item_title=findViewById(R.id.item_title);
        item_price=findViewById(R.id.item_price);
        item_total=findViewById(R.id.item_total);
        item_description=findViewById(R.id.item_description);
        item_ratings=findViewById(R.id.item_ratings);
        item_views=findViewById(R.id.item_views);
        item_pic=findViewById(R.id.item_pic);
        item_type=findViewById(R.id.item_type);
        mycart=new DatabaseHandler(this);
        item_count=findViewById(R.id.item_count);
        item_rattings_bar=findViewById(R.id.item_rattings_bar);
        add_to_cart=findViewById(R.id.add_to_cart);
        back=findViewById(R.id.item_back);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        Glide.with(getApplicationContext())
                .load(bundle.getString("Item_Pic"))
                .into(item_pic);

        item_title.setText(bundle.getString("Item_Title"));
        item_price.setText("Rs. "+bundle.getString("Item_Price"));
        item_total.setText("Rs. "+bundle.getString("Item_Price")+"/-");
        item_description.setText(bundle.getString("Item_Description").trim());
        item_ratings.setText(bundle.getString("Item_Rating"));
        item_views.setText(bundle.getString("Item_Views"));

        item_count.setValue(1);
        item_count.setListener(new ScrollableNumberPickerListener() {
            @Override
            public void onNumberPicked(int value) {
                Float price=Float.parseFloat(bundle.getString("Item_Price"));
                item_total.setText("Rs. "+String.format("%1.2f", price*value)+"/-");
            }
        });
        if(bundle.getString("Item_Type").equals("Veg")){
            item_type.setImageResource(R.drawable.veg);
        }
        else {
            item_type.setImageResource(R.drawable.nonveg);
        }
        item_rattings_bar.setRating(Float.parseFloat(bundle.getString("Item_Rating")));
        add_to_cart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mycart.addItem(new CartItem(bundle.getString("Item_Id"),bundle.getString("Item_Title"),Double.parseDouble(bundle.getString("Item_Price")),item_count.getValue()));
                finish();
            }
        });
    }
}
