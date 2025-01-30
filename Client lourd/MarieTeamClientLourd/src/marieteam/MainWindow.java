package marieteam;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class MainWindow {

    public static void main(String[] args) {
        // Créer la fenêtre principale
        JFrame frame = new JFrame("MarieTeam - Gestion de la flotte maritime");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(800, 600);
        frame.setLocationRelativeTo(null); // Centrer la fenêtre sur l'écran
        frame.setLayout(new BorderLayout()); // Utiliser BorderLayout pour une meilleure gestion de l'espace

        // Créer un panneau principal avec un layout différent pour les boutons
        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(5, 1, 10, 10)); // Disposition en grille avec un peu de marges (10px)
        panel.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20)); // Ajouter des marges autour des boutons

        // Créer des boutons pour chaque fonctionnalité
        JButton gestionTraverséesButton = createButton("Gestion des Traversées");
        JButton gestionReservationsButton = createButton("Gestion des Réservations");
        JButton gestionBateauxButton = createButton("Gestion des Bateaux");
        JButton gestionUtilisateursButton = createButton("Gestion des Utilisateurs");
        JButton gestionTarifsButton = createButton("Gestion des Tarifs");

        // Ajouter les boutons au panneau
        panel.add(gestionTraverséesButton);
        panel.add(gestionReservationsButton);
        panel.add(gestionBateauxButton);
        panel.add(gestionUtilisateursButton);
        panel.add(gestionTarifsButton);

        // Ajouter le panneau à la fenêtre
        frame.add(panel, BorderLayout.CENTER);

        // Afficher la fenêtre
        frame.setVisible(true);
    }

    // Méthode pour créer un bouton avec un texte et un gestionnaire d'événements
    private static JButton createButton(String buttonText) {
        JButton button = new JButton(buttonText);
        button.setFont(new Font("Arial", Font.PLAIN, 16)); // Changer la police pour une meilleure lisibilité
        button.setBackground(new Color(100, 149, 237)); // Couleur de fond agréable
        button.setForeground(Color.WHITE); // Texte blanc
        button.setFocusPainted(false); // Retirer le focus lorsque l'on clique sur un bouton

        button.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                handleButtonClick(buttonText);
            }
        });

        return button;
    }

    // Méthode pour gérer l'événement de clic sur chaque bouton
    private static void handleButtonClick(String buttonText) {
        // Afficher une boîte de dialogue avec le nom de la fonctionnalité
        JOptionPane.showMessageDialog(null, "Vous avez sélectionné : " + buttonText, "Information", JOptionPane.INFORMATION_MESSAGE);

        // Ici, tu peux ouvrir des fenêtres supplémentaires pour chaque fonctionnalité si nécessaire
        switch (buttonText) {
            case "Gestion des Traversées":
                // Ouvrir une nouvelle fenêtre pour gérer les traversées
                openGestionTraversées();
                break;
            case "Gestion des Réservations":
                // Ouvrir une nouvelle fenêtre pour gérer les réservations
                openGestionReservations();
                break;
            case "Gestion des Bateaux":
                // Ouvrir une nouvelle fenêtre pour gérer les bateaux
                openGestionBateaux();
                break;
            case "Gestion des Utilisateurs":
                // Ouvrir une nouvelle fenêtre pour gérer les utilisateurs
                openGestionUtilisateurs();
                break;
            case "Gestion des Tarifs":
                // Ouvrir une nouvelle fenêtre pour gérer les tarifs
                openGestionTarifs();
                break;
            default:
                break;
        }
    }

    // Méthodes pour ouvrir des fenêtres spécifiques (placeholders pour maintenant)
    private static void openGestionTraversées() {
        JFrame traverséeFrame = new JFrame("Gestion des Traversées");
        traverséeFrame.setSize(400, 300);
        traverséeFrame.setLocationRelativeTo(null);
        traverséeFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        traverséeFrame.setVisible(true);
    }

    private static void openGestionReservations() {
        JFrame reservationFrame = new JFrame("Gestion des Réservations");
        reservationFrame.setSize(400, 300);
        reservationFrame.setLocationRelativeTo(null);
        reservationFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        reservationFrame.setVisible(true);
    }

    private static void openGestionBateaux() {
        JFrame bateauxFrame = new JFrame("Gestion des Bateaux");
        bateauxFrame.setSize(400, 300);
        bateauxFrame.setLocationRelativeTo(null);
        bateauxFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        bateauxFrame.setVisible(true);
    }

    private static void openGestionUtilisateurs() {
        JFrame utilisateursFrame = new JFrame("Gestion des Utilisateurs");
        utilisateursFrame.setSize(400, 300);
        utilisateursFrame.setLocationRelativeTo(null);
        utilisateursFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        utilisateursFrame.setVisible(true);
    }

    private static void openGestionTarifs() {
        JFrame tarifsFrame = new JFrame("Gestion des Tarifs");
        tarifsFrame.setSize(400, 300);
        tarifsFrame.setLocationRelativeTo(null);
        tarifsFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
        tarifsFrame.setVisible(true);
    }
}
