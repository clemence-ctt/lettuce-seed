<?php

namespace App\Entity;

use App\Entity\Plant;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PictureRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "The title must be at least {{ limit }} characters long",
     *      maxMessage = "The title cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Length(
     *      max = 500,
     *      maxMessage = "The description cannot be longer than {{ limit }} characters"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @File(mimeTypes={ "image/jpeg" })
     * TODO ajouter des types
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_cover;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $like_counter;

    /**
     * @ORM\ManyToMany(targetEntity=Plant::class, inversedBy="pictures")
     */
    private $plants;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


    // private $tutus = [];


    public function __construct()
    {
        $this->plants = new ArrayCollection();
        
        // NOTICE custom property not mapped with BDD
        // $this->tutus = new ArrayCollection();

        $this->createdAt = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }


    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }


    public function getIsCover(): ?bool
    {
        return $this->is_cover;
    }

    public function setIsCover(?bool $is_cover): self
    {
        $this->is_cover = $is_cover;

        return $this;
    }


    public function getLikeCounter(): ?int
    {
        return $this->like_counter;
    }

    public function setLikeCounter(?int $like_counter): self
    {
        $this->like_counter = $like_counter;

        return $this;
    }


    /**
     * @return Collection|plant[]
     */
    public function getPlants(): Collection
    {
        return $this->plants;
    }

    public function addPlant(plant $plant): self
    {
        if (!$this->plants->contains($plant)) {
            $this->plants[] = $plant;
        }

        return $this;
    }

    public function removePlant(plant $plant): self
    {
        $this->plants->removeElement($plant);

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(): self
    {
        $this->created_at = new \DateTime();;

        return $this;
    }

    
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }
    
    
    //public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    public function setUpdatedAt(): self
    {
        // $this->updated_at = $updated_at;
        $this->updated_at = new \DateTime();

        return $this;
    }

    // /**
    //  * Get the value of tutus
    //  */
    // public function getTutus()
    // {
    //     return $this->tutus;
    // }

    // /**
    //  * Set the value of tutus
    //  */
    // public function setTutus($tutus): self
    // {
    //     $this->tutus = $tutus;

    //     return $this;
    // }
}
