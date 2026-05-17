package org.example.crud_proyecto;

import javafx.beans.property.SimpleDoubleProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;

import java.io.IOException;
import java.sql.Connection;

public class AnuncianteController {

    static Connection conexion;
    static Anunciante seleccionado;

    @FXML
    public Label PaginaAnuLabel;

    @FXML
    public TableView<Anunciante> TablaAnuId;

    @FXML
    public TableColumn<Anunciante,Integer> IdAnuncianteColumnaId;

    @FXML
    public TableColumn<Anunciante,String> NombreAnuColumnaId;

    @FXML
    public TableColumn<Anunciante,String> ContrasenaAnuColumnId;

    @FXML
    public TableColumn<Anunciante,String> EmailAnuColumnId;

    @FXML
    public Button EditarAnuClickButton;

    @FXML
    public TableColumn<Anunciante,String> EmpresaColumnId;

    @FXML
    public TableColumn<Anunciante,Double> PresupuestoColumnId;

    @FXML
    public Button EliminarAnuClickButton;

    @FXML
    public Label MensajeLabelId;

    @FXML
    public TextField NombreAnuTextField;

    @FXML
    public TextField EmailAnuTextField;

    @FXML
    public TextField ContrasenaAnuTextField;

    @FXML
    public Button InsertarAnuClickButton;

    @FXML
    public Button GuardarAnuClickButton;

    @FXML
    public Button VolverAnuId;

    @FXML
    public TextField EmpresaTextField;

    @FXML
    public TextField PresupuestoTextField;

    @FXML
    public void initialize(){

        conexion = Datos_Anunciante.conexion();

        IdAnuncianteColumnaId.setCellValueFactory(d -> new SimpleIntegerProperty(d.getValue().getId()).asObject());
        NombreAnuColumnaId.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getNombre()));
        EmpresaColumnId.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getEmpresa()));
        ContrasenaAnuColumnId.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getContrasena()));
        PresupuestoColumnId.setCellValueFactory(d -> new SimpleDoubleProperty(d.getValue().getPresupuesto()).asObject());
        EmailAnuColumnId.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getEmail()));

        TablaAnuId.setItems(Datos_Anunciante.consulta(conexion));

    }

    public void EditarAnuOnActtion(ActionEvent actionEvent) {

        seleccionado = TablaAnuId.getSelectionModel().getSelectedItem();

        if (seleccionado == null){

            MensajeLabelId.setText("No hay nada seleccionado");

        }else {

            InsertarAnuClickButton.setDisable(true);
            GuardarAnuClickButton.setDisable(false);
            NombreAnuTextField.setText(seleccionado.getNombre());
            EmailAnuTextField.setText(seleccionado.getEmail());
            ContrasenaAnuTextField.setText(seleccionado.getContrasena());
            EmpresaTextField.setText(seleccionado.getEmpresa());
            PresupuestoTextField.setText(String.valueOf(seleccionado.getPresupuesto()));
            MensajeLabelId.setText("Usuario actualizado");

        }

    }

    public void EliminarAnuOnAction(ActionEvent actionEvent) {

        seleccionado = TablaAnuId.getSelectionModel().getSelectedItem();

        if (seleccionado == null){

            MensajeLabelId.setText("No hay nada seleccionado");

        }else {

            Datos_Usuario.eliminar(conexion,seleccionado);
            MensajeLabelId.setText("Usuario borrado");

            TablaAnuId.setItems(Datos_Anunciante.consulta(conexion));

        }

    }

    public void InsertarOnAction(ActionEvent actionEvent) {

        String nombre = cogerNombreAnu();
        String email = cogerEmailAnu();
        String contrasena = cogerContrasenaAnu();
        String empresa = cogerEmpresaAnu();
        double presupuesto = 0;

        try {

            presupuesto = Double.parseDouble(cogerPresupuestoAnu());

        }catch (NumberFormatException e){

            MensajeLabelId.setText("Error: Presupuesto no valido.");

        }

        Anunciante nuevo = new Anunciante(nombre,null,contrasena,email,empresa,presupuesto);

        Datos_Anunciante.insertar(conexion, nuevo);

        hacerClear_variablesAnu();

        TablaAnuId.setItems(Datos_Anunciante.consulta(conexion));

        MensajeLabelId.setText("Anunciante insertado con éxito");


    }

    public void GuardarOnAction(ActionEvent actionEvent) {

        Integer id = seleccionado.getId();
        String nombre = cogerNombreAnu();
        String email = cogerEmailAnu();
        String contrasena = cogerContrasenaAnu();
        String empresa = cogerEmpresaAnu();
        double presupuesto = Double.parseDouble(cogerPresupuestoAnu());

        Anunciante modificado = new Anunciante(nombre, id, contrasena, email, empresa, presupuesto);
        Datos_Anunciante.modificar(conexion, modificado);

        InsertarAnuClickButton.setDisable(false);
        GuardarAnuClickButton.setDisable(true);

        hacerClear_variablesAnu();

        TablaAnuId.setItems(Datos_Anunciante.consulta(conexion));
        MensajeLabelId.setText("Anunciante actualizado con éxito");

    }

    public void VolverAnuOnAction(ActionEvent actionEvent) throws IOException {

        HelloApplication.setRoot("comienzo-view");

    }

    public String cogerNombreAnu(){

        return NombreAnuTextField.getText();

    }

    public String cogerEmailAnu(){

        return EmailAnuTextField.getText();

    }

    public String cogerContrasenaAnu(){

        return ContrasenaAnuTextField.getText();

    }

    public String cogerEmpresaAnu(){

        return EmpresaTextField.getText();

    }

    public String cogerPresupuestoAnu(){

        return PresupuestoTextField.getText();

    }

    public void hacerClear_variablesAnu(){

        NombreAnuTextField.clear();
        EmailAnuTextField.clear();
        ContrasenaAnuTextField.clear();
        EmpresaTextField.clear();
        PresupuestoTextField.clear();
        seleccionado = null;

    }
}
