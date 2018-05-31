<style>
.star-reviw .fa{color:#000;font-size: 28px;}
.star-reviw .checked{color:#ec992e;}</style>
<?php //echo "<pre>"; print_r($rating); echo "</pre>"; ?>

 <div class="box-header with-border">
                <h3 class="box-title">Edit Review Details</h3>
            </div>
<section class="content">
<div class="row">
    <div class="col-sm-6">
		<div class="box">
			<?php echo $this->Form->create('Review');?>
			<div class="box-body">  
			<input type="hidden" name="data[Review][id]" value="<?php echo $rating['Review']['id']; ?>" />
            <div class="review_sec">
                <div class="star-reviw" style="width: auto; float: none; margin: 0 auto; display: table;">
                    <div class="stars rating" id="rating" style="padding:4px 0;"> 
                    	<?php for($i=0; $i<$rating['Review']['rating']; $i++){ ?>
                        <span class="fa fa-star checked"></span> 
                        <?php } ?>
                        
                        <?php
                        $unchecked = 5-$rating['Review']['rating'];
                        for($j=0;$j<$unchecked;$j++){
                        ?>
                        <span class="fa fa-star"></span>
                        <?php } ?>
                        <input type="hidden" name="data[Review][rating]" id="ratings1">  
                    </div>   
                </div>                
            </div>
            <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary main_btn')); ?>
            <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>     

<script>
$('.rating span').each(function(){
	$(this).click(function(){
		if(!$(this).hasClass('checked')){
			$(this).addClass('checked');
			$(this).prevAll().addClass('checked');
			var rate = $('#rating .checked').length;
		}else{
			$(this).nextAll().removeClass('checked');
			var rate = $('#rating .checked').length;
		}

		$('#ratings1').val(rate);
	   
	});
});
</script>       