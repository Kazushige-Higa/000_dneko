<div class="overflow">
    <div class="page_title">
        <div class="puton l1 b2">
            <div class='space_1 space_sp4'></div>
            <h2 class="line_height_14">
                <span class="act01 txt_split type_up fs_25 fs_sp25 base_color eng shadow"><?php echo $page_title_eng; ?></span><br>
                <span class="act02 txt_split type_up fs_60 fs_sp35 base_color shadow font_notob"><?php echo $page_title; ?></span><br>
            </h2>
        </div>
        <div class="puton r1 b1 pconly tright width_2">
            <ol class="breadcrumb">
                <li><a href="./" class="home">TOP</a></li>
                <li><?php echo $page_title; ?></li>
            </ol>
        </div>
        <div class="photo">
            <img loading="lazy" src="<?php
                                        if (!empty($page_title_img)) {
                                            echo $page_title_img;
                                        } else {
                                            echo $page_images;
                                        }
                                        ?>" width="100%" alt="<?php echo $company; ?>イメージ画像">
        </div>
    </div>
</div>