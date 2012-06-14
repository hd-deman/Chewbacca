<?php

namespace Chewbacca\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 *  @ORM\Table(name="category")
 *  @Gedmo\Tree(type="nested")
 */

 class Category
 {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;#

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     * @Assert\Blank()
     */
    private $slug;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     * @Assert\Blank()
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     * @Assert\Blank()
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     * @Assert\Blank()
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     * @Assert\Blank()
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\Type(type="\Chewbacca\CoreBundle\Entity\Category")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     * @Assert\NotBlank()
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="\Chewbacca\CoreBundle\Entity\Nature", inversedBy="categories")
     * @ORM\JoinColumn(name="nature_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @Assert\Type(type="\Chewbacca\CoreBundle\Entity\Nature")
     */
    private $nature;

    /**
     * @ORM\ManyToMany(targetEntity="\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product", mappedBy="categories")
     */
    protected $products;

    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  intager  $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set title
     *
     * @param  string   $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param  string   $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set lft
     *
     * @param  integer  $lft
     * @return Category
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param  integer  $lvl
     * @return Category
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param  integer  $rgt
     * @return Category
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param  integer  $root
     * @return Category
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Add children
     *
     * @param Chewbacca\CoreBundle\Entity\Category $children
     */
    public function addCategory(\Chewbacca\CoreBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add products
     *
     * @param Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products
     */
    public function addProduct(\Chewbacca\StoreBundle\StoreCoreBundle\Entity\Product $products)
    {
        $this->products[] = $products;
    }

    /**
     * Get products
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set nature
     *
     * @param  \Chewbacca\CoreBundle\Entity\Nature $nature
     * @return Nature
     */
    public function setNature(\Chewbacca\CoreBundle\Entity\Nature $nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return \Chewbacca\CoreBundle\Entity\Nature
     */
    public function getNature()
    {
        return $this->nature;
    }

    public function getTitleWithIndent()
    {
        return str_repeat('—', $this->getLvl()-1)." ".$this->getTitle();
    }

    /**
     * Add children
     *
     * @param  Chewbacca\CoreBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(\Chewbacca\CoreBundle\Entity\Category $children)
    {
        $this->children[] = $children;

        return $this;
    }
}
