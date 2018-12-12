package com.example.alejandro.proyectose;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class PreguntaAdaptador extends RecyclerView.Adapter<PreguntaAdaptador.ClassPreguntaViewHolder> {

    private Context mContext;
    private ArrayList<ClassPregunta> alisPREGUNTAS;
    RequestQueue mREQUESTQUEUEOPCIONES;
    RadioGroup rgOpciones;
    RadioButton rb;
    RadioGroup.LayoutParams rgLP;
    JsonRequest jrq;
    RequestQueue mREQUESTQUEUEPUNTAJE;

    Global g = new Global();

    public PreguntaAdaptador(Context mContext, ArrayList<ClassPregunta> alisPREGUNTAS) {
        this.mContext = mContext;
        this.alisPREGUNTAS = alisPREGUNTAS;
    }

    @NonNull
    @Override
    public ClassPreguntaViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View v = LayoutInflater.from(mContext).inflate(R.layout.item_pregunta, parent, false);
        return new ClassPreguntaViewHolder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull ClassPreguntaViewHolder holder, int position) {

        holder.layout.removeAllViews();
        ClassPregunta ITEMACTUAL = alisPREGUNTAS.get(position);

        String TITULO = ITEMACTUAL.getPre_titulo();
        String ID = ITEMACTUAL.getId_pregunta();

        holder.txtTitulo.setText(TITULO);
        Glide.with( mContext ).load( alisPREGUNTAS.get( position ).getPre_imagen() ).into( holder.txtImagen );

        mREQUESTQUEUEOPCIONES = Volley.newRequestQueue(mContext);
        mREQUESTQUEUEPUNTAJE = Volley.newRequestQueue(mContext);
        rgOpciones = new RadioGroup(mContext);
        rgOpciones.setOrientation(RadioGroup.VERTICAL);
        rgLP= new RadioGroup.LayoutParams(RadioGroup.LayoutParams.MATCH_PARENT, RadioGroup.LayoutParams.MATCH_PARENT);

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listaropcion.php?id_pregunta="+ ID +"";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("opcion");

                            rgOpciones.removeAllViewsInLayout();
                            rgOpciones.removeAllViews();

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject opcion = jsonArray.getJSONObject(i);

                                final String dpo_puntaje = opcion.getString("dpo_puntaje");
                                String opc_titulo = opcion.getString("opc_titulo");
                                final String id_pregunta = opcion.getString("id_pregunta");

                                rb = new RadioButton(mContext);
                                rb.setText(opc_titulo);
                                rb.setOnClickListener(new View.OnClickListener() {
                                    @Override
                                    public void onClick(View v) {

                                        String url = "http://"+ g.DIRECCION +"/proyectose-php/reg_puntaje.php" +
                                                "?id_pregunta="+ id_pregunta +"" +
                                                "&dpo_puntaje="+ dpo_puntaje +"";

                                        jrq = new JsonObjectRequest(Request.Method.GET, url, null,
                                                new Response.Listener<JSONObject>(){
                                                    @Override
                                                    public void onResponse(JSONObject response) {

                                                        Toast.makeText(mContext, "Opción guardada.", Toast.LENGTH_SHORT).show();
                                                    }
                                                }, new Response.ErrorListener() {
                                            @Override
                                            public void onErrorResponse(VolleyError error) {
                                                error.printStackTrace();
                                            }
                                        });
                                        mREQUESTQUEUEPUNTAJE.add(jrq);
                                    }
                                });
                                rgOpciones.addView(rb, rgLP);
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

        mREQUESTQUEUEOPCIONES.add(request);
        holder.layout.addView(rgOpciones);
    }

    @Override
    public int getItemCount() {
        return alisPREGUNTAS.size();
    }

    public class ClassPreguntaViewHolder extends RecyclerView.ViewHolder{

        public ImageView txtImagen;
        public TextView txtTitulo;
        public LinearLayout layout;

        public ClassPreguntaViewHolder(View itemView) {
            super(itemView);

            txtImagen = itemView.findViewById(R.id.imgPregunta);
            txtTitulo = itemView.findViewById(R.id.txtTitulo);
            layout = itemView.findViewById(R.id.listaopciones);
        }
    }
}
