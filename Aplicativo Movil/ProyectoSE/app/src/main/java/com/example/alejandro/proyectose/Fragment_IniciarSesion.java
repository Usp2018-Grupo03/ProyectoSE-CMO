package com.example.alejandro.proyectose;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
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

import java.util.HashMap;
import java.util.Map;

public class Fragment_IniciarSesion extends Fragment implements Response.Listener<JSONObject>, Response.ErrorListener {

    RequestQueue rq;
    RequestQueue requestQueue;
    JsonRequest jrq;
    EditText cajaUser, cajaPwd;
    Button btnConsultar;
    Button btnRegistrar;

    Global g = new Global();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View vista = inflater.inflate(R.layout.fragment_fragment__iniciar_sesion, container, false);

        cajaUser = (EditText) vista.findViewById(R.id.txtUser);
        cajaPwd = (EditText) vista.findViewById(R.id.txtPwd);
        btnConsultar = (Button) vista.findViewById(R.id.btnSesion);
        btnRegistrar = (Button) vista.findViewById(R.id.btnregistrar);

        rq = Volley.newRequestQueue(getContext());
        requestQueue = Volley.newRequestQueue(getContext());

        btnConsultar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                iniciarSesion();
            }
        });

        btnRegistrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                registrarUsuario();
            }
        });

        return vista;
    }

    @Override
    public void onErrorResponse(VolleyError error) {

        Toast.makeText(getContext(), "Usuario no encontrado. " +error.toString()+ cajaUser.getText().toString(), Toast.LENGTH_LONG).show();
    }

    @Override
    public void onResponse(JSONObject response) {

        ClassUsuario usuario = new ClassUsuario();
        JSONArray jsonArray = response.optJSONArray("datos");
        JSONObject jsonObject = null;

        try {

            jsonObject = jsonArray.getJSONObject(0);

            usuario.setUsuario(jsonObject.optString("usu_usuario"));
            usuario.setPassword(jsonObject.optString("usu_password"));
            usuario.setNombres(jsonObject.optString("usu_nombres"));
            usuario.setApellidos(jsonObject.optString("usu_apellidos"));
        } catch (JSONException e) {

            e.printStackTrace();
        }

        Intent intencion = new Intent(getContext(), ActivityMenu.class);
        intencion.putExtra("nombre", usuario.getNombres() + " " + usuario.getApellidos());
        startActivity(intencion);

        Toast.makeText(getContext(), "Bienvenido " + usuario.getNombres() + " " + usuario.getApellidos(), Toast.LENGTH_SHORT).show();
    }

    private void iniciarSesion(){

        String url = "http://"+ g.DIRECCION +"/proyectose-php/login.php?user="+cajaUser.getText().toString()+ "&pwd=" + cajaPwd.getText().toString() + "";
        jrq = new JsonObjectRequest(Request.Method.GET, url, null, this, this);
        rq.add(jrq);
    }

    private void registrarUsuario(){
        Fragment_RegistrarSesion fr=new Fragment_RegistrarSesion();

        getActivity().getSupportFragmentManager().beginTransaction()
                .replace(R.id.escenarioregistrar,fr)
                .addToBackStack(null)
                .commit();
    }
}
