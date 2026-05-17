package org.example.crud_proyecto;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Button;

import java.io.IOException;

public class ComienzoController {

    @FXML
    private Button UsuarioClickButton;

    @FXML
    private  Button AnunciantesClickButton;

    public void UsuarioOnAction(ActionEvent actionEvent) throws IOException {

        HelloApplication.setRoot("usuarios-view");

    }

    public void AnunciantesOnAction (ActionEvent actionEvent) throws IOException {

        HelloApplication.setRoot("anunciante-view");

    }
}
