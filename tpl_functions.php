<?php
/**
 * Template Functions
 *
 * This file provides template specific custom functions that are
 * not provided by the DokuWiki core.
 * It is common practice to start each function with an underscore
 * to make sure it won't interfere with future core functions.
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

use dokuwiki\Extension\Event;
use simple_html_dom\simple_html_dom;


require_once 'inc/vendor/simple_html_dom.php'; // Path to s_h_d.php relative to functions.php


function _tpl_usertools() {
    /* the optional second parameter of tpl_action() switches between a link and a button,
     e.g. a button inside a <li> would be: tpl_action('edit', 0, 'li') */
    tpl_toolsevent('usertools', array(
        'admin'     => tpl_action('admin', 1, 'li', 1),
        'profile'   => tpl_action('profile', 1, 'li', 1),
        'register'  => tpl_action('register', 1, 'li', 1),
        'login'     => tpl_action('login', 1, 'li', 1),
    ));
}

function _tpl_sitetools() {
    tpl_toolsevent('sitetools', array(
        'recent'    => tpl_action('recent', 1, 'li', 1),
        'media'     => tpl_action('media', 1, 'li', 1),
        'index'     => tpl_action('index', 1, 'li', 1),
    ));
}

function _tpl_pagetools() {
    tpl_toolsevent('pagetools', array(
        'edit'      => tpl_action('edit', 1, 'li', 1),
        'revisions' => tpl_action('revisions', 1, 'li', 1),
        'backlink'  => tpl_action('backlink', 1, 'li', 1),
        'subscribe' => tpl_action('subscribe', 1, 'li', 1),
        'revert'    => tpl_action('revert', 1, 'li', 1),
        'top'       => tpl_action('top', 1, 'li', 1),
    ));
}

function _tpl_detailtools() {
    echo tpl_action('mediaManager', 1, 'li', 1);
    echo tpl_action('img_backto', 1, 'li', 1);
}


/* -------------------------LORE ARCHIVE WIKI TOC GENERATION------------------------- */









/* WARNING! THE FOLLOWING FUNCTION WORKS WHEN NO URL REWRITING IS USED. Probably going to deprecate in Alpha. */


function _tpl_getwl($pageId, $headingId = null) {
    // Construct the link using relative URL format for DokuWiki
    $link = '/doku.php?id=' . $pageId;

    if ($headingId) {
        // Append heading if provided
        $link .= '#' . $headingId;
    }

    return $link;
}




/*Following code are from https://github.com/magnetde/dokuwiki-tailwind/tree/cd68fd0ebee8c46d8257f1af5a78a130c7437d89 */

/**
 * Checks if the string $string has the prefix $prefix.
 */
function _tpl_has_prefix($str, $prefix) {
	return substr($str, 0, strlen($prefix)) == $prefix;
}


/**
 * Removes the prefix $prefix from string $string.
 * If $string has no prefix $prefix, $string is returned.
 */
function _tpl_remove_prefix($str, $prefix) {
	if(_tpl_has_prefix($str, $prefix))
		$str = substr($str, strlen($prefix));

	return $str;
}

/**
 * If the current page either shows text, is an admin page or a plugin page,
 * this function returns a list of classes (as a single string),
 * that exactly describes the current page. 
 */
function _tpl_page_classes() {
	global $ACT;
	global $INPUT;

	$class = '';

	if($ACT == 'admin') {
		$class .= 'dw-action-' . $ACT;

		$page = $INPUT->str('page');
		if($page)
			$class .= ' dw-page-' . $page;
	} elseif(_tpl_has_prefix($ACT, 'plugin_'))
		$class .= 'dw-action-plugin ' . _tpl_remove_prefix($ACT, 'plugin_');
	else
		$class .= 'dw-action-' . $ACT;

	return $class;
}

function _tpl_getTOC() {
	ob_start();
	tpl_toc();
	$content = ob_get_clean();

	$html = new simple_html_dom;
	$html->load($content, true, false);

	$header = $html->find('h3', 0);
	if($header) { // remove() does not work or else the other find() operations do not work anymore
		$header->outertext = '';
	}

	// Add the nav class to each ul element
	foreach($html->find('ul') as $elm)
		$elm->addClass('nav');

	// Unwrap div.li element
	foreach($html->find('div.li') as $elm) {
		$link = $elm->find('a', 0);
		if($link)
			$link->addClass('nav-link');

		$elm->outertext = str_replace(['<div class="li">', '</div>'], '', $elm->save());
	}

	$root = $html->find('ul.toc', 0); // first element
	if($root) {
		$content = '<nav id="dw__toc" class="dw__toc" role="navigation">';
		$content .= $root->save();
		$content .= '</nav>';
	}

	$html->clear();
	unset($html);

	return $content;
}

