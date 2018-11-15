package com.example.alejandro.proyectose;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.view.animation.AlphaAnimation;
import android.widget.TextView;

public class Splash extends AppCompatActivity {
    private static int SPLASH_TIME_OUT = 3000;
    private static int DURACION = 800;
    private static int DESPUES = 800;
    TextView txtmensaje;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);


        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent homIntent = new Intent(Splash.this, ActivityMenu.class);
                startActivity(homIntent);
                finish();
            }
        }, SPLASH_TIME_OUT);


        txtmensaje = (TextView)findViewById(R.id.txtmensajego);

        AlphaAnimation fadeIn = new AlphaAnimation(0.0f,1.0f);
        fadeIn.setDuration(DURACION);
        fadeIn.setStartOffset(DESPUES);
        fadeIn.setFillAfter(true);


        txtmensaje.startAnimation(fadeIn);

    }

}
