package com.marieteam.demo.model;

import jakarta.persistence.*;

@Entity
@Table(name = "reservation")
public class Reservation {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private int id;
    private String reservation;
    private String date;
    private int nbAdulte;
    private int nbEnfant;
    private int nbVoiture4;
    private int nbVoiture5;
    private int nbFourgon;
    private int nbCampingCar;
    private int nbCamion;
    private float nbPrix;
    private int idUser;

    public Reservation() {

    }

    public Reservation(int id, String reservation, String date, int nbAdulte, int nbEnfant, int nbVoiture4, int nbVoiture5, int nbFourgon, int nbCampingCar, int nbCamion, float nbPrix, int idUser) {
        this.id = id;
        this.reservation = reservation;
        this.date = date;
        this.nbAdulte = nbAdulte;
        this.nbEnfant = nbEnfant;
        this.nbVoiture4 = nbVoiture4;
        this.nbVoiture5 = nbVoiture5;
        this.nbFourgon = nbFourgon;
        this.nbCampingCar = nbCampingCar;
        this.nbCamion = nbCamion;
        this.nbPrix = nbPrix;
        this.idUser = idUser;
    }

    public String getReservation() {
        return reservation;
    }

    public void setReservation(String reservation) {
        this.reservation = reservation;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getNbAdulte() {
        return nbAdulte;
    }

    public void setNbAdulte(int nbAdulte) {
        this.nbAdulte = nbAdulte;
    }

    public int getNbEnfant() {
        return nbEnfant;
    }

    public void setNbEnfant(int nbEnfant) {
        this.nbEnfant = nbEnfant;
    }

    public int getNbVoiture4() {
        return nbVoiture4;
    }

    public void setNbVoiture4(int nbVoiture4) {
        this.nbVoiture4 = nbVoiture4;
    }

    public int getNbVoiture5() {
        return nbVoiture5;
    }

    public void setNbVoiture5(int nbVoiture5) {
        this.nbVoiture5 = nbVoiture5;
    }

    public int getNbFourgon() {
        return nbFourgon;
    }

    public void setNbFourgon(int nbFourgon) {
        this.nbFourgon = nbFourgon;
    }

    public int getNbCampingCar() {
        return nbCampingCar;
    }

    public void setNbCampingCar(int nbCampingCar) {
        this.nbCampingCar = nbCampingCar;
    }

    public int getNbCamion() {
        return nbCamion;
    }

    public void setNbCamion(int nbCamion) {
        this.nbCamion = nbCamion;
    }

    public float getNbPrix() {
        return nbPrix;
    }

    public void setNbPrix(float nbPrix) {
        this.nbPrix = nbPrix;
    }

    public int getIdUser() {
        return idUser;
    }

    public void setIdUser(int idUser) {
        this.idUser = idUser;
    }

}
