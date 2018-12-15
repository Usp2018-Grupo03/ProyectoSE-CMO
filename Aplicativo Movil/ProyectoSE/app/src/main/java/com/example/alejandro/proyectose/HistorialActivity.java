package com.example.alejandro.proyectose;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class HistorialActivity extends AppCompatActivity {

    ArrayList<ClassDiagnostico> alistHISTORIAL;
    HistorialAdaptador mADAPTADORHISTORIAL;
    RecyclerView rvLISTARHISTORIAL;
    RequestQueue mREQUESTQUEUELISTAR;

    Global g = new Global();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_historial);

        alistHISTORIAL = new ArrayList<ClassDiagnostico>();
        rvLISTARHISTORIAL = (RecyclerView) findViewById(R.id.rvListarDiagnostico);
        rvLISTARHISTORIAL.setHasFixedSize(true);
        rvLISTARHISTORIAL.setLayoutManager(new LinearLayoutManager(this));
        mREQUESTQUEUELISTAR = Volley.newRequestQueue(this);

        RecyclerDiagnostico();
    }

    private void RecyclerDiagnostico(){

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listardiagnosticos.php";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("diagnosticofinal");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject diagnosticofinal = jsonArray.getJSONObject(i);

                                String id_diagnosticofinal = diagnosticofinal.getString("id_diagnosticofinal");
                                String dif_nombre = diagnosticofinal.getString("dif_nombre");
                                String dif_enfermedad = diagnosticofinal.getString("dif_enfermedad");
                                String dif_porcentaje = diagnosticofinal.getString("dif_porcentaje");
                                String dif_fecha = diagnosticofinal.getString("dif_fecha");

                                alistHISTORIAL.add(new ClassDiagnostico(id_diagnosticofinal, dif_nombre, dif_enfermedad, dif_porcentaje, dif_fecha));
                            }

                            mADAPTADORHISTORIAL = new HistorialAdaptador(HistorialActivity.this, alistHISTORIAL);
                            rvLISTARHISTORIAL.setAdapter(mADAPTADORHISTORIAL);

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
}
