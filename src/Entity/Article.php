<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelleArticle = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $qteProduit = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $imageArticle = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbCommentaire = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    #[ORM\ManyToOne(inversedBy: 'articlesVendus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $vendeur = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'articlesAchetes')]
    private Collection $acheteurs;

//    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'listeEnvie')]
//    private Collection $listeEnvieUtilisateurs;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->acheteurs = new ArrayCollection();
//        $this->listeEnvieUtilisateurs = new  ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleArticle(): ?string
    {
        return $this->libelleArticle;
    }

    public function setLibelleArticle(string $libelleArticle): self
    {
        $this->libelleArticle = $libelleArticle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQteProduit(): ?int
    {
        return $this->qteProduit;
    }

    public function setQteProduit(int $qteProduit): self
    {
        $this->qteProduit = $qteProduit;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImageArticle(): ?string
    {
        return $this->imageArticle;
    }

    public function setImageArticle(string $imageArticle): self
    {
        $this->imageArticle = $imageArticle;

        return $this;
    }

    public function getNbCommentaire(): ?int
    {
        return $this->nbCommentaire;
    }

    public function setNbCommentaire(?int $nbCommentaire): self
    {
        $this->nbCommentaire = $nbCommentaire;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }

        return $this;
    }

    public function getVendeur(): ?Utilisateur
    {
        return $this->vendeur;
    }

    public function setVendeur(?Utilisateur $vendeur): self
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getAcheteurs(): Collection
    {
        return $this->acheteurs;
    }

    public function addAcheteur(Utilisateur $acheteur): self
    {
        if (!$this->acheteurs->contains($acheteur)) {
            $this->acheteurs->add($acheteur);
            $acheteur->addArticlesAchete($this);
        }

        return $this;
    }

    public function removeAcheteur(Utilisateur $acheteur): self
    {
        if ($this->acheteurs->removeElement($acheteur)) {
            $acheteur->removeArticlesAchete($this);
        }

        return $this;
    }

//    /**
//     * @return Collection
//     */
//    public function getListeEnvieUtilisateurs(): Collection
//    {
//        return $this->listeEnvieUtilisateurs;
//    }
//
//    /**
//     * @param Collection $listeEnvieUtilisateurs
//     */
//    public function setListeEnvieUtilisateurs(Collection $listeEnvieUtilisateurs): void
//    {
//        $this->listeEnvieUtilisateurs = $listeEnvieUtilisateurs;
//    }
}
