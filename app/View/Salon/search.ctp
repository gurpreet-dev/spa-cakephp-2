<div class="service_banner"> <img src="<?php echo $this->webroot; ?>images/spa/service_banner.jpg">
  <div class="service_beauty">
    <div class="container">
      <div class="col-sm-12">
        <!--div class="service_uk">
                    <h3>Salons In The <?php echo ucwords($selected_location); ?></h3>
                    <span><?php echo ucwords($selected_location); ?></span>
                </div-->
      </div>
    </div>
  </div>
</div>
<!-- Header Banner end --->
<?php //echo $this->element('sql_dump'); ?>
<?php //echo "<pre>"; print_r($salons); echo "</pre>"; ?>
<div class="available_Section">
<div class="container">
<div class="row">
<div class="col-sm-4">
  <div class="four_available">
    <div class="col-md-12">
      <form action="" method="post">
        <div class="avail_heading">
          <h4>Sort By</h4>
        </div>
        <div class="col-md-6" style="padding-left:0px;">
          <?php if($sortby == 'name'){ ?>
          <input type="radio" name="sortby" value="name" class="sortby" checked="checked">
          <div class="icon_name icon_fix"> <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> </div>
          <span class="name_whte">Name</span>
          <?php }else{ ?>
          <input type="radio" name="sortby" value="name" class="sortby">
          <div class="icon_name icon_fix"> <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> </div>
          <span class="name_whte">Name</span>
          <?php } ?>
        </div>
        <div class="col-md-6">
          <?php if($sortby == 'rating'){ ?>
          <input type="radio" name="sortby" value="rating" class="sortby" checked="checked">
          <div class="icon_name"> <i class="fa fa-star-half-o" aria-hidden="true"></i> </div>
          <span class="rate_whte">Rating</span>
          <?php }else{ ?>
          <input type="radio" name="sortby" value="rating" class="sortby">
          <div class="icon_name"> <i class="fa fa-star-half-o" aria-hidden="true"></i> </div>
          <span class="rate_whte">Rating</span>
          <?php } ?>
        </div>
        <h4 class="filtr_pink">Filter By</h4>
        <div class="avail_heading">
          <h4 class="small_white">Postcode</h4>
        </div>
        <div class="form-group">
          <input type="text" name="location" value="<?php echo $selected_location; ?>" required />
        </div>
        <div class="avail_heading">
          <h4 class="small_white">Services</h4>
        </div>
        <div class="form-group all-serv">
          <ul class="expandible" style="list-style:none;">
            <?php foreach($services as $service){ ?>
            <li class="servi">
              <?php if(in_array($service['Service']['name'], $service_array)){ ?>
              <input type="checkbox"  name="category[]" value="<?php echo $service['Service']['name']; ?>" checked="checked">
              <span class="side-filter"><?php echo $service['Service']['name']; ?></span>
              <?php }else{ ?>
              <input type="checkbox"  name="category[]" value="<?php echo $service['Service']['name']; ?>">
              <span class="side-filter"><?php echo $service['Service']['name']; ?></span>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
        </div>
        <input type="hidden" name="date" value="" />
        <!--<div class="code_service">
                            <h4 class="small_white locate_left">Location</h4>
                            <div class="form-group">
                                    <?php foreach($locations as $location){ ?>
                                <?php if($location['User']['location'] != ''){ ?>
                                <?php if($selected_location == $location['User']['location']){ ?>
                                <input type="radio" name="location" value="<?php echo $location['User']['location']; ?>" checked><span class="side-filter"><?php echo $location['User']['location']; ?></span>
                                <?php }else{ ?>
                                <div class="chk_list">
                                <input type="radio" name="location" value="<?php echo $location['User']['location']; ?>"><span class="side-filter"><?php echo $location['User']['location']; ?></span></div>
                                    <?php } ?>
                                <?php } ?>
                                    <?php } ?>
                            </div>
                        </div>-->
        <button type="submit" class="btn btn-default fltr_colr">Filter</button>
      </form>
    </div>
  </div>
</div>
<div class="col-sm-8 nopadding">
<p class="topsmtext">
  <?php if($count != 0){ ?>
  We have found <?php echo $count; ?> results <?php echo $selected_location != '' ? 'near '. ucwords($selected_location) : ''; ?>
  <?php }else{ ?>
  No result found for <?php echo ucwords($selected_location); ?>
  <?php } ?>
</p>
<?php if(!empty($salons)){ ?>
<?php $j = 1; ?>
<?php foreach($salons as $salon){ 
$id = 'user' . $salon['User']['id'];
$userid =  base64_encode($id);
?>
<div class="rightpart">
<div class="one">
  <div class="col-md-7"> <a href="<?php echo $this->webroot; ?>salon/storeinformation/<?php echo $userid; ?>" class="mainhead">
    <h3><?php echo ucwords($salon['User']['store_name']); ?></h3>
    </a> <i class="fa fa-map-marker loctn" aria-hidden="true"></i><small><?php echo $salon['User']['address']; ?> </small>
    <ul class="list-inline" >
      <?php for($j = 0; $j < $salon['User']['avg_rating']; $j++){ ?>
      <li><a href="javascript:void(0);"><i class="fa fa-star" aria-hidden="true"></i></a></li>
      <?php } ?>
      <?php
    $unrated = 5-$salon['User']['avg_rating'];
    for($i=0; $i<$unrated; $i++){
    ?>
      <li><a href="javascript:void(0);"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
      <?php } ?>
    </ul>
    <a  type="button"> Reviews <span class="badge">
    <?php echo count($salon['Ratings']); ?>
    </span></a>
    <p class="content"><?php echo substr($salon['User']['about'], 0 , 176); ?></p>
  </div>
  <div class="col-md-5">
    <?php $gallery = $salon['User']['gallery_img']; ?>
    <?php if($gallery != ''){ ?>
    
    <?php $gallery = explode(',', $gallery); ?>
    
    
    <div class="slider">
      <div id="carousel-example-generic<?php echo $j; ?>" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <?php for($i = 0; $i<=count($gallery)-1; $i++) { ?>
          <li data-target="#carousel-example-generic<?php echo $j; ?>" data-slide-to="<?php echo $i; ?>" class="<?php if($i == 0 ){ echo 'active'; } ?>"></li>
          <?php } ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <?php 
            $i = 1;
            foreach($gallery as $gal) { ?>
          <div class="item<?php if($i == 1) { echo ' active'; }?>"> <img src="<?php echo $this->webroot;?>images/spa/gallery/<?php echo $gal; ?>" alt="<?php echo $gal; ?>">
            <div class="carousel-caption"> ... </div>
          </div>
          <?php $i++; ?>
          <?php } ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic<?php echo $j; ?>" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
        <a class="right carousel-control" href="#carousel-example-generic<?php echo $j; ?>" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
    </div>
    <?php }else{ ?>
    No Gallery Images Found
    <?php } ?>
  </div>
</div>
<!-- end one class-->
<div class="service">
<?php if(!empty($salon['Services'])){ ?>

<ul class="sr">
    <?php $count = 1; ?>
	<?php $selected_services = array(); ?>
    <?php //echo "<pre>"; print_r($salon); echo "</pre>"; ?>
    <?php //echo "<pre>"; print_r($service_array); echo "</pre>"; ?>
    	<?php foreach($salon['Services'] as $service){ ?>
    	<?php for($z=0; $z<count($service_array); $z++){ ?>
        <?php if (strpos(strtolower($service['name']), strtolower($service_array[$z])) !== false) { ?>
        <?php if($count <= 3){ ?>
        <li><a href="<?php echo $this->webroot; ?>salon/storeinformation/<?php echo $userid; ?>"><?php echo $service['name']; ?></a> <span><?php echo $service['duration']; ?> min</span><small>&pound; <?php echo $service['price']; ?></small> </li>
        
        <?php $selected_services[] = $service['name']; ?>
        
        <?php $count++; ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        
		<?php foreach($salon['Services'] as $service){ ?>
    	<?php for($z=0; $z<count($service_array); $z++){ ?>
        <?php //echo $service['name'].', '.$service_array[$z].'<br>'; ?>
        <?php if (strpos($service['name'],$service_array[$z]) === false) { ?>
        <?php if(!in_array($service['name'], $selected_services)){ ?>
        <?php if($count <= 3){ ?>
        <li><a href="<?php echo $this->webroot; ?>salon/storeinformation/<?php echo $userid; ?>"><?php echo $service['name']; ?></a> <span><?php echo $service['duration']; ?> min</span><small>&pound; <?php echo $service['price']; ?></small> </li>
        <?php $count++; ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
    
    
<ul>
<?php }else{ ?>
No services available
<?php } ?>
</div>
</div>
<?php $j++; ?>
<?php } ?>
<?php }else{ ?>
<img src="<?php echo $this->webroot ?>images/spa/no_show.png" class="spa_inner"/>
<?php } ?>
</div>
</div>
</div>
</div>
<script>
$('ul.expandible').each(function(){
    var lis = $(this).find('li:gt(4)');
    if(!$(this).hasClass('expanded')) {
        lis.hide();
    } else {
        lis.show();
    }
    
    if(lis.length>0){
        $(this).append($('<li class="expand" style="color:#ffd505;"><span>Show More</span></li>').click(function(event){
            var $expandible = $(this).parents('.expandible');
            $expandible.toggleClass('expanded');
            if ( !$expandible.hasClass('expanded')) {
                $(this).text('Show More');
            } else {
                $(this).text('Show Less');
            };
            lis.toggle();
            event.preventDefault();
        }));
    }
});
</script>
