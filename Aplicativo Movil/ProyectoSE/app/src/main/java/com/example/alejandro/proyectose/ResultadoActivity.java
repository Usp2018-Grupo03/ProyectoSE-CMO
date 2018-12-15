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

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class ResultadoActivity extends AppCompatActivity {

    RequestQueue mREQUESTQUEUEBORRAR;
    RequestQueue mREQUESTQUEUEDIAGNOSTICO;
    RequestQueue mREQUESTQUEUEGUARDARDIAGNOSTICOS;
    JsonRequest jrq;

    TextView txtUsuario;
    TextView txtEnfermedad;
    TextView txtPorcentaje;
    TextView txtFecha;
    Button btnProcesar;
    Button btnReiniciar;

    Global g = new Global();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_resultado);

        mREQUESTQUEUEBORRAR = Volley.newRequestQueue(this);
        mREQUESTQUEUEDIAGNOSTICO = Volley.newRequestQueue(this);
        mREQUESTQUEUEGUARDARDIAGNOSTICOS = Volley.newRequestQueue(this);

        txtUsuario = (TextView) findViewById(R.id.txtUsuario);
        txtEnfermedad = (TextView) findViewById(R.id.txtEnfermedad);
        txtPorcentaje = (TextView) findViewById(R.id.txtPorcentaje);
        txtFecha = (TextView) findViewById(R.id.txtFecha);
        btnProcesar = (Button) findViewById(R.id.btnProcesar);
        btnReiniciar = (Button) findViewById(R.id.btnReiniciar);

        MOSTRAR();

        MOSTRAR();

        MOSTRAR();

        btnProcesar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                GUARDAR();

                LIMPIAR();

                Intent intencion = new Intent(getApplicationContext(), ActivityMenu.class);
                startActivity(intencion);
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

    private String Fecha(){

        String fecha = "";

        Date hoy = new Date();
        DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        fecha = dateFormat.format(hoy);

        return fecha;
    }

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

                            txtFecha.setText(Fecha());
                            txtUsuario.setText(usuario);
                            txtEnfermedad.setText(enfermedad);
                            txtPorcentaje.setText(String.valueOf(porcentaje) + " %");

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

        mREQUESTQUEUEDIAGNOSTICO.add(request);
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

    private void GUARDAR(){

        String url = "http://"+ g.DIRECCION +"/proyectose-php/reg_diagnosticos.php" +
                "?dif_nombre="+ txtUsuario.getText() +"" +
                "&dif_enfermedad="+ txtEnfermedad.getText() +"" +
                "&dif_porcentaje="+ txtPorcentaje.getText() +"" +
                "&dif_fecha="+ Fecha() +"";

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

        mREQUESTQUEUEGUARDARDIAGNOSTICOS.add(jrq);
    }
}