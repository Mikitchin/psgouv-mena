<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"matricule"}, message="There is already an account with this matricule")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $matricule;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Agent::class, mappedBy="users", cascade={"persist", "remove"})
     */
    private $agents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuNaisssance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $situationMatrimoniale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emploi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discipline;

    /**
     * @ORM\ManyToOne(targetEntity=Drena::class)
     */
    private $drena;

    /**
     * @ORM\ManyToOne(targetEntity=Structure::class)
     */
    private $structure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomPere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomPere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomMere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomMere;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diplome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->matricule;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->matricule;
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAgents(): ?Agent
    {
        return $this->agents;
    }

    public function setAgents(?Agent $agents): self
    {
        // unset the owning side of the relation if necessary
        if ($agents === null && $this->agents !== null) {
            $this->agents->setUsers(null);
        }

        // set the owning side of the relation if necessary
        if ($agents !== null && $agents->getUsers() !== $this) {
            $agents->setUsers($this);
        }

        $this->agents = $agents;

        return $this;
    }
    public function __toString()
    {
        return $this->matricule;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaisssance(): ?string
    {
        return $this->lieuNaisssance;
    }

    public function setLieuNaisssance(?string $lieuNaisssance): self
    {
        $this->lieuNaisssance = $lieuNaisssance;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSituationMatrimoniale(): ?string
    {
        return $this->situationMatrimoniale;
    }

    public function setSituationMatrimoniale(?string $situationMatrimoniale): self
    {
        $this->situationMatrimoniale = $situationMatrimoniale;

        return $this;
    }

    public function getEmploi(): ?string
    {
        return $this->emploi;
    }

    public function setEmploi(?string $emploi): self
    {
        $this->emploi = $emploi;

        return $this;
    }

    public function getDiscipline(): ?string
    {
        return $this->discipline;
    }

    public function setDiscipline(?string $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getDrena(): ?Drena
    {
        return $this->drena;
    }

    public function setDrena(?Drena $drena): self
    {
        $this->drena = $drena;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function getNomPere(): ?string
    {
        return $this->nomPere;
    }

    public function setNomPere(?string $nomPere): self
    {
        $this->nomPere = $nomPere;

        return $this;
    }

    public function getPrenomPere(): ?string
    {
        return $this->prenomPere;
    }

    public function setPrenomPere(?string $prenomPere): self
    {
        $this->prenomPere = $prenomPere;

        return $this;
    }

    public function getNomMere(): ?string
    {
        return $this->nomMere;
    }

    public function setNomMere(?string $nomMere): self
    {
        $this->nomMere = $nomMere;

        return $this;
    }

    public function getPrenomMere(): ?string
    {
        return $this->prenomMere;
    }

    public function setPrenomMere(?string $prenomMere): self
    {
        $this->prenomMere = $prenomMere;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
}
