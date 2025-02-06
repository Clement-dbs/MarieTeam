package marieteam.utils;

import marieteam.models.Bateau;
import marieteam.models.Reservation;
import marieteam.models.Traversee;
import marieteam.models.Utilisateur;

import org.hibernate.SessionFactory;
import org.hibernate.cfg.Configuration;

public class HibernateUtil {

    private static final SessionFactory sessionFactory;

    static {
        try {
            // Création de la SessionFactory en ajoutant les classes annotées
            sessionFactory = new Configuration()
                    .configure("hibernate.cfg.xml")  // Assurez-vous que le fichier hibernate.cfg.xml est bien dans votre dossier resources
                    .addAnnotatedClass(Bateau.class)
                    .addAnnotatedClass(Reservation.class)
                    .addAnnotatedClass(Traversee.class)
                    .addAnnotatedClass(Utilisateur.class)
                    .buildSessionFactory();
        } catch (Exception e) {
            throw new ExceptionInInitializerError(e);
        }
    }

    public static SessionFactory getSessionFactory() {
        return sessionFactory;
    }

    public static void shutdown() {
        // Ferme la sessionFactory
        getSessionFactory().close();
    }
}