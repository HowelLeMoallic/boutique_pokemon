<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom et prénom ne peuvent pas être null')]
    private ?string $nomPrenom = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column]
    private ?float $credit = null;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    #[ORM\ManyToMany(targetEntity: Retrait::class, inversedBy: 'utilisateurs')]
    private Collection $lieuxRetrait;

    #[ORM\OneToMany(mappedBy: 'vendeur', targetEntity: Article::class)]
    private Collection $articlesVendus;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'acheteurs')]
    private Collection $articlesAchetes;

    #[ORM\Column(length: 255)]
    private ?string $identifiant = null;

//    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'listeEnvieUtilisateurs')]
//    private Collection $listeEnvie;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->lieuxRetrait = new ArrayCollection();
        $this->articlesVendus = new ArrayCollection();
        $this->articlesAchetes = new ArrayCollection();
//        $this->listeEnvie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nomPrenom;
    }

    public function setNomPrenom(string $nomPrenom): self
    {
        $this->nomPrenom = $nomPrenom;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function setCredit(float $credit): self
    {
        $this->credit = $credit;

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
            $commentaire->setAuteur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getAuteur() === $this) {
                $commentaire->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Retrait>
     */
    public function getLieuxRetrait(): Collection
    {
        return $this->lieuxRetrait;
    }

    public function addLieuxRetrait(Retrait $lieuxRetrait): self
    {
        if (!$this->lieuxRetrait->contains($lieuxRetrait)) {
            $this->lieuxRetrait->add($lieuxRetrait);
        }

        return $this;
    }

    public function removeLieuxRetrait(Retrait $lieuxRetrait): self
    {
        $this->lieuxRetrait->removeElement($lieuxRetrait);

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticlesVendus(): Collection
    {
        return $this->articlesVendus;
    }

    public function addArticlesVendu(Article $articlesVendu): self
    {
        if (!$this->articlesVendus->contains($articlesVendu)) {
            $this->articlesVendus->add($articlesVendu);
            $articlesVendu->setVendeur($this);
        }

        return $this;
    }

    public function removeArticlesVendu(Article $articlesVendu): self
    {
        if ($this->articlesVendus->removeElement($articlesVendu)) {
            // set the owning side to null (unless already changed)
            if ($articlesVendu->getVendeur() === $this) {
                $articlesVendu->setVendeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticlesAchetes(): Collection
    {
        return $this->articlesAchetes;
    }

    public function addArticlesAchete(Article $articlesAchete): self
    {
        if (!$this->articlesAchetes->contains($articlesAchete)) {
            $this->articlesAchetes->add($articlesAchete);
        }

        return $this;
    }

    public function removeArticlesAchete(Article $articlesAchete): self
    {
        $this->articlesAchetes->removeElement($articlesAchete);

        return $this;
    }

//    /**
//     * @return Collection<int, Article>
//     */
//    public function getListeEnvie(): Collection
//    {
//        return $this->listeEnvie;
//    }
//
//    public function addListeEnvie(Article $listeEnvie): self
//    {
//        if (!$this->listeEnvie->contains($listeEnvie)) {
//            $this->listeEnvie->add($listeEnvie);
//        }
//
//        return $this;
//    }
//
//    public function removeListeEnvie(Article $listeEnvie): self
//    {
//        $this->listeEnvie->removeElement($listeEnvie);
//
//        return $this;
//    }

public function getIdentifiant(): ?string
{
    return $this->identifiant;
}

public function setIdentifiant(string $identifiant): self
{
    $this->identifiant = $identifiant;

    return $this;
}
}
