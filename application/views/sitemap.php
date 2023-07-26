<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc>
        <!--<priority>1.0</priority>-->
        <!--<changefreq>daily</changefreq>-->
    </url>


    <!-- Sitemap -->
    <?php if($select_service){ ?>
        <url>
            <loc><?php echo base_url("select-service") ?></loc>
            <!--<priority>0.5</priority>-->
        </url>
    <?php } ?>
    <?php foreach($expertises as $list) { ?>
    
        <?php
            $url1 = 'select-service';
    		if ($list->slug == 'designer-dresses') {
    			$url =  base_url('shop');
    		}else{
    			$url =  base_url($url1.'/'.$list->slug);
    		}
    	?>
    	
        <url>
            <loc><?php echo ($url) ?></loc>
            <!--<priority>0.5</priority>-->
            <!--<changefreq>daily</changefreq>-->
        </url>
    <?php } ?>
    <?php foreach($our_services as $list) { ?>
    
        <?php
            $url1 = 'service';
    		 
    		$url =  base_url($url1.'/'.$list->slug);
    		 
    	?>
    	
        <url>
            <loc><?php echo ($url) ?></loc>
            <!--<priority>0.5</priority>-->
            <!--<changefreq>daily</changefreq>-->
        </url>
    <?php } ?>
    
    
    <?php foreach($cms_pages as $item) { ?>
    <url>
        <loc><?php echo base_url($item->slug) ?></loc>
        <!--<priority>0.5</priority>-->
        <!--<changefreq>daily</changefreq>-->
    </url>
    <?php } ?>

    <?php 	if(!empty($venders)) {?>
    	<?php  	foreach($venders as $vender) { ?>
            <?php $url =  base_url('stylists/').base64_encode($vender->id).'Name='.$vender->fname.'.'.$vender->lname ?>
            <url>
                <loc><?php echo ($url) ?></loc>
                <!--<priority>0.5</priority>-->
                <!--<changefreq>daily</changefreq>-->
            </url>
	    <?php } ?>
	<?php } ?>
</urlset>
