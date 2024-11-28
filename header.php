<?php
/**
*
* This file provides html and php structure for the header.
* @author Cieron <cirrow@proton.me>
* @license GPL v2 (http://www.gnu.org/licenses/gpl.html)
*
*/

if (!defined('DOKU_INC')) die(); /* Must be run from within DokuWiki */



?>

<?php if(!empty($_SERVER['REMOTE_USER'])): ?>

<header id="dokuwiki__header">
    <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
    
        <a class="d-inline d-lg-none btn" data-bs-toggle="offcanvas" href="#sidebarOffcanvas" role="button" aria-controls="sidebarOffcanvas">
                <i class="bi bi-list" style="color: black; font-size: 2em;"></i>
            </a>

        <a class="navbar-brand logo" href="<?php echo wl("home") ?>"><img src="lib/tpl/lorearchive/surrounding/header/logo.png"></a>

        <button type="button" class="btn d-block d-lg-none" data-bs-toggle="modal" data-bs-target="#dokuwiki__searchModal">
            <i class="bi-search" style="font-size: 1.3em;"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?php if($_SERVER['REQUEST_URI'] ==  wl('changelog')): echo 'active' ?><?php endif?>" aria-current="page" href="<?php echo wl('changelog') ?>">Changelog</a></li>
                <li class="nav-item"><a class="nav-link <?php if($_SERVER['REQUEST_URI'] ==  wl('our_team')): echo 'active' ?><?php endif?>" href="<?php echo wl('our_team') ?>">About</a></li>
                <li class="nav-item"><a class="nav-link <?php if($_SERVER['REQUEST_URI'] ==  wl('prerelease')): echo 'active' ?><?php endif?>" href="<?php echo wl('prerelease') ?>">Pre-Release</a></li>
                <li class="nav-item"><a class="nav-link disabled" aria-disabled="true">Donate</a></li>
            </ul>


            <form id="dw__search"action="<?php echo wl(); ?>" method="get" class="d-flex search" role="search">
                <input type="hidden" name="do" value="search">
                <input type="hidden" name="id" value="<?php global $ID; echo $ID; ?>">

                <input type="text" name="q" id="qsearch__in" class="form-control me-2 edit"  placeholder="Search" aria-label="Search" autocomplete="on">
            </form>

            <a href="https://github.com/lorearchive" target="_blank" rel="noopener noreferrer" class="headericon">
                <i class="bi-github" style="color: black; font-size: 1.9em;"></i>
            </a>

            <ul>
                <?php if (file_exists(DOKU_INC . 'inc/Menu/SiteMenu.php')) {
                    echo (new \dokuwiki\Menu\SiteMenu())->getListItems('action ', false);
                } else {
                    _tpl_sitetools();
                } ?>
            </ul>

            <?php require('aclbuttons.php') ?>

        </div>
    </div>
    </nav>

</header>

<?php else: ?>
<header id="dokuwiki__header">
    <div class="headercontent">

        <a class="d-inline d-lg-none btn" data-bs-toggle="offcanvas" href="#sidebarOffcanvas" role="button" aria-controls="sidebarOffcanvas">
            <i class="bi bi-list" style="color: black; font-size: 2em;"></i>
        </a>

        <div class="logo">
            <?php tpl_link(wl(),'<img src="'.ml('logo.png').'" alt="'.$conf['title'].'" />','id="dokuwiki__top" ') ?>
        </div>



        <button type="button" class="btn d-inline d-xl-none" data-bs-toggle="modal" data-bs-target="#dokuwiki__searchModal">
            <i class="bi-search" style="font-size: 1.3em;"></i>
        </button>




        <a href="https://github.com/Cirrow/dokuwiki__lorearchive" target="_blank" rel="noopener noreferrer">
            <i class="bi-github" style="color: black; font-size: 1.9em;"></i>
        </a>

        <?php require('aclbuttons.php') ?>



    </div>
</header>


<?php endif ?>
