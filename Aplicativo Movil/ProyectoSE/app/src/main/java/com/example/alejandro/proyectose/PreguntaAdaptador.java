package com.example.alejandro.proyectose;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import java.util.ArrayList;

public class PreguntaAdaptador extends RecyclerView.Adapter<PreguntaAdaptador.ClassPreguntaViewHolder> {

    private Context mContext;
    private ArrayList<ClassPregunta> alisPREGUNTAS;

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

        ClassPregunta ITEMACTUAL = alisPREGUNTAS.get(position);

        String TITULO = ITEMACTUAL.getPre_titulo();

        holder.txtTitulo.setText(TITULO);
        Glide.with( mContext ).load( alisPREGUNTAS.get( position ).getPre_imagen() ).into( holder.txtImagen );
    }

    @Override
    public int getItemCount() {
        return alisPREGUNTAS.size();
    }

    public class ClassPreguntaViewHolder extends RecyclerView.ViewHolder{

        public ImageView txtImagen;
        public TextView txtTitulo;

        public ClassPreguntaViewHolder(View itemView) {
            super(itemView);

            txtImagen = itemView.findViewById(R.id.imgPregunta);
            txtTitulo = itemView.findViewById(R.id.txtTitulo);
        }
    }
}
