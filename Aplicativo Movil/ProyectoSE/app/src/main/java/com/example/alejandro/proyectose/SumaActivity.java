package com.example.alejandro.proyectose;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.CountDownTimer;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class SumaActivity extends AppCompatActivity {

    RequestQueue mREQUESTQUEUESUMA;
    RequestQueue mREQUESTQUEUEPUNTAJES;
    RequestQueue mREQUESTQUEUEGUARDARPUNTAJE;
    JsonRequest jrq;

    Global g = new Global();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_suma);

        mREQUESTQUEUESUMA = Volley.newRequestQueue(this);
        mREQUESTQUEUEGUARDARPUNTAJE = Volley.newRequestQueue(this);
        mREQUESTQUEUEPUNTAJES = Volley.newRequestQueue(this);

        final ProgressDialog TempDialog;
        CountDownTimer CDT;
        final int[] i = {5};

        TempDialog = new ProgressDialog(SumaActivity.this);
        TempDialog.setMessage("Procesando datos...");
        TempDialog.setCancelable(false);
        TempDialog.setProgress(i[0]);
        TempDialog.show();

        CDT = new CountDownTimer(5000, 1000)
        {
            public void onTick(long millisUntilFinished)
            {
                TempDialog.setMessage("Procesando datos.." + i[0] + " s");
                i[0]--;
            }

            public void onFinish()
            {
                TempDialog.dismiss();

                SUMA();

                Intent intencion = new Intent(getApplicationContext(), ResultadoActivity.class);
                startActivity(intencion);
            }
        }.start();
    }

    private void SUMA(){

        /* -------------------------------------------------- Suma ---------------------------------------------------- */

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listarenfermedad.php";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("enfermedad");

                            Log.d("asd", "Listando Enfermedades");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                final JSONObject enfermedad = jsonArray.getJSONObject(i);

                                final String id_enfermedad = enfermedad.getString("id_enfermedad");
                                final String enf_nombre = enfermedad.getString("enf_nombre");

                                /* -------------------------------------------------- Puntajes ---------------------------------------------------- */

                                String URL = "http://"+ g.DIRECCION +"/proyectose-php/listarpuntaje.php?enf_nombre="+ enf_nombre +"";

                                JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                                        new Response.Listener<JSONObject>(){
                                            @Override
                                            public void onResponse(JSONObject response) {
                                                try {
                                                    JSONArray jsonArray = response.getJSONArray("puntaje");

                                                    Log.d("asd", "Listando Enfermedades");

                                                    double parcial = 0;
                                                    double subtotal = 0;

                                                    for (int i = 0; i < jsonArray.length(); i++) {

                                                        JSONObject puntaje = jsonArray.getJSONObject(i);

                                                        String pun_valor = puntaje.getString("pun_valor");

                                                        parcial = parcial + Double.parseDouble(pun_valor);
                                                    }

                                                    String url = "http://"+ g.DIRECCION +"/proyectose-php/reg_diagnostico.php?dia_porcentaje="+ parcial +"&id_usuario=1&id_enfermedad="+ enf_nombre +"";

                                                    jrq = new JsonObjectRequest(Request.Method.GET, url, null,
                                                            new Response.Listener<JSONObject>(){
                                                                @Override
                                                                public void onResponse(JSONObject response) {

                                                                }
                                                            }, new Response.ErrorListener() {
                                                        @Override
                                                        public void onErrorResponse(VolleyError error) {
                                                            error.printStackTrace();
                                                        }
                                                    });

                                                    mREQUESTQUEUEGUARDARPUNTAJE.add(jrq);

                                                    Log.d("asd", "Fin Enfermedades");

                                                } catch (JSONException e) {
                                                    e.printStackTrace();
                                                }
                                            }
                                        }, new Response.ErrorListener() {
                                    @Override
                                    public void onErrorResponse(VolleyError error) {
                                        error.printStackTrace();
                                    }
                                });

                                mREQUESTQUEUEPUNTAJES.add(request);

                                /* ----------------------------------------------------------------------------------------------------------- */
                            }

                            Log.d("asd", "Fin Enfermedades");

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });

        mREQUESTQUEUESUMA.add(request);

        /* ----------------------------------------------------------------------------------------------------------- */
    }
}
