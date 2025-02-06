import java.awt.EventQueue;
import java.sql.Connection;
import java.sql.DriverManager;

// Votre Run
public class Main {
    // La méthode qui appelera votre fonction Run
    public static void main(String[] args) {
        EventQueue.invokeLater(new Runnable() {
            public void run() {
                // Votre fonction Run
                // Vos information de connexion à une base de données
                String BDD = "marieteam";
                String url = "jdbc:mysql://localhost:3306/" + BDD;
                String user = "root";
                String passwd = "";
                // L'essaie de connexion à votre base de donées
                try {
                    Class.forName("com.mysql.cj.jdbc.Driver");
                    Connection conn = DriverManager.getConnection(url, user, passwd);
                    System.out.println("Connecter");
                } catch (Exception e){
                    e.printStackTrace();
                    System.out.println("Erreur");
                    System.exit(0);
                }
            }
        });
    }

}