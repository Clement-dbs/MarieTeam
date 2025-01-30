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

        // Créer un panneau principal
        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(5, 1)); // Disposition en grille

        // Ajouter des boutons pour chaque fonctionnalité principale
        JButton gestionTraverséesButton = new JButton("Gestion des Traversées");
        JButton gestionReservationsButton = new JButton("Gestion des Réservations");
        JButton gestionBateauxButton = new JButton("Gestion des Bateaux");
        JButton gestionUtilisateursButton = new JButton("Gestion des Utilisateurs");
        JButton gestionTarifsButton = new JButton("Gestion des Tarifs");

        // Ajouter les boutons au panneau
        panel.add(gestionTraverséesButton);
        panel.add(gestionReservationsButton);
        panel.add(gestionBateauxButton);
        panel.add(gestionUtilisateursButton);
        panel.add(gestionTarifsButton);

        // Ajouter un gestionnaire d'événements pour chaque bouton
        gestionTraverséesButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                JOptionPane.showMessageDialog(frame, "Gestion des Traversées");
            }
        });

        gestionReservationsButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                JOptionPane.showMessageDialog(frame, "Gestion des Réservations");
            }
        });

        gestionBateauxButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                JOptionPane.showMessageDialog(frame, "Gestion des Bateaux");
            }
        });

        gestionUtilisateursButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                JOptionPane.showMessageDialog(frame, "Gestion des Utilisateurs");
            }
        });

        gestionTarifsButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                JOptionPane.showMessageDialog(frame, "Gestion des Tarifs");
            }
        });

        // Ajouter le panneau à la fenêtre
        frame.add(panel);

        // Afficher la fenêtre
        frame.setVisible(true);
    }
}
