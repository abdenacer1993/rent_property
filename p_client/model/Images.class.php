<?php 
class Images{
    private $annonceId;
    private $title;
    private $categorie;
    private $urlImages;
    private $date;



    public function __construct($annonceId, $title, $categorie, $urlImages, $date)
    {
        $this->annonceId = $annonceId;
        $this->title = $title;
        $this->categorie = $categorie;
        $this->urlImages = $urlImages;
        $this->date = $date;

    }



    public function ajouter() {
        include('../includes/connect_db.php');
        try {
            foreach ($this->urlImages as $url) {
                $stmt = $bdd->prepare("INSERT INTO images(annonceID, title, categorie, urlImages, date) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$this->annonceId, $this->title, $this->categorie, $url, $this->date]);
            }
            if ($stmt->rowCount() > 0) { // Check if any row was affected
                return 1; // Success
            } else {
                return -1; // Failed
            }
    
        } catch (PDOException  $e) {
            echo "Erreur :" .$e->getMessage();
            return -1; // Failed
        }
    }
    
    
    
    public function ajouterPlusieursImages($images) {
        foreach ($images as $image) {
            // Supposons que $image est un tableau associatif avec des clés telles que 'annonceId', 'title', 'categorie', 'urlImages'
            $this->annonceId = $image['annonceId'];
            $this->title = $image['title'];
            $this->categorie = $image['categorie'];
            $this->urlImages = $image['urlImages'];
            $result = $this->ajouter(); // Appeler la fonction ajouter() pour ajouter chaque image
            if ($result === -1) {
                // Gérer l'erreur, peut-être la journaliser
                return -1;
            }
        }
        return 1; // Succès
    }
    


}
?>