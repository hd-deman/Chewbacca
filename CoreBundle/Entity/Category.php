<?php
namespace Entity;
/**
 * @orm:Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @gedmo:Tree(type="nested")
 * 
 */
class Category
{
    /**
     * @orm:Column(name="id", type="integer")
     * @orm:Id
     * @orm:GeneratedValue
     */
    private $id;
 
    /**
     * @gedmo:Translatable
     * @gedmo:Sluggable
     * @Column(name="title", type="string", length=64)
     */
    private $title;
 
    /**
     * @gedmo:TreeLeft
     * @Column(name="lft", type="integer")
     */
    private $lft;
     
    /**
     * @gedmo:TreeRight
     * @Column(name="rgt", type="integer")
     */
    private $rgt;
     
    /**
     * @gedmo:TreeLevel
     * @Column(name="lvl", type="integer")
     */
    private $lvl;
     
    /**
     * @gedmo:TreeParent
     * @ManyToOne(targetEntity="Category", inversedBy="children")
     */
    private $parent;
     
    /**
     * @OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;
     
    /**
     * @gedmo:Translatable
     * @gedmo:Slug
     * @Column(name="slug", type="string", length=128)
     */
    private $slug;
 
    public function getId()
    {
        return $this->id;
    }
     
    public function getSlug()
    {
        return $this->slug;
    }
     
    public function setTitle($title)
    {
        $this->title = $title;
    }
 
    public function getTitle()
    {
        return $this->title;
    }
     
    public function setParent(Category $parent)
    {
        $this->parent = $parent; 
    }
     
    public function getParent()
    {
        return $this->parent;    
    }
}