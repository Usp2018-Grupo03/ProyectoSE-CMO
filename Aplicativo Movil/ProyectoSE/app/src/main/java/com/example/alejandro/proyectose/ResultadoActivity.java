package com.example.alejandro.proyectose;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
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

import java.util.ArrayList;
import java.util.List;

public class ResultadoActivity extends AppCompatActivity {

    RequestQueue mREQUESTQUEUEENFERMEDAD;
    RequestQueue mREQUESTQUEUESINTOMA;
    RequestQueue mREQUESTQUEUETEMPORAL;
    RequestQueue mREQUESTQUEUESUMA;
    RequestQueue mREQUESTQUEUEPUNTAJES;
    RequestQueue mREQUESTQUEUEBORRAR;
    RequestQueue mREQUESTQUEUEGUARDARPUNTAJE;
    JsonRequest jrq;

    TextView txtUsuario;
    TextView txtEnfermedad;
    TextView txtPorcentaje;
    Button btnProcesar;
    Button btnReiniciar;

    Global g = new Global();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_resultado);

        mREQUESTQUEUEENFERMEDAD = Volley.newRequestQueue(this);
        mREQUESTQUEUESINTOMA = Volley.newRequestQueue(this);
        mREQUESTQUEUETEMPORAL = Volley.newRequestQueue(this);
        mREQUESTQUEUESUMA = Volley.newRequestQueue(this);
        mREQUESTQUEUEBORRAR = Volley.newRequestQueue(this);
        mREQUESTQUEUEGUARDARPUNTAJE = Volley.newRequestQueue(this);
        mREQUESTQUEUEPUNTAJES = Volley.newRequestQueue(this);

        txtUsuario = (TextView) findViewById(R.id.txtUsuario);
        txtEnfermedad = (TextView) findViewById(R.id.txtEnfermedad);
        txtPorcentaje = (TextView) findViewById(R.id.txtPorcentaje);
        btnProcesar = (Button) findViewById(R.id.btnProcesar);
        btnReiniciar = (Button) findViewById(R.id.btnReiniciar);

        SUMA();
        MOSTRAR();

        btnProcesar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                SUMA();
                MOSTRAR();
            }
        });

        btnReiniciar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                LIMPIAR();

                Intent intencion = new Intent(getApplicationContext(), ActivityMenu.class);
                startActivity(intencion);
            }
        });
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
    };

    private void MOSTRAR(){

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listardiagnostico.php";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("diagnostico");

                            Log.d("asd", "Listando Enfermedades");

                            String enfermedad = "";
                            String usuario = "";
                            double porcentaje = 0;

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject diagnostico = jsonArray.getJSONObject(i);

                                String dia_porcentaje = diagnostico.getString("dia_porcentaje");
                                String dia_enfermedad = diagnostico.getString("dia_enfermedad");
                                String usu_nombres = diagnostico.getString("usu_nombres");

                                if (Double.parseDouble(dia_porcentaje) > porcentaje){

                                    porcentaje = Double.parseDouble(dia_porcentaje);
                                    enfermedad = dia_enfermedad;
                                    usuario = usu_nombres;
                                }
                            }

                            txtUsuario.setText(usuario);
                            txtEnfermedad.setText(enfermedad);
                            txtPorcentaje.setText(String.valueOf(porcentaje));

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

        mREQUESTQUEUEENFERMEDAD.add(request);
    }

    private void LIMPIAR(){

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/limpiar.php";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
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

        mREQUESTQUEUEBORRAR.add(request);
    }
}