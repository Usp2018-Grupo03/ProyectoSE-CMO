package com.example.alejandro.proyectose;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.ArrayList;

public class HistorialAdaptador extends RecyclerView.Adapter<HistorialAdaptador.ClassDiagnosticoViewHolder>{

    private Context mContext;
    private ArrayList<ClassDiagnostico> alisDIAGNOSTICOS;

    public HistorialAdaptador(Context mContext, ArrayList<ClassDiagnostico> alisDIAGNOSTICOS) {
        this.mContext = mContext;
        this.alisDIAGNOSTICOS = alisDIAGNOSTICOS;
    }

    @NonNull
    @Override
    public HistorialAdaptador.ClassDiagnosticoViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View v = LayoutInflater.from(mContext).inflate(R.layout.item_historial, parent, false);
        return new HistorialAdaptador.ClassDiagnosticoViewHolder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull HistorialAdaptador.ClassDiagnosticoViewHolder holder, int position) {

        ClassDiagnostico ITEMACTUAL = alisDIAGNOSTICOS.get(position);

        String dif_nombre = ITEMACTUAL.getDif_nombre();
        String dif_enfermedad = ITEMACTUAL.getDif_enfermedad();
        String dif_porcentaje = ITEMACTUAL.getDif_porcentaje();
        String dif_fecha = ITEMACTUAL.getDif_fecha();

        holder.txtUsuarioDiag.setText(dif_nombre);
        holder.txtEnfermedadDiag.setText(dif_enfermedad);
        holder.txtPorcentajeDiag.setText(dif_porcentaje);
        holder.txtFechaDiag.setText(dif_fecha);
    }

    @Override
    public int getItemCount() {
        return alisDIAGNOSTICOS.size();
    }

    public class ClassDiagnosticoViewHolder extends RecyclerView.ViewHolder{

        public TextView txtUsuarioDiag;
        public TextView txtEnfermedadDiag;
        public TextView txtPorcentajeDiag;
        public TextView txtFechaDiag;

        public ClassDiagnosticoViewHolder(View itemView) {
            super(itemView);

            txtUsuarioDiag = itemView.findViewById(R.id.txtUsuarioDiag);
            txtEnfermedadDiag = itemView.findViewById(R.id.txtEnfermedadDiag);
            txtPorcentajeDiag = itemView.findViewById(R.id.txtPorcentajeDiag);
            txtFechaDiag = itemView.findViewById(R.id.txtFechaDiag);
        }
    }
}
