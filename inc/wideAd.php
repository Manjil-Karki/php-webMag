<?php
    $Ad = new ad();
    $Ads = $Ad->getAllWideAds();
    if($Ads){
        $c = count($Ads);
        $Ads = $Ads[rand(0, $c-1)];
        if(isset($Ads->image) && !empty($Ads->image) && file_exists(UPLOAD_PATH.'ad/'.$Ads->image)){
            $thumbnail = UPLOAD_URL.'ad/'.$Ads->image;
        }else{
            $thumbnail = UPLOAD_URL.'noimage.png';
        }
    }
?>
<!-- ad -->

<div class="section-row text-center">
    <a href="<?php echo $Ads->url?>">
        <img class="img-responsive center-block" src="<?php echo $thumbnail?>" alt="">
    </a>
</div>

<!-- ad -->

<?php
?>

