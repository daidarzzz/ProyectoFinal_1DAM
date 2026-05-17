package org.example.crud_proyecto;


import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;

import java.io.IOException;
import java.sql.Connection;

public class UsuariosController {

    static Connection conexion;
    static Usuario seleccionado;

    @FXML
    public Label PaginaLabel;

    @FXML
    public TableView<Usuario> TablaId;

    @FXML
    public TableColumn<Usuario,Integer> IdUsuarioColumnaId;

    @FXML
    public TableColumn<Usuario,String> NombreColumnaId;

    @FXML
    public TableColumn<Usuario, String> ContrasenaColumnId;

    @FXML
    public TableColumn<Usuario, String> EmailColumnId;

    @FXML
    public Button EditarClickButton;

    @FXML
    public Button EliminarClickButton;

    @FXML
    public TextField NombreTextField;

    @FXML
    public TextField EmailTextField;

    @FXML
    public TextField ContrasenaTextField;

    @FXML
    public Button InsertarClickButton;

    @FXML
    public Button GuardarClickButton;

    @FXML
    public Label MensajeLabelId;

    @FXML
    public void initialize(){

    conexion = Datos_Usuario.conexion();

    IdUsuarioColumnaId.setCellValueFactory(datos -> new SimpleIntegerProperty(datos.getValue().getId()).asObject());
    NombreColumnaId.setCellValueFactory( datos -> new SimpleStringProperty(datos.getValue().getNombre()));
    ContrasenaColumnId.setCellValueFactory( datos -> new SimpleStringProperty(datos.getValue().getContrasena()));
    EmailColumnId.setCellValueFactory( datos -> new SimpleStringProperty(datos.getValue().getEmail()));

    TablaId.setItems(Datos_Usuario.consulta(conexion));

    }


    public void EditarOnActtion(ActionEvent actionEvent) {

        seleccionado = TablaId.getSelectionModel().getSelectedItem();

        if (seleccionado == null){

            MensajeLabelId.setText("No hay nada seleccionado");

        }else {

            InsertarClickButton.setDisable(true);
            GuardarClickButton.setDisable(false);
            NombreTextField.setText(seleccionado.getNombre());
            EmailTextField.setText(seleccionado.getEmail());
            ContrasenaTextField.setText(seleccionado.getContrasena());
            MensajeLabelId.setText("Usuario actualizado");

        }

    }

    public void EliminarOnAction(ActionEvent actionEvent) {

        seleccionado = TablaId.getSelectionModel().getSelectedItem();

        if (seleccionado == null){

            MensajeLabelId.setText("No hay nada seleccionado");

        }else {

            Datos_Usuario.eliminar(conexion,seleccionado);
            MensajeLabelId.setText("Usuario borrado");

            TablaId.setItems(Datos_Usuario.consulta(conexion));

        }

    }

    public void InsertarOnAction(ActionEvent actionEvent) {

        String nombre = cogerNombre();
        String email = cogerEmail();
        String contrasena = cogerContrasena();

        Datos_Usuario.insertar(conexion,new Usuario(nombre,null,contrasena,email));
        hacerClear_variables();
        TablaId.setItems(Datos_Usuario.consulta(conexion));
        System.out.println("Usuario insertado con exito");

    }

    public void GuardarOnAction(ActionEvent actionEvent) {

        Integer id = seleccionado.getId();
        String nombre = cogerNombre();
        String email = cogerEmail();
        String contrasena = cogerContrasena();

        Datos_Usuario.modificar(conexion, new Usuario(nombre,id,contrasena,email));

        InsertarClickButton.setDisable(false);
        GuardarClickButton.setDisable(true);

        hacerClear_variables();

        TablaId.setItems(Datos_Usuario.consulta(conexion));
        System.out.println("Usuario actualizado con exito");

    }

    public String cogerNombre(){

        return NombreTextField.getText();

    }

    public String cogerEmail(){

        return EmailTextField.getText();

    }

    public String cogerContrasena(){

        return ContrasenaTextField.getText();

    }

    public void hacerClear_variables(){

        NombreTextField.clear();
        EmailTextField.clear();
        ContrasenaTextField.clear();
        seleccionado = null;

    }


    public void VolverOnAction(ActionEvent actionEvent) throws IOException {

        HelloApplication.setRoot("comienzo-view");

    }
}
