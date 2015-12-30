<?php global $bpxl_goblog_options; ?>
<div class="header-slider loading">
    <ul class="slides">
        <?php
            $bpxl_array = $bpxl_goblog_options['bpxl_header_slidess'];
            foreach ($bpxl_array as $value) { ?>
                <li>
                    <div class="slides-over" style="background:url(<?php echo $value['image']; ?>) repeat center center / cover;">
                    </div>
                    <div class="center-width">
                        <?php if($value['url'] != '') {
                            echo '<h3><a href="' . $value['url'] . '">'. $value['title'] . '</a></h3>';
                        } else { ?>
                            <h3><?php echo $value['title']; ?></h3>
                        <?php } ?>
                        <div class="slider-desc"><?php echo do_shortcode($value['description']); ?></div>
                    </div>									
                </li>
            <?php }
        ?>
    </ul>
</div><!-- .header-slider -->