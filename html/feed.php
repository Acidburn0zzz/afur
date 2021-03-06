<?php
include_once ('../config/config.inc.php');
include_once ($conf['lib'] . '/DB.class.php');
include_once ($conf['lib'] . '/package.class.php');

$db = new DB($conf['db_dsn'], $conf['db_user'], $conf['db_passwd']);
// TODO: trouver une meilleure façon que de définir une zone comme ça
date_default_timezone_set('Europe/Paris');
header ('Content-type: application/rss+xml');
?>
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0"  xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
	<atom:link href="<?php echo $conf['rss_url'] . $_SERVER['PHP_SELF'] ?>" rel="self" type="application/rss+xml" />
        <title><?php echo $conf['rss_title'];?></title>
        <description><?php echo $conf['rss_desc'];?></description>
        <link><?php echo $conf['rss_url'];?></link>
        <lastBuildDate><?php echo date ('r'); ?></lastBuildDate>
        <generator><?php echo $conf['rss_generator'];?></generator>
        <image>
            <url><?php echo $conf['rss_url'];?>/templates/archlinux.fr/images/arch-francophonieb.png</url>
            <title><?php echo $conf['rss_title'];?></title>
            <link><?php echo $conf['rss_url'];?></link>
            <description><?php echo $conf['rss_desc'];?></description>
        </image>
<?php 
$pkgs = pkg_search ($db, null, "p.modified", false); 
$i=0;
foreach ($pkgs as $pkg) :
if ($i++>20) break;
?>
        <item>
            <title><?php echo $pkg['name'] . ' ' . $pkg['version'] . ' ' . $pkg['arch']; ?></title>
            <link><?php echo $conf['base_url'];?>?action=view&amp;p=<?php echo $pkg['pkg_id']; ?></link>
            <description><![CDATA[<?php echo $pkg['description'];?>]]></description>
            <!-- <author><?php echo $pkg['maintainer'];?></author> -->
            <pubDate><?php echo date ('r', @strtotime ($pkg['last_sub']));?></pubDate>
            <guid><?php echo $conf['base_url'];?>?action=view&amp;p=<?php echo $pkg['pkg_id']; ?></guid>
        </item>
<?php
endforeach;
$db->close();
?>
    </channel>
</rss>

