<?php
namespace Chewbacca\CoreBundle\Entity;
/**
 * @gedmo:Tree(type="nested")
 * @orm:Table(name="section")
 * @orm:Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
Class Section {

    /**
     * @orm:Column(name="id", type="integer")
     * @orm:Id
     * @orm:GeneratedValue
     */
    private $id;
 
    /**
     * @gedmo:Translatable
     * @gedmo:Sluggable
     * @orm:Column(name="title", type="string", length=64)
     */
    private $title;
 
    /**
     * @gedmo:TreeLeft
     * @orm:Column(name="lft", type="integer")
     */
    private $lft;
     
    /**
     * @gedmo:TreeRight
     * @orm:Column(name="rgt", type="integer")
     */
    private $rgt;
     
    /**
     * @gedmo:TreeLevel
     * @orm:Column(name="lvl", type="integer")
     */
    private $lvl;
     
    /**
     * @gedmo:TreeParent
     * @orm:ManyToOne(targetEntity="Section", inversedBy="children")
     */
    private $parent;
     
    /**
     * @orm:OneToMany(targetEntity="Section", mappedBy="parent")
     */
    private $children;
     
    /**
     * @gedmo:Translatable
     * @gedmo:Slug
     * @orm:Column(name="slug", type="string", length=128)
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
     
    public function setParent(Section $parent)
    {
        $this->parent = $parent; 
    }
     
    public function getParent()
    {
        return $this->parent;    
    }
    public function getLevel()
    {
        return $this->lvl;
    }
}