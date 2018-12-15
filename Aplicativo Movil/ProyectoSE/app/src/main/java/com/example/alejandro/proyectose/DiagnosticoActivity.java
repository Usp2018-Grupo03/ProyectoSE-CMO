package com.example.alejandro.proyectose;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.RadioGroup;
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

public class DiagnosticoActivity extends AppCompatActivity {

    RequestQueue mREQUESTQUEUEENFERMEDAD;
    RequestQueue mREQUESTQUEUESINTOMA;
    RequestQueue mREQUESTQUEUETEMPORAL;
    RequestQueue mREQUESTQUEUEBORRAR;
    RequestQueue mREQUESTQUEUEGUARDARPUNTAJE;
    JsonRequest jrq;

    ArrayList<ClassPregunta> alistPREGUNTA;
    PreguntaAdaptador mADAPTADORPREGUNTA;
    RecyclerView rvLISTARPREGUNTA;
    RequestQueue mREQUESTQUEUELISTAR;
    Button BTNEVALUACION;

    Global g = new Global();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_diagnostico);

        mREQUESTQUEUEENFERMEDAD = Volley.newRequestQueue(this);
        mREQUESTQUEUESINTOMA = Volley.newRequestQueue(this);
        mREQUESTQUEUETEMPORAL = Volley.newRequestQueue(this);
        mREQUESTQUEUEBORRAR = Volley.newRequestQueue(this);
        mREQUESTQUEUEGUARDARPUNTAJE = Volley.newRequestQueue(this);

        alistPREGUNTA = new ArrayList<ClassPregunta>();
        rvLISTARPREGUNTA = (RecyclerView) findViewById(R.id.rvListarPregunta);
        rvLISTARPREGUNTA.setHasFixedSize(true);
        rvLISTARPREGUNTA.setLayoutManager(new LinearLayoutManager(this));
        mREQUESTQUEUELISTAR = Volley.newRequestQueue(this);
        BTNEVALUACION = (Button) findViewById(R.id.btnEvaluar);

        BTNEVALUACION.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                PROCESAR();

                Intent intencion = new Intent(getApplicationContext(), SumaActivity.class);
                startActivity(intencion);
            }
        });

        RecyclerPreguntas();
    }

    private void RecyclerPreguntas(){

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listarpregunta.php";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("pregunta");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject pregunta = jsonArray.getJSONObject(i);

                                String id_pregunta = pregunta.getString("id_pregunta");
                                String pre_titulo = pregunta.getString("pre_titulo");
                                String pre_descripcion = pregunta.getString("pre_descripcion");
                                String pre_imagen = pregunta.getString("pre_imagen");
                                String pre_fecha = pregunta.getString("pre_fecha");
                                String pre_estado = pregunta.getString("pre_estado");
                                String pre_puntaje = pregunta.getString("pre_puntaje");

                                alistPREGUNTA.add(new ClassPregunta(id_pregunta, pre_titulo, pre_descripcion, pre_imagen, pre_fecha, pre_estado, pre_puntaje));
                            }

                            mADAPTADORPREGUNTA = new PreguntaAdaptador(DiagnosticoActivity.this, alistPREGUNTA);
                            rvLISTARPREGUNTA.setAdapter(mADAPTADORPREGUNTA);

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

        mREQUESTQUEUELISTAR.add(request);
    }

    private void PROCESAR(){

        ENFERMEDAD();
    }

    private void GUARDARPUNTAJE(String enfermedad, String valor){

        String url = "http://"+ g.DIRECCION +"/proyectose-php/reg_puntajes.php" +
                "?pun_enfermedad="+ enfermedad +"" +
                "&pun_valor="+ valor +"";

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
    }

    private void PUNTAJE(final String id_pregunta, final int cantSintoma, final int cantPreguntas, final String enfermedad, final String id_enfermedad){

        /* -------------------------------------------------- Puntaje ---------------------------------------------------- */

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listartemporal.php?id_pregunta="+ id_pregunta +"";

        JsonObjectRequest request3 = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("temporal");

                            for (int k = 0; k < jsonArray.length(); k++) {
                                JSONObject temporal = jsonArray.getJSONObject(k);

                                String dpo_puntaje = temporal.getString("dpo_puntaje");

                                Log.d("asd", "----Puntaje para pregunta "+ id_pregunta +": " + dpo_puntaje);
                                Log.d("asd", "-----CantSintomas: " + String.valueOf(cantSintoma));
                                Log.d("asd", "-----CantPreguntas: " + String.valueOf(cantPreguntas));

                                double puntaje = (100/cantSintoma) * ((100/cantPreguntas) * Integer.parseInt(dpo_puntaje) / 100) / 100;

                                GUARDARPUNTAJE(enfermedad, String.valueOf(puntaje));
                            }
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

        mREQUESTQUEUETEMPORAL.add(request3);

        /* ----------------------------------------------------------------------------------------------------------- */
    };

    private void PREGUNTA(final String id_sintoma, final int cantSintoma, final String enfermedad, final String id_enfermedad){

        /* -------------------------------------------------- Preguntas ---------------------------------------------------- */

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listarsinpre.php?id_sintoma="+ id_sintoma +"";

        JsonObjectRequest request2 = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray2 = response.getJSONArray("sinpre");

                            Log.d("asd", "---Lista de Preguntas para id_sintoma: " + id_sintoma);
                            Log.d("asd", "---Cantidad de Preguntas: " + String.valueOf(jsonArray2.length()));

                            for (int j = 0; j < jsonArray2.length(); j++) {
                                JSONObject sinpre = jsonArray2.getJSONObject(j);

                                final String id_pregunta = sinpre.getString("id_pregunta");

                                Log.d("asd", "---id_pregunta: " + id_pregunta);

                                PUNTAJE(id_pregunta, cantSintoma, jsonArray2.length(), enfermedad, id_enfermedad);


                            }

                            Log.d("asd", "---Fin Preguntas");

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

        mREQUESTQUEUESINTOMA.add(request2);

        /* ----------------------------------------------------------------------------------------------------------- */
    };

    private void SINTOMA(final String id_enfermedad, final String enfermedad){

        /* -------------------------------------------------- Sintomas ---------------------------------------------------- */

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listarsintoma.php?id_enfermedad="+ id_enfermedad +"";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("sintoma");

                            Log.d("asd", "--Listando Sintomas");
                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject sintoma = jsonArray.getJSONObject(i);

                                final String id_sintoma = sintoma.getString("id_sintoma");

                                Log.d("asd", "--id_sintoma: " + id_sintoma);

                                PREGUNTA(id_sintoma, jsonArray.length(), enfermedad, id_enfermedad);
                            }

                            Log.d("asd", "--Fin Sintomas");

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

        /* ----------------------------------------------------------------------------------------------------------- */
    };

    private void ENFERMEDAD(){

        /* -------------------------------------------------- Enfermedades ---------------------------------------------------- */

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listarenfermedad.php";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("enfermedad");

                            Log.d("asd", "Listando Enfermedades");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject enfermedad = jsonArray.getJSONObject(i);

                                String id_enfermedad = enfermedad.getString("id_enfermedad");
                                String enf_nombre = enfermedad.getString("enf_nombre");

                                Log.d("asd", "Enfermedad: " + enf_nombre);

                                SINTOMA(id_enfermedad, enf_nombre);
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

        mREQUESTQUEUEENFERMEDAD.add(request);

        /* ----------------------------------------------------------------------------------------------------------- */
    };
}
