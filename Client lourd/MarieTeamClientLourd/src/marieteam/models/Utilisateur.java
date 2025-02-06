package marieteam.models; // Assure-toi que le package correspond à ton projet

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class Utilisateur {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nom;
    private String email;
    private String role;

    // Constructeurs, getters et setters...

    public Utilisateur() {}

    public Utilisateur(String nom, String email, String role) {
        this.nom = nom;
        this.email = email;
        this.role = role;
    }

    // Getters et Setters pour id, nom, email, role
}
