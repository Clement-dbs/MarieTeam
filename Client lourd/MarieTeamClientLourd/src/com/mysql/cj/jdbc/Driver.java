package com.mysql.cj.jdbc;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.cfg.Configuration;
import marieteam.models.Bateau;
import marieteam.models.Reservation;
import marieteam.models.Traversee;
import marieteam.models.Utilisateur;

public class Driver {

    // SessionFactory de Hibernate
    private static SessionFactory sessionFactory;

    static {
        try {
            // Créer une SessionFactory en utilisant la configuration Hibernate
            sessionFactory = new Configuration()
                    .configure("hibernate.cfg.xml") // Charger le fichier de configuration
                    .addAnnotatedClass(Bateau.class) // Ajouter les classes mappées
                    .addAnnotatedClass(Reservation.class)
                    .addAnnotatedClass(Traversee.class)
                    .addAnnotatedClass(Utilisateur.class)
                    .buildSessionFactory();
        } catch (Exception e) {
            e.printStackTrace();
            throw new ExceptionInInitializerError("Problème avec la création de la SessionFactory.");
        }
    }

    // Méthode pour obtenir la session Hibernate
    public static Session getSession() {
        return sessionFactory.getCurrentSession();
    }

    // Méthode pour démarrer une transaction
    public static void startTransaction(Session session) {
        session.beginTransaction();
    }

    // Méthode pour valider une transaction
    public static void commitTransaction(Session session) {
        session.getTransaction().commit();
    }

    // Méthode pour fermer la session Hibernate
    public static void closeSession(Session session) {
        session.close();
    }

    // Méthode pour fermer la SessionFactory
    public static void closeSessionFactory() {
        sessionFactory.close();
    }

    // Méthode pour tester la connexion à la base de données
    public static void testConnection() {
        Session session = null;
        try {
            // Ouvrir une session
            session = getSession();
            // Démarrer une transaction
            startTransaction(session);
            // Exemple : récupérer un bateau par son ID (1 dans ce cas)
            Bateau bateau = session.get(Bateau.class, 1);
            System.out.println("Bateau récupéré : " + bateau);
            // Valider la transaction
            commitTransaction(session);
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            // Fermer la session
            closeSession(session);
        }
    }

    public static void main(String[] args) {
        // Tester la connexion
        testConnection();
        // Fermer la SessionFactory
        closeSessionFactory();
    }
}
