<?php
$xmlStringTop = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$xmlStringTop .= '<url><loc>'.base_url().'</loc></url>';
$xmlStringBottom = '</urlset>';

if($venders){
    $xmlString1 = '';
    foreach($venders as $vender) {
        //$url =  base_url('stylists/').base64_encode($vender->id).'/'.$vender->fname.'.'.$vender->lname;
        $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname);
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
    $vendor = $xmlStringTop;
    $vendor .= $xmlString1;
    $vendor .= $xmlStringBottom;
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($vendor);
    
    //$path = $_SERVER["DOCUMENT_ROOT"];
    $path = FCPATH;
    $dom->save($path.'vendor.xml');
    echo '<p><a target="_blank" href="'.base_url('vendor.xml').'">Stylist Sitemap xml</a></p>';
}
if($cms_pages){
    
    $xmlString1 = '';
    foreach($cms_pages as $item) {
        $url =  base_url($item->slug);
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
    $vendor = $xmlStringTop;
    $vendor .= $xmlString1;
    $vendor .= $xmlStringBottom;
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($vendor);
    
    //$path = $_SERVER["DOCUMENT_ROOT"];
    $path = FCPATH;
    $dom->save($path.'pages.xml');
    echo '<p><a target="_blank" href="'.base_url('pages.xml').'">Pages Sitemap xml</a></p>';

}
if($our_services){
    $xmlString1 = '';
    foreach($our_services as $item) {
        $url1 = 'services';
        $url =  base_url($url1.'/'.$item->slug);
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
    $vendor = $xmlStringTop;
    $vendor .= $xmlString1;
    $vendor .= $xmlStringBottom;
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($vendor);
    
    $path = $_SERVER["DOCUMENT_ROOT"];
    $path = FCPATH;
    $dom->save($path.'services.xml');
    echo '<p><a target="_blank" href="'.base_url('services.xml').'">Services Sitemap xml</a></p>';
}
if($expertises){
    $xmlString1 = '';
    $xmlString1 .= '<url><loc>'.base_url("connect-with-stylists").'</loc></url>';
    foreach($expertises as $item) {
        $url1 = 'connect-with-stylists';
        if ($item->slug == 'designer-dresses') {
            $url =  base_url('shop');
        }else{
            $url =  base_url($url1.'/'.$item->slug);
        }
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
    
    $vendor = $xmlStringTop;
    $vendor .= $xmlString1;
    $vendor .= $xmlStringBottom;
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($vendor);
    
    $path = $_SERVER["DOCUMENT_ROOT"];
    $path = FCPATH;
    $dom->save($path.'expertises.xml');
    echo '<p><a target="_blank" href="'.base_url('expertises.xml').'">Expertises Sitemap xml</a></p>';
}
if($blog){
    $xmlString1 = '';
    foreach($blog as $item) {
        $url1 = 'style-stories';
        $url =  base_url($url1.'/'.$item->blogSlug);
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
    $vendor = $xmlStringTop;
    $vendor .= $xmlString1;
    $vendor .= $xmlStringBottom;
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($vendor);
    
    $path = $_SERVER["DOCUMENT_ROOT"];
    $path = FCPATH;
    $dom->save($path.'blog.xml');
    echo '<p><a target="_blank" href="'.base_url('blog.xml').'">Blogs Sitemap xml</a></p>';
}
if($blog){
    $xmlString1 = '';
    foreach($products as $item) {
        if($item->category_slug){
            $url  =  base_url('shop/'.$item->category_slug.'/'.$item->slug);
            $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';   
        }
    }
    $vendor = $xmlStringTop;
    $vendor .= $xmlString1;
    $vendor .= $xmlStringBottom;
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($vendor);
    
    $path = $_SERVER["DOCUMENT_ROOT"];
    $path = FCPATH;
    $dom->save($path.'products.xml');
    echo '<p><a target="_blank" href="'.base_url('products.xml').'">Products Sitemap xml</a></p>';
}

//All 
$xmlString1 = '';
if($venders){
    foreach($venders as $vender) {
        $url =  base_url('stylists/').base64_encode($vender->id).'/'.$vender->fname.'.'.$vender->lname;
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
}
if($cms_pages){
    foreach($cms_pages as $item) {
        $url =  base_url($item->slug);
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
}
if($our_services){
    foreach($our_services as $item) {
        $url1 = 'services';
        $url =  base_url($url1.'/'.$item->slug);
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
}
if($expertises){
    $xmlString1 .= '<url><loc>'.base_url("connect-with-stylists").'</loc></url>';
    foreach($expertises as $item) {
        $url1 = 'connect-with-stylists';
        if ($item->slug == 'designer-dresses') {
            $url =  base_url('shop');
        }else{
            $url =  base_url($url1.'/'.$item->slug);
        }
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
}
if($blog){
    foreach($blog as $item) {
        $url1 = 'style-stories';
        $url =  base_url($url1.'/'.$item->blogSlug);
        $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';
    }
}
if($products){
    foreach($products as $item) {
        if($item->category_slug){
            $url  =  base_url('shop/'.$item->category_slug.'/'.$item->slug);
            $xmlString1 .=   '<url><loc>'.$url.'</loc></url>';   
        }
    }
}
$vendor = $xmlStringTop;
$vendor .= $xmlString1;
$vendor .= $xmlStringBottom;
$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($vendor);

$path = $_SERVER["DOCUMENT_ROOT"];
$path = FCPATH;
$dom->save($path.'sitemap.xml');
echo '<p><a target="_blank" href="'.base_url('sitemap.xml').'">All Sitemap.xml</a></p>';



?>