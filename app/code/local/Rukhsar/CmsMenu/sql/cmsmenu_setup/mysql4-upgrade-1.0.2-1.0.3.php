<?php

/**
 *
 * Rukhsar-CmsMenu - Magento Extension
 *
 * @copyright Copyright (c) 2016 Rukhsar Manzoor (http://www.rukhsar.me.uk/)
 * @author Rukhsar Manzoor - rukhsar.man@gmail.com
 *
 */


$installer = $this;

$installer->startSetup();

// load old cmsmenu items:
$cmsMenuCollection = Mage::getModel('rukhsar_cmsmenu/cmsmenu')->getCollection();

// loop and fix:
foreach($cmsMenuCollection as $c) {
    $childOf = $c->getChildOf();
    if($childOf) {
        if(strpos($childOf, 'cmsmenu-')!==false) {
            $c->setChildOf(str_replace('cmsmenu-', '', $childOf));
        }
        if(strpos($childOf, 'category-node-')!==false) {
            $c->setChildOf(str_replace('category-node-', 'c-', $childOf));
        }
    }
    $addBefore = $c->getAddBefore();
    if($addBefore) {
        if(strpos($addBefore, 'cmsmenu-')!==false) {
            $c->setAddBefore(str_replace('cmsmenu-', '', $addBefore));
        }
        if(strpos($addBefore, 'category-node-')!==false) {
            $c->setAddBefore(str_replace('category-node-', 'c-', $addBefore));
        }
    }
    $c->save();
}

$installer->endSetup();
