
<div class="about_picture">
	<img src="<?php echo $this->webroot ?>files/staticpage/<?php echo $staticpage['Staticpage']['image'] ?>">
</div>


<?php if($staticpage['Staticpage']['id'] != '52'){ ?>
<?php echo html_entity_decode($staticpage['Staticpage']['description'], ENT_QUOTES, 'utf-8');?>
<?php }else{ ?>


<?php if(!empty($faqs)){ ?>
<div class="privacy_section">
<div class="container">
<div class="about_heading">
<h2>FAQ</h2>
</div>
<div class="text_cover">
<?php
$i = 1;
foreach($faqs as $faq){ ?>


<div class="privacy_text">
<h2>Question <?php echo $i; ?>.<?php echo $faq['Faq']['title']; ?> </h2>
<p><?php echo $faq['Faq']['description']; ?></p>
</div>

<?php
$i++;
}
?>
</div>
</div>
</div>

<?php

} 


} ?>




            
          