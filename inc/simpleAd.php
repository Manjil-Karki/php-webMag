<?php
    $Ad = new ad();
    $Ads = $Ad->getAllSimpleAds();
    if($Ads){
        $c = count($Ads);
        $Ads = $Ads[rand(0, $c-1)];
        if(isset($Ads->image) && !empty($Ads->image) && file_exists(UPLOAD_PATH.'ad/'.$Ads->image)){
            $thumb = UPLOAD_URL.'ad/'.$Ads->image;
        }else{
            $thumb = UPLOAD_URL.'noimage.png';
        }
    }

?>
<!-- ad -->
<div class="aside-widget text-center">
    <a href="<?php echo $Ads->url?>" style="display: inline-block;margin: auto;">
        <img class="img-responsive" src="<?php echo $thumb?>" alt="">
    </a>
</div>
<!-- /ad -->

<?php
?>